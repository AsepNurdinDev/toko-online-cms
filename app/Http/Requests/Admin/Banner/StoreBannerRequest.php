<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBannerRequest extends FormRequest
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
            'title'       => ['required', 'string', 'max:255'],
            'subtitle'    => ['nullable', 'string', 'max:255'],
            // Maks. 8MB, dikompres otomatis di server saat diunggah.
            'image'       => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'button_text' => ['nullable', 'string', 'max:50'],
            'button_link' => ['nullable', 'url', 'max:2048'],
            'sort_order'  => ['required', 'integer', 'min:0', 'max:9999'],
            'is_active'   => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'title'       => 'judul banner',
            'subtitle'    => 'subjudul',
            'image'       => 'gambar banner',
            'button_text' => 'teks tombol',
            'button_link' => 'tautan tombol',
            'sort_order'  => 'urutan tampil',
            'is_active'   => 'status',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'url'      => ':attribute harus berupa URL yang valid, contoh: https://contoh.com',
            'image'    => ':attribute harus berupa file gambar.',
            'mimes'    => ':attribute harus berformat JPG, JPEG, PNG, atau WEBP.',
            'boolean'  => ':attribute tidak valid.',
            'integer'  => ':attribute harus berupa angka bulat.',
            'max'      => [
                'numeric' => ':attribute tidak boleh lebih dari :max.',
                'string'  => ':attribute maksimal :max karakter.',
                'file'    => ':attribute maksimal :max KB (8MB).',
            ],
        ];
    }
}
