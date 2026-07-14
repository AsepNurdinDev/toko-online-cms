<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        // Admin yang sedang login boleh mempertahankan username/email miliknya sendiri,
        // makanya unique rule di-ignore untuk ID admin ini. Tanpa ini, mengganti nama
        // tapi memakai username/email admin lain akan menabrak constraint unik di DB
        // dan memunculkan 500 error, bukan pesan validasi yang jelas.
        $adminId = $this->user()?->id;

        return [
            'name'     => ['required', 'string', 'max:100'],
            'username' => [
                'required', 'string', 'max:50', 'alpha_dash',
                Rule::unique('admins', 'username')->ignore($adminId),
            ],
            'email'    => [
                'required', 'email', 'max:255',
                Rule::unique('admins', 'email')->ignore($adminId),
            ],
            'photo'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'     => 'nama',
            'username' => 'username',
            'email'    => 'email',
            'photo'    => 'foto profil',
        ];
    }

    public function messages(): array
    {
        return [
            'required'  => ':attribute wajib diisi.',
            'unique'    => ':attribute ini sudah digunakan akun admin lain.',
            'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, strip (-), dan garis bawah (_).',
            'email'     => ':attribute harus berupa alamat email yang valid.',
            'image'     => ':attribute harus berupa file gambar.',
            'mimes'     => ':attribute harus berformat JPG, JPEG, PNG, atau WEBP.',
            'max'       => [
                'string' => ':attribute maksimal :max karakter.',
                'file'   => ':attribute maksimal :max KB (8MB).',
            ],
        ];
    }
}
