<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductService
{
    public function __construct(
        protected MediaService $mediaService
    ) {}

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Product::with('category')
            ->latest()
            ->paginate($perPage);
    }

    public function all(): Collection
    {
        return Product::with('category')
            ->latest()
            ->get();
    }

    public function find(Product $product): Product
    {
        return $product->load('category', 'images');
    }

    public function create(array $data): Product
    {
        $data['slug'] = $this->uniqueSlug($data['name']);

        if (empty($data['sku'])) {
            $data['sku'] = 'SKU-' . strtoupper(uniqid());
        }

        try {
            return Product::create($data);
        } catch (QueryException $e) {
            $this->rethrowIfDuplicate($e);
            throw $e;
        }
    }

    public function update(Product $product, array $data): Product
    {
        $data['slug'] = $this->uniqueSlug($data['name'], $product->id);

        try {
            $product->update($data);
        } catch (QueryException $e) {
            $this->rethrowIfDuplicate($e);
            throw $e;
        }

        return $product->fresh();
    }

    public function delete(Product $product): bool
    {
        // Hapus file fisik tiap foto galeri dulu, baru hapus produknya.
        // Baris di product_images akan ikut terhapus otomatis lewat cascadeOnDelete di migrasi.
        foreach ($product->images as $image) {
            $this->mediaService->delete($image->image);
        }

        return $product->delete();
    }

    /**
     * Upload & simpan banyak foto galeri sekaligus untuk satu produk.
     *
     * @param  \Illuminate\Http\UploadedFile[]  $files
     */
    public function attachImages(Product $product, array $files): void
    {
        $startOrder = $product->images()->max('sort_order') + 1;

        foreach ($files as $index => $file) {
            $path = $this->mediaService->upload($file, 'products/gallery');

            ProductImage::create([
                'product_id' => $product->id,
                'image'      => $path,
                'sort_order' => $startOrder + $index,
            ]);
        }
    }

    /**
     * Hapus satu foto galeri (file fisik + baris database).
     */
    public function removeImage(ProductImage $image): void
    {
        $this->mediaService->delete($image->image);
        $image->delete();
    }

    /**
     * Buat slug unik dari nama produk. Nama yang sudah divalidasi 'unique' di
     * FormRequest, tapi dua nama BERBEDA bisa saja hasil slug-nya sama persis
     * (mis. "Baju Anak!" & "Baju Anak?" -> "baju-anak"). Method ini menambah
     * akhiran angka supaya slug tetap unik dan tidak menabrak constraint DB.
     */
    protected function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (
            Product::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.(++$counter);
        }

        return $slug;
    }

    /**
     * Jaring pengaman terakhir: jika dua admin submit nama yang sama nyaris
     * bersamaan (race condition, lolos dari validasi 'unique' di FormRequest),
     * DB akan menolak lewat constraint unik. Kita tangkap di sini dan ubah
     * jadi pesan error yang jelas untuk admin, bukan 500 error mentah.
     */
    protected function rethrowIfDuplicate(QueryException $e): void
    {
        // SQLSTATE 23000 = integrity constraint violation (unique/duplicate key),
        // berlaku untuk MySQL, PostgreSQL, maupun SQLite.
        if ($e->getCode() === '23000') {
            throw ValidationException::withMessages([
                'name' => 'Nama produk ini sudah dipakai produk lain, silakan gunakan nama yang berbeda.',
            ]);
        }
    }
}
