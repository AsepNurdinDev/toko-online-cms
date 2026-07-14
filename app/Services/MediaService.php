<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Laravel\Facades\Image;
use Throwable;

class MediaService
{
    /**
     * Batas ukuran file upload gambar (dalam byte). Harus selaras dengan
     * rule "max:8192" (KB) di semua FormRequest yang menerima gambar.
     */
    public const MAX_UPLOAD_BYTES = 8 * 1024 * 1024; // 8MB

    /**
     * Upload sebuah gambar, lalu otomatis dikompres & di-resize di server
     * (lebar maks 1200px, kualitas 75) supaya ukuran file di storage tetap kecil
     * meskipun admin mengunggah file mendekati batas 8MB.
     *
     * Selalu disimpan sebagai .jpg supaya konsisten & aman (mencegah nama file
     * asli / ekstensi berbahaya ikut tersimpan).
     */
    public function upload(
        UploadedFile $file,
        string $directory = 'uploads'
    ): string {
        $this->guardFileSize($file);

        $filename = Str::uuid().'.jpg';
        $path = $directory.'/'.$filename;

        try {
            $image = Image::decode($file);
            $image->scale(width: 1200);
            $image->save(Storage::disk('public')->path($path), quality: 75);
        } catch (Throwable $e) {
            // File lolos validasi 'image' & 'mimes' tapi ternyata rusak/tidak bisa
            // dibaca sebagai gambar (mis. file corrupt). Daripada 500 error mentah,
            // kembalikan sebagai validation error yang jelas ke form.
            throw ValidationException::withMessages([
                'thumbnail' => 'Gambar tidak dapat diproses. Pastikan file tidak rusak, lalu coba unggah ulang.',
            ]);
        }

        return $path;
    }

    /**
     * Upload file apa adanya TANPA proses resize/kompres/konversi format.
     * Dipakai khusus untuk file seperti favicon (.ico) yang formatnya harus
     * dipertahankan persis, karena proses decode/encode gambar biasa akan
     * merusak atau menolak file .ico.
     */
    public function uploadRaw(
        UploadedFile $file,
        string $directory = 'uploads'
    ): string {
        $this->guardFileSize($file);

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'bin';
        $filename = Str::uuid().'.'.$extension;

        try {
            $file->storeAs($directory, $filename, 'public');
        } catch (Throwable $e) {
            throw ValidationException::withMessages([
                'favicon' => 'File tidak dapat diunggah. Pastikan file tidak rusak, lalu coba lagi.',
            ]);
        }

        return $directory.'/'.$filename;
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Jaring pengaman tambahan di level server: meskipun rule validasi
     * FormRequest ('max:8192') sudah menolak file > 8MB sebelum sampai sini,
     * kita cek ulang supaya method ini tetap aman dipakai mandiri.
     */
    protected function guardFileSize(UploadedFile $file): void
    {
        if ($file->getSize() !== false && $file->getSize() > self::MAX_UPLOAD_BYTES) {
            throw ValidationException::withMessages([
                'file' => 'Ukuran file maksimal 8MB.',
            ]);
        }
    }
}
