<?php

use Carbon\Carbon;

if (!function_exists('timeAgo')) {
    function timeAgo($datetime)
    {
        $time = strtotime($datetime);
        $current_time = time();
        $time_difference = $current_time - $time;
        $seconds = $time_difference;
        $minutes = round($seconds / 60);
        $hours = round($seconds / 3600);
        $days = round($seconds / 86400);
        $weeks = round($seconds / 604800);
        $months = round($seconds / 2629440);
        $years = round($seconds / 31553280);
        
        if ($seconds <= 60) {
            return "Baru saja";
        } elseif ($minutes <= 60) {
            return $minutes == 1 ? "satu menit yang lalu" : "$minutes menit yang lalu";
        } elseif ($hours <= 24) {
            return $hours == 1 ? "satu jam yang lalu" : "$hours jam yang lalu";
        } elseif ($days <= 7) {
            return $days == 1 ? "kemarin" : "$days hari yang lalu";
        } elseif ($weeks <= 4.3) {
            return $weeks == 1 ? "seminggu yang lalu" : "$weeks minggu yang lalu";
        } elseif ($months <= 12) {
            return $months == 1 ? "sebulan yang lalu" : "$months bulan yang lalu";
        } else {
            return $years == 1 ? "setahun yang lalu" : "$years tahun yang lalu";
        }
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        // Set locale ke bahasa Indonesia
        \Carbon\Carbon::setLocale('id');

        // Format tanggal dengan nama hari dalam bahasa Indonesia
        return \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM YYYY');
    }
}

