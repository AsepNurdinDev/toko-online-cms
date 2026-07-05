<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        'category_id'    => ['required', 'exists:categories,id'],
        'name'           => ['required', 'string', 'max:255'],
        'description'    => ['nullable', 'string'],
        'price'          => ['required', 'numeric', 'min:0'],
        'discount_price' => ['nullable', 'numeric', 'min:0'],
        'stock'          => ['required', 'integer', 'min:0'],
        'thumbnail'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        'gallery'        => ['nullable', 'array', 'max:10'],
        'gallery.*'      => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        'is_featured'    => ['required', 'boolean'],
        'is_active'      => ['required', 'boolean'],
    ];
}
}
