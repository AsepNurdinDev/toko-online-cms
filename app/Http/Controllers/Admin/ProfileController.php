<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ) {}

    public function edit()
    {
        return view('admin.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->profileService->updateProfile(
            Auth::user(),
            $request->validated()
        );

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