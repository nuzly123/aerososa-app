<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear Roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $managerRole = Role::create(['name' => 'manager']); 

        // Crear Permisos
        $permissions = [
            'create articles',
            'edit articles',
            'delete articles',
            'publish articles'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Asignar todos los permisos al rol de admin
        $adminRole->givePermissionTo(Permission::all());

        // Asignar permisos específicos a otros roles
        $userRole->givePermissionTo(['create articles', 'edit articles', 'publish articles']);
    }
}
