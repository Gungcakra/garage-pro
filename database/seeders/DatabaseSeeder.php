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

        Employee::factory(30)->create();
        Customer::factory(30)->create();
        Service::factory(30)->create();
        SparePart::factory(30)->create();

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
