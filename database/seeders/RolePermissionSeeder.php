<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin    = Role::findOrCreate('admin');
        $konselor = Role::findOrCreate('konselor');
        $konseli  = Role::findOrCreate('konseli');

        // Permissions
        $permissions = [
            // admin full
            'manajemen_konseli',
            'manajemen_konselor',
            'manajemen_jadwal_konselor',
            'manajemen_tiket',
            'manajemen_hari_layanan',
            'manajemen_user',

            // konselor
            'read_jadwal_konselor',
            'read_konseli',
            'read_hari_layanan',
            'update_konselor',

            // konseli
            'create_konseli',
            'update_konseli',
        ];


        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        $admin->givePermissionTo([
            'manajemen_konseli',
            'manajemen_konselor',
            'manajemen_jadwal_konselor',
            'manajemen_tiket',
            'manajemen_hari_layanan',
            'manajemen_user',
        ]);

        $konselor->givePermissionTo([
            'manajemen_tiket',
            'read_jadwal_konselor',
            'read_konseli',
            'read_hari_layanan',
            'update_konselor'
        ]);

        $konseli->givePermissionTo([
            'create_konseli',
            'update_konseli',
        ]);
    }
}
