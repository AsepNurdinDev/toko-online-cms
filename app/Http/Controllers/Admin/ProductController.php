<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected CategoryService $categoryService
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
        $this->productService->create($request->validated());

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
        $this->productService->update(
            $product,
            $request->validated()
        );

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->productService->delete($product);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}