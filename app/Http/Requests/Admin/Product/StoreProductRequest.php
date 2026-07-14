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
            'category_id'    => ['required', 'integer', 'exists:categories,id'],
            // unique:products,name mencegah 2 produk dengan nama sama persis (case-insensitive
            // tergantung collation DB) yang sebelumnya menyebabkan 500 error dari constraint slug unik.
            'name'           => ['required', 'string', 'max:255', 'unique:products,name'],
            'description'    => ['nullable', 'string', 'max:5000'],
            'price'          => ['required', 'numeric', 'min:0', 'max:999999999999.99'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'max:999999999999.99', 'lt:price'],
            'stock'          => ['required', 'integer', 'min:0', 'max:1000000'],
            // Maks. 8MB, konsisten dengan gallery. File akan dikompres otomatis di server.
            'thumbnail'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'gallery'        => ['nullable', 'array', 'max:10'],
            'gallery.*'      => ['image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'is_featured'    => ['required', 'boolean'],
            'is_active'      => ['required', 'boolean'],
        ];
    }

    /**
     * Label field dalam Bahasa Indonesia supaya pesan error mudah dibaca admin.
     */
    public function attributes(): array
    {
        return [
            'category_id'    => 'kategori',
            'name'           => 'nama produk',
            'description'    => 'deskripsi',
            'price'          => 'harga normal',
            'discount_price' => 'harga diskon',
            'stock'          => 'stok',
            'thumbnail'      => 'foto produk',
            'gallery'        => 'galeri foto',
            'gallery.*'      => 'foto galeri',
            'is_featured'    => 'status unggulan',
            'is_active'      => 'status tampil',
        ];
    }

    /**
     * Pesan error kustom Bahasa Indonesia yang jelas, supaya admin tahu persis
     * apa yang boleh/tidak boleh dilakukan (bukan 500 error mentah dari server).
     */
    public function messages(): array
    {
        return [
            'required'      => ':attribute wajib diisi.',
            'unique'        => ':attribute ini sudah dipakai produk lain, silakan gunakan nama yang berbeda.',
            'exists'        => ':attribute yang dipilih tidak valid atau sudah dihapus.',
            'numeric'       => ':attribute harus berupa angka.',
            'integer'       => ':attribute harus berupa bilangan bulat.',
            'min'           => ':attribute tidak boleh kurang dari :min.',
            'max'           => [
                'numeric' => ':attribute tidak boleh lebih dari :max.',
                'string'  => ':attribute maksimal :max karakter.',
                'file'    => ':attribute maksimal :max KB (8MB). Foto besar akan otomatis dikompres, tapi ukuran file tetap tidak boleh melebihi batas ini.',
                'array'   => 'Galeri foto maksimal :max foto.',
            ],
            'lt'            => 'Harga diskon harus lebih kecil dari harga normal.',
            'image'         => ':attribute harus berupa file gambar.',
            'mimes'         => ':attribute harus berformat JPG, JPEG, PNG, atau WEBP.',
            'boolean'       => ':attribute tidak valid.',
            'gallery.*.image' => 'Setiap file di galeri foto harus berupa gambar.',
            'gallery.*.mimes' => 'Setiap foto galeri harus berformat JPG, JPEG, PNG, atau WEBP.',
            'gallery.*.max'   => 'Setiap foto galeri maksimal 8MB.',
        ];
    }
}
