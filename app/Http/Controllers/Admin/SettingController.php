<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateSettingRequest;
use App\Services\SettingService;

class SettingController extends Controller
{
    public function __construct(
        protected SettingService $settingService
    ) {}

    public function edit()
    {
        return view('admin.settings.edit');
    }

    public function update(UpdateSettingRequest $request)
    {
        $this->settingService->update(
            $request->validated()
        );

        return back()->with(
            'success',
            'Pengaturan berhasil disimpan.'
        );
    }
}