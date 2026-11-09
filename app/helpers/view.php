<?php

if (!function_exists('e')) {
    function e($value)
    {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('userInitials')) {
    function userInitials($name)
    {
        $name = trim((string)$name);
        if ($name === '') {
            return 'U';
        }

        $parts = preg_split('/\s+/', $name);
        if (count($parts) >= 2) {
            return strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
        }

        return strtoupper(substr($name, 0, 2));
    }
}

if (!function_exists('formatDisplayDate')) {
    function formatDisplayDate($dateString, $format = 'M d, Y')
    {
        if (empty($dateString)) {
            return '—';
        }

        $timestamp = strtotime($dateString);
        if ($timestamp === false) {
            return e($dateString);
        }

        return date($format, $timestamp);
    }
}
