<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CategoryService
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Category::withCount('products')->latest()->paginate($perPage);
    }

    public function all(): Collection
    {
        return Category::orderBy('name')->get();
    }

    public function find(Category $category): Category
    {
        return $category;
    }

    public function create(array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);

        return Category::create($data);
    }

    public function update(Category $category, array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return $category->fresh();
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}