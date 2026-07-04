<?php

namespace App\Services;

use App\Models\Banner;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BannerService
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Banner::orderBy('sort_order')
            ->paginate($perPage);
    }

    public function all(): Collection
    {
        return Banner::orderBy('sort_order')->get();
    }

    public function find(Banner $banner): Banner
    {
        return $banner;
    }

    public function create(array $data): Banner
    {
        return Banner::create($data);
    }

    public function update(Banner $banner, array $data): Banner
    {
        $banner->update($data);

        return $banner->fresh();
    }

    public function delete(Banner $banner): bool
    {
        return $banner->delete();
    }
}