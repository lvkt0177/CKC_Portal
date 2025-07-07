<?php

namespace App\Traits;

use Spatie\Permission\PermissionRegistrar;

trait ClearsPermissionCache
{
    public function clearPermissionCache(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
