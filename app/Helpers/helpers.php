<?php

use App\Models\User;
use App\Acl\Acl;

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