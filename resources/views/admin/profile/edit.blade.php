<x-admin-layout title="Profil">
    <x-slot name="header">
        <h2 class="truncate text-lg font-semibold text-gray-800">
            Profil Saya
        </h2>
    </x-slot>

    <div class="mx-auto max-w-3xl space-y-6">

        <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm sm:p-8">
            <div class="max-w-xl">
                @include('admin.profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-4 shadow-sm sm:p-8">
            <div class="max-w-xl">
                @include('admin.profile.partials.update-password-form')
            </div>
        </div>

        <div class="rounded-xl border border-red-100 bg-white p-4 shadow-sm sm:p-8">
            <div class="max-w-xl">
                @include('admin.profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-admin-layout>
