<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\MediaService;
use App\Services\ProductService;

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

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->mediaService->upload($request->file('thumbnail'), 'products');
        }

        $this->productService->create($data);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryService->all();

        return view('admin.product.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $this->mediaService->delete($product->thumbnail);
            $data['thumbnail'] = $this->mediaService->upload($request->file('thumbnail'), 'products');
        }

        $this->productService->update(
            $product,
            $data
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
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
