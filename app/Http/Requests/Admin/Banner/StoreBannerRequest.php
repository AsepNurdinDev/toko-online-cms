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
        'subtitle'    => ['nullable', 'string'],
        'image'       => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        'button_text' => ['nullable', 'string', 'max:50'],
        'button_link' => ['nullable', 'url'],
        'sort_order'  => ['required', 'integer'],
        'is_active'   => ['required', 'boolean'],
    ];
}
}
