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
        /* $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);
        $managerRole = Role::create(['name' => 'Manager']);
        $rrhhrole = Role::create(['name' => 'RRHH']);
        $opmanagerRole = Role::create(['name' => 'Manager de Operaciones']);  */

        /* $adminRole = 'Admin';
        $userRole = 'User';
        $managerRole = 'Manager';
        $rrhhrole = 'RRHH';
        $opmanagerRole = 'Manager de Operaciones'; */

        $adminRole = Role::findByName('Admin');
        $userRole = Role::findByName('User');
        $managerRole = Role::findByName('Manager');
        $rrhhRole = Role::findByName('RRHH');
        $opmanagerRole = Role::findByName('Manager de Operaciones');

        // Crear Permisos
        /*  $permissionsAdmin = [
            'admin',
        ]; */

        /* foreach ($permissions as $permission) {
            Permission::create(['name' => $permission])->assignRole($adminRole);
        } */


        /*  //AIR TRAFFIC
        Permission::create(['name' => 'air_traffic.index'])->syncRoles([$adminRole, $userRole]);
        Permission::create(['name' => 'air_traffic.create'])->syncRoles([$adminRole, $userRole]);
        Permission::create(['name' => 'air_traffic.edit'])->syncRoles([$adminRole, $userRole]);
        Permission::create(['name' => 'air_traffic.filter'])->syncRoles([$adminRole, $userRole]);
        
        //AIRCRAFTS
        Permission::create(['name' => 'aircrafts.index'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
        Permission::create(['name' => 'aircrafts.create'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'aircrafts.edit'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'aircrafts.updateStatus'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'reports.aircrafts.history'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]); //REPORTS MODULE
    
        //CREWS
        Permission::create(['name' => 'crews.index'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'crews.addLicense'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'crews.addTypeRating'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'crews.updateStatus'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'reports.crews.history'])->syncRoles([$adminRole, $opmanagerRole]); //REPORTS MODULE
        
        //EMPLOYEES
        Permission::create(['name' => 'employees.index'])->syncRoles([$adminRole, $rrhhrole]);
        Permission::create(['name' => 'employees.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'employees.edit'])->syncRoles([$adminRole, $rrhhrole]);
        Permission::create(['name' => 'employees.profile'])->syncRoles([$adminRole, $rrhhrole]);
        Permission::create(['name' => 'employees.updateStatus'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'employees.search'])->syncRoles([$adminRole]);
        
        //USERS
        Permission::create(['name' => 'admin.users.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'admin.users.resetPassword'])->syncRoles([$adminRole]);

        //CONFIGURATION SOLO ADMIN
        //AIRPORTS
        Permission::create(['name' => 'config.airports.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.airports.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.airports.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.airports.updateStatus'])->syncRoles([$adminRole]);

        //CIUDADES
        Permission::create(['name' => 'config.cities.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.cities.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.cities.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.cities.updateStatus'])->syncRoles([$adminRole]);

        //POSITIONS
        Permission::create(['name' => 'config.positions.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.positions.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.positions.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.positions.updateStatus'])->syncRoles([$adminRole]);

        //CONTRACTS
        Permission::create(['name' => 'config.contracts.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.contracts.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.contracts.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.contracts.updateStatus'])->syncRoles([$adminRole]);
        
        //DEPARTAMENTOS
        Permission::create(['name' => 'config.departments.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.departments.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.departments.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.departments.updateStatus'])->syncRoles([$adminRole]);

        //STATIONS
        Permission::create(['name' => 'config.stations.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.stations.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.stations.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.stations.updateStatus'])->syncRoles([$adminRole]);

        //OFFICES
        Permission::create(['name' => 'config.offices.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.offices.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.offices.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.offices.updateStatus'])->syncRoles([$adminRole]);

        //FLIGHT ROUTES
        Permission::create(['name' => 'config.flight_routes.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flight_routes.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flight_routes.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flight_routes.updateStatus'])->syncRoles([$adminRole]);

        //FLIGHT ROUTES DETAILS
        Permission::create(['name' => 'config.flight_route_details.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flight_route_details.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flight_route_details.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flight_route_details.updateStatus'])->syncRoles([$adminRole]);

        //AIRCRAFTS TYPES
        Permission::create(['name' => 'config.aircraft_types.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.aircraft_types.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.aircraft_types.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.aircraft_types.updateStatus'])->syncRoles([$adminRole]);

        //FLIGHTS
        Permission::create(['name' => 'config.flights.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flights.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flights.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.flights.updateStatus'])->syncRoles([$adminRole]);

        //MENU
        Permission::create(['name' => 'menu.principal'])->syncRoles([$adminRole, $userRole, $managerRole, $rrhhrole, $opmanagerRole]);
        Permission::create(['name' => 'menu.config'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'menu.admin'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'menu.rrhh'])->syncRoles([$adminRole, $rrhhrole]);

        //REPORTS
        Permission::create(['name' => 'reports.index'])->syncRoles([$adminRole, $userRole, $managerRole, $rrhhrole, $opmanagerRole]);
        //aqui van a ir los permisos para los reportes */

        /* Permission::create(['name' => 'config.aircraft_types.index'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
        Permission::create(['name' => 'config.aircraft_types.create'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'config.aircraft_types.edit'])->syncRoles([$adminRole, $opmanagerRole]);
        Permission::create(['name' => 'config.aircraft_types.updateStatus'])->syncRoles([$adminRole, $opmanagerRole]); */

        /*  // Definir los permisos a eliminar
        $permissionsToRemove = [
            'config.aircraft_types.index',
            'config.aircraft_types.edit',
            'config.aircraft_types.updateStatus',
            'config.aircraft_types.create',
            // Agrega aquí más permisos según sea necesario
        ];

        // Eliminar permisos del rol Manager
        foreach ($permissionsToRemove as $permissionName) {
            if (Permission::where('name', $permissionName)->exists()) {
                $permission = Permission::findByName($permissionName);
                $managerRole->revokePermissionTo($permission);
                $opmanagerRole->revokePermissionTo($permission);
            }
        } */


        // Asignar todos los permisos al rol de admin
        /* $adminRole->givePermissionTo(Permission::all()); */

        /* // Asignar permisos específicos a otros roles
        $userRole->givePermissionTo(['create articles', 'edit articles', 'publish articles']); */



        Permission::create(['name' => 'export.daily'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
        Permission::create(['name' => 'reports.daily'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
        Permission::create(['name' => 'report.flight'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
        Permission::create(['name' => 'report.aircraft_history'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
        Permission::create(['name' => 'report.aircraft_fuelings'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
        Permission::create(['name' => 'report.crew_flight_time'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
        Permission::create(['name' => 'report.assigned_crews'])->syncRoles([$adminRole, $managerRole, $opmanagerRole]);
    }
}
