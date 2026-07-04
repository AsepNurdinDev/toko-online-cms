<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProductService
{
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
        return $product->delete();
    }
}