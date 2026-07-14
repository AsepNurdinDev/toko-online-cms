<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'site_name'        => ['required', 'string', 'max:100'],
            'site_description' => ['nullable', 'string', 'max:1000'],
            'whatsapp'         => ['required', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'email'            => ['nullable', 'email', 'max:255'],
            'address'          => ['nullable', 'string', 'max:500'],
            // Maks. 8MB, dikompres otomatis di server saat diunggah.
            'logo'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:8192'],
            // Favicon TIDAK melewati proses kompres/resize (supaya format .ico tidak rusak),
            // jadi batasnya dijaga lebih kecil.
            'favicon'          => ['nullable', 'mimes:ico,png', 'max:1024'],
            'hero_title'       => ['nullable', 'string', 'max:150'],
            'hero_subtitle'    => ['nullable', 'string', 'max:255'],
            'facebook'         => ['nullable', 'url', 'max:2048'],
            'instagram'        => ['nullable', 'url', 'max:2048'],
            'tiktok'           => ['nullable', 'url', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'site_name'        => 'nama toko',
            'site_description' => 'deskripsi toko',
            'whatsapp'         => 'nomor WhatsApp',
            'email'            => 'email',
            'address'          => 'alamat',
            'logo'             => 'logo',
            'favicon'          => 'favicon',
            'hero_title'       => 'judul beranda',
            'hero_subtitle'    => 'subjudul beranda',
            'facebook'         => 'tautan Facebook',
            'instagram'        => 'tautan Instagram',
            'tiktok'           => 'tautan TikTok',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'regex'    => ':attribute hanya boleh berisi angka, tanpa spasi atau simbol (contoh: 62812xxxxxxx).',
            'email'    => ':attribute harus berupa alamat email yang valid.',
            'url'      => ':attribute harus berupa URL yang valid, contoh: https://instagram.com/namatoko',
            'image'    => ':attribute harus berupa file gambar.',
            'mimes'    => [
                'logo'    => 'Logo harus berformat JPG, JPEG, PNG, SVG, atau WEBP.',
                'favicon' => 'Favicon harus berformat ICO atau PNG.',
            ],
            'max' => [
                'string' => ':attribute maksimal :max karakter.',
                'file'   => ':attribute maksimal :max KB.',
            ],
        ];
    }
}
