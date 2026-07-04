<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:100', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
            'is_active'   => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'        => 'nama kategori',
            'description' => 'deskripsi',
            'is_active'   => 'status',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique'   => ':attribute sudah digunakan.',
            'boolean'  => ':attribute tidak valid.',
            'max'      => ':attribute maksimal :max karakter.',
        ];
    }
}