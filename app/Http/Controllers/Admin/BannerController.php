<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\StoreBannerRequest;
use App\Http\Requests\Admin\Banner\UpdateBannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use App\Services\MediaService;

class BannerController extends Controller
{
    public function __construct(
        protected BannerService $bannerService,
        protected MediaService $mediaService
    ) {}

    public function index()
    {
        $banners = $this->bannerService->paginate();

        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(StoreBannerRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->mediaService->upload($request->file('image'), 'banners');
        }

        $this->bannerService->create($data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->mediaService->delete($banner->image);
            $data['image'] = $this->mediaService->upload($request->file('image'), 'banners');
        }

        $this->bannerService->update($banner, $data);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $this->mediaService->delete($banner->image);

        $this->bannerService->delete($banner);

        return redirect()
            ->route('admin.banners.index')
            ->with('success', 'Banner berhasil dihapus.');
    }
}
