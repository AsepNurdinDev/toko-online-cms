<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
        $data['slug'] = $this->uniqueSlug($data['name']);

        try {
            return Category::create($data);
        } catch (QueryException $e) {
            $this->rethrowIfDuplicate($e);
            throw $e;
        }
    }

    public function update(Category $category, array $data): Category
    {
        $data['slug'] = $this->uniqueSlug($data['name'], $category->id);

        try {
            $category->update($data);
        } catch (QueryException $e) {
            $this->rethrowIfDuplicate($e);
            throw $e;
        }

        return $category->fresh();
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    /**
     * Sama seperti di ProductService: nama beda bisa hasil slug sama,
     * jadi kita pastikan slug tetap unik dengan akhiran angka.
     */
    protected function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;

        while (
            Category::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.(++$counter);
        }

        return $slug;
    }

    /**
     * Jaring pengaman kalau terjadi race condition (dua admin submit nama sama
     * nyaris bersamaan) yang lolos dari validasi 'unique' di FormRequest.
     */
    protected function rethrowIfDuplicate(QueryException $e): void
    {
        if ($e->getCode() === '23000') {
            throw ValidationException::withMessages([
                'name' => 'Nama kategori ini sudah dipakai kategori lain, silakan gunakan nama yang berbeda.',
            ]);
        }
    }
}
