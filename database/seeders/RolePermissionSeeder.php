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
            'kelola_user',
            'kelola_jadwal',
            'buat_tiket',
            'lihat_tiket',
            'approve_tiket',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        $admin->givePermissionTo($permissions);

        $konselor->givePermissionTo([
            'lihat_tiket',
            'approve_tiket',
        ]);

        $konseli->givePermissionTo([
            'buat_tiket',
            'lihat_tiket',
        ]);
    }
}
