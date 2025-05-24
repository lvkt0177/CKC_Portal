<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Acl\Acl;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Acl::permissions() as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach (Acl::roles() as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $superAdmin = Role::where('name', Acl::ROLE_SUPER_ADMIN)->first();
        if ($superAdmin) {
            $superAdmin->syncPermissions(Acl::permissions());
        }

        $admin = Role::where('name', Acl::ROLE_ADMIN)->first();
        if ($admin) {
            $admin->syncPermissions(Acl::permissions());
        }

        $user = User::find(1);
        if ($user) {
            $user->assignRole(Acl::ROLE_SUPER_ADMIN);
        }

        $user = User::find(2);
        if ($user) {
            $user->assignRole(Acl::ROLE_ADMIN);
        }

        $user = User::find(3);
        if ($user) {
            $user->assignRole(Acl::ROLE_STAFF);
        }
    }
}
