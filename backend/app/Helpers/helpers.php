<?php

if (! function_exists('yesNo')) {
    function yesNo(bool $value): string
    {
        return $value ? 'Ya' : 'Tidak';
    }
}

if (! function_exists('statusBadge')) {
    function statusBadge(bool $value): string
    {
        return $value ? 'Aktif' : 'Nonaktif';
    }
}