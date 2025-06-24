<?php

use App\Models\User;
use App\Acl\Acl;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($patterns, $activeClass = 'active') {
        if (!is_array($patterns)) {
            $patterns = [$patterns];
        }

        $currentPath = request()->path(); 
        $currentFullUrl = url()->full();  
        $baseUrl = url('/');           

        foreach ($patterns as $pattern) {
            if (request()->is($pattern)) {
                return $activeClass;
            }

            $patternUrl = $baseUrl . '/' . ltrim($pattern, '/');

            if (Str::startsWith($currentFullUrl, $patternUrl)) {
                return $activeClass;
            }
        }

        return '';
    }
}

if (!function_exists('isActiveMenuRoute')) {
    function isActiveMenuRoute($patterns, $activeClass = 'block') {
        if (!is_array($patterns)) {
            $patterns = [$patterns];
        }

        $currentPath = request()->path(); 
        $currentFullUrl = url()->full();  
        $baseUrl = url('/');           

        foreach ($patterns as $pattern) {
            if (request()->is($pattern)) {
                return $activeClass;
            }

            $patternUrl = $baseUrl . '/' . ltrim($pattern, '/');

            if (Str::startsWith($currentFullUrl, $patternUrl)) {
                return $activeClass;
            }
        }

        return '';
    }
}

function hasPermission(string $permission): bool
{
    $user = auth()->user();
    return $user && $user->hasPermission($permission);
}

function checkPermissions($permissions)
{
    return auth()->user()->hasAnyPermission($permissions);
}

function Acl()
{
    return \App\Acl\Acl::class;
}