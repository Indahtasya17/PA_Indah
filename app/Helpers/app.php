<?php

use Carbon\Carbon;
use Whoops\Exception\Formatter;

function isRouteActive(array $routes, string $className = 'active') {
    return in_array(request()->route()->getName(), $routes) ? $className : '';
}

function toIDR($number) {
    return 'Rp' . number_format($number, 0, ',', '.');
}

function formatTanggalIndo($tanggal) {
    return Carbon::parse($tanggal)->translatedFormat('d F Y');
}




