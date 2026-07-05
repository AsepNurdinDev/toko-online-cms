<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

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
        $data['slug'] = Str::slug($data['name']);

        if (empty($data['sku'])) {
            $data['sku'] = 'SKU-' . strtoupper(uniqid());
        }

        return Product::create($data);
    }

    public function update(Product $product, array $data): Product
    {
        $data['slug'] = Str::slug($data['name']);

        $product->update($data);

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
}