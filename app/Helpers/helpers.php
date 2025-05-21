<?php

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($patterns, $activeClass = 'active') {
        if (!is_array($patterns)) {
            $patterns = [$patterns];
        }

        foreach ($patterns as $pattern) {
            if (request()->is($pattern)) {
                return $activeClass;
            }   
        }

        return '';
    }
}
