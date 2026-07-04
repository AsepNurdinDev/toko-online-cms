<?php

use Carbon\Carbon;

if (! function_exists('rupiah')) {

    function rupiah(float|int|null $value): string
    {
        return 'Rp ' . number_format($value ?? 0, 0, ',', '.');
    }

}

if (! function_exists('discountPercentage')) {

    function discountPercentage(
        float|int $price,
        float|int|null $discountPrice
    ): int {

        if (!$discountPrice || $discountPrice >= $price) {
            return 0;
        }

        return (int) round(
            (($price - $discountPrice) / $price) * 100
        );
    }

}

if (! function_exists('formatDate')) {

    function formatDate(
        string|\DateTimeInterface|null $date,
        string $format = 'd M Y'
    ): string {

        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)->translatedFormat($format);
    }

}

if (! function_exists('formatDateTime')) {

    function formatDateTime(
        string|\DateTimeInterface|null $date
    ): string {

        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)
            ->translatedFormat('d M Y H:i');
    }

}