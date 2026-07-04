<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function updateProfile(Admin $admin, array $data): Admin
    {
        $admin->update($data);

        return $admin->fresh();
    }

    public function updatePassword(Admin $admin, string $password): void
    {
        $admin->update([
            'password' => Hash::make($password),
        ]);
    }
}