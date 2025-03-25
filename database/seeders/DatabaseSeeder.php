<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);

        Employee::factory()->create([
            'name' => 'John Doe',
            'position' => 'Manager',
            'phone' => '1234567890',
            'address' => '123 Main St, Cityville'
        ]);
        Employee::factory()->create([
            'name' => 'Jane Smith',
            'position' => 'Developer',
            'phone' => '0987654321',
            'address' => '456 Elm St, Townsville'
        ]);
        Employee::factory()->create([
            'name' => 'Alice Johnson',
            'position' => 'Designer',
            'phone' => '5551234567',
            'address' => '789 Oak St, Villageburg'
        ]);
        Employee::factory()->create([
            'name' => 'Bob Brown',
            'position' => 'Analyst',
            'phone' => '4449876543',
            'address' => '321 Pine St, Hamletville'
        ]);
        Employee::factory()->create([
            'name' => 'Charlie Green',
            'position' => 'Tester',
            'phone' => '2225551234',
            'address' => '654 Maple St, Citytown'
        ]);
        Employee::factory()->create([
            'name' => 'David White',
            'position' => 'Support',
            'phone' => '1112223333',
            'address' => '987 Birch St, Suburbia'
        ]);

                // Menu Dashboard
                $dashboard = Menu::create([
                    'name' => 'Dashboard',
                    'icon' => 'fa-solid fa-house',
                    'route' => 'dashboard',
                    'order' => 1
                ]);
        
                SubMenu::create([
                    'menu_id' => $dashboard->id,
                    'name' => 'Home',
                    'route' => 'dashboard',
                    'order' => 1
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
                    'name' => 'Employee',
                    'route' => 'employee',
                    'order' => 1
                ]);
        
                Submenu::create([
                    'menu_id' => $masterData->id,
                    'name' => 'Menu',
                    'route' => 'menu',
                    'order' => 2
                ]);
        
                Submenu::create([
                    'menu_id' => $masterData->id,
                    'name' => 'Customer',
                    'route' => 'customer',
                    'order' => 3
                ]);

                Submenu::create([
                    'menu_id' => $masterData->id,
                    'name' => 'Service',
                    'route' => 'service',
                    'order' => 4
                ]);
        
    }
}
