<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\CategoryService;
use App\Services\MediaService;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService,
        protected MediaService $mediaService
    ) {}

    public function index()
    {
        $products = $this->productService->paginate();

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->all();

        return view('admin.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        unset($data['gallery']);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->mediaService->upload($request->file('thumbnail'), 'products');
        }

        $product = $this->productService->create($data);

        if ($request->hasFile('gallery')) {
            $this->productService->attachImages($product, $request->file('gallery'));
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = $this->categoryService->all();

        return view('admin.product.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        unset($data['gallery']);

        if ($request->hasFile('thumbnail')) {
            $this->mediaService->delete($product->thumbnail);
            $data['thumbnail'] = $this->mediaService->upload($request->file('thumbnail'), 'products');
        }

        $this->productService->update($product, $data);

        if ($request->hasFile('gallery')) {
            $this->productService->attachImages($product, $request->file('gallery'));
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus satu foto galeri produk (dipanggil dari tombol hapus di halaman edit).
     */
    public function destroyImage(Product $product, ProductImage $image): RedirectResponse
    {
        // Pastikan foto ini benar-benar milik produk yang dimaksud,
        // supaya orang tidak bisa hapus foto produk lain lewat ID acak di URL.
        abort_unless($image->product_id === $product->id, 404);

        $this->productService->removeImage($image);

        return back()->with('success', 'Foto galeri berhasil dihapus.');
    }

    public function destroy(Product $product)
    {
        $this->mediaService->delete($product->thumbnail);

        $this->productService->delete($product);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}