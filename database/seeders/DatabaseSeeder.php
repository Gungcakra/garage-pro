<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Service;
use App\Models\SparePart;
use App\Models\SubMenu;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

    
        Employee::factory(30)->create();
        Customer::factory(1000)->create();
        Service::factory(30)->create();
        SparePart::factory(30)->create();
       


        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $employee = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'web']);

        // Define permissions
        $permissions = [
            'dashboard',
            'user',
            'employee',
            'customer',
            'menu',
            'role',
            'service',
            'sparepart',
            'serviceoperational',

                    
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $admin->syncPermissions(['dashboard','user', 'employee', 'customer',
            'menu','role', 'menu', 'service', 'sparepart', 'serviceoperational']);
        $employee->syncPermissions(['employee']);
        $user =  User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $user->assignRole('admin');

        
        // Menu Dashboard
        $dashboard = Menu::create([
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-house',
            'route' => 'dashboard',
            'order' => 1,
        ]);

        SubMenu::create([
            'menu_id' => $dashboard->id,
            'name' => 'Home',
            'route' => 'dashboard',
            'order' => 1,
            'permission_id' => Permission::where('name', 'dashboard')->first()->id

        ]);

         // Menu Master Data
         $masterData = Menu::create([
            'name' => 'Master Data',
            'icon' => 'fa-solid fa-database',
            'route' => null,
            'order' => 2
        ]);

        Submenu::create([
            'menu_id' => $masterData->id,
            'name' => 'User',
            'route' => 'user',
            'order' => 1,
            'permission_id' => Permission::where('name', 'user')->first()->id
        ]);

        Submenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Role',
            'route' => 'role',
            'order' => 2,
            'permission_id' => Permission::where('name', 'role')->first()->id
        ]);
        Submenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Employee',
            'route' => 'employee',
            'order' => 3,
            'permission_id' => Permission::where('name', 'employee')->first()->id
        ]);

        Submenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Menu',
            'route' => 'menu',
            'order' => 4,
            'permission_id' => Permission::where('name', 'menu')->first()->id
        ]);

        Submenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Customer',
            'route' => 'customer',
            'order' => 5,
            'permission_id' => Permission::where('name', 'customer')->first()->id
        ]);

        Submenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Service',
            'route' => 'service',
            'order' => 6,
            'permission_id' => Permission::where('name', 'service')->first()->id
        ]);
        Submenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Spare Part',
            'route' => 'sparepart',
            'order' => 7,
            'permission_id' => Permission::where('name', 'sparepart')->first()->id
        ]);

        $operational = Menu::create([
            'name' => 'Operational',
            'icon' => 'fa-solid fa-gauge',
            'route' => null,
            'order' => 3
        ]);
        Submenu::create([
            'menu_id' => $operational->id,
            'name' => 'Service Operational',
            'route' => 'serviceoperational',
            'order' => 1,
            'permission_id' => Permission::where('name', 'serviceoperational')->first()->id
        ]);
    }
}
