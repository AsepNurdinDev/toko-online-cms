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
        return false;
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
        'site_description' => ['nullable', 'string'],
        'whatsapp'         => ['required', 'string', 'max:20'],
        'email'            => ['nullable', 'email'],
        'address'          => ['nullable', 'string'],
        'logo'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:2048'],
        'favicon'          => ['nullable', 'image', 'mimes:ico,png', 'max:1024'],
    ];
}
}
