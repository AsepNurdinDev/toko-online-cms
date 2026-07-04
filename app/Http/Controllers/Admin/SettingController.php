<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateSettingRequest;
use App\Models\Setting;
use App\Services\MediaService;
use App\Services\SettingService;

class SettingController extends Controller
{
    public function __construct(
        protected SettingService $settingService,
        protected MediaService $mediaService
    ) {}

    public function edit()
    {
        $settings = Setting::pluck('value', 'key');

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $this->mediaService->delete(Setting::where('key', 'logo')->value('value'));
            $data['logo'] = $this->mediaService->upload($request->file('logo'), 'settings');
        } else {
            unset($data['logo']);
        }

        if ($request->hasFile('favicon')) {
            $this->mediaService->delete(Setting::where('key', 'favicon')->value('value'));
            $data['favicon'] = $this->mediaService->upload($request->file('favicon'), 'settings');
        } else {
            unset($data['favicon']);
        }

        $this->settingService->update($data);

        return back()->with(
            'success',
            'Pengaturan berhasil disimpan.'
        );
    }
}
