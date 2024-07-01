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

        $adminRole = 'Admin';
        $userRole = 'User';
        $managerRole = 'Manager';
        $rrhhrole = 'RRHH';
        $opmanagerRole = 'Manager de Operaciones';

        // Crear Permisos
       /*  $permissionsAdmin = [
            'admin',
        ]; */
       
        /* foreach ($permissions as $permission) {
            Permission::create(['name' => $permission])->assignRole($adminRole);
        } */

        
        //AIR TRAFFIC
        Permission::create(['name' => 'air_traffic.index'])->syncRoles([$adminRole, $userRole]);
        Permission::create(['name' => 'air_traffic.create'])->syncRoles([$adminRole, $userRole]);
        Permission::create(['name' => 'air_traffic.edit'])->syncRoles([$adminRole, $userRole]);
        Permission::create(['name' => 'air_traffic.filter'])->syncRoles([$adminRole, $userRole]);
        
        //AIRCRAFTS
        Permission::create(['name' => 'aircrafts.index'])->syncRoles([$adminRole, $managerRole]);
        Permission::create(['name' => 'aircrafts.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'aircrafts.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'aircrafts.updateStatus'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'reports.aircrafts.history'])->syncRoles([$adminRole, $managerRole]); //REPORTS MODULE
    
        //CREWS
        Permission::create(['name' => 'crews.index'])->syncRoles([$adminRole]);
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
        Permission::create(['name' => 'config.ciudades.index'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.ciudades.create'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.ciudades.edit'])->syncRoles([$adminRole]);
        Permission::create(['name' => 'config.ciudades.updateStatus'])->syncRoles([$adminRole]);

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
        //aqui van a ir los permisos para los reportes



        // Asignar todos los permisos al rol de admin
        /* $adminRole->givePermissionTo(Permission::all()); */

        /* // Asignar permisos específicos a otros roles
        $userRole->givePermissionTo(['create articles', 'edit articles', 'publish articles']); */
    }
}
