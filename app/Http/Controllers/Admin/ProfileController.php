<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Services\MediaService;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService,
        protected MediaService $mediaService
    ) {}

    public function edit()
    {
        return view('admin.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $admin = Auth::user();

        if ($request->hasFile('photo')) {
            $this->mediaService->delete($admin->photo);
            $data['photo'] = $this->mediaService->upload($request->file('photo'), 'admins');
        } else {
            unset($data['photo']);
        }

        $this->profileService->updateProfile($admin, $data);

        return back()->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }

    public function password(UpdatePasswordRequest $request)
    {
        $this->profileService->updatePassword(
            Auth::user(),
            $request->validated()['password']
        );

        return back()->with(
            'success',
            'Password berhasil diperbarui.'
        );
    }
}
