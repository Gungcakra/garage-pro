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
        Service::insert([
            ['name' => 'Oil Change', 'price' => 150000],
            ['name' => 'Tire Rotation', 'price' => 100000],
            ['name' => 'Brake Inspection', 'price' => 200000],
            ['name' => 'Battery Replacement', 'price' => 800000],
            ['name' => 'Engine Tune-Up', 'price' => 500000],
            ['name' => 'Air Filter Replacement', 'price' => 120000],
            ['name' => 'Wheel Alignment', 'price' => 300000],
            ['name' => 'Transmission Service', 'price' => 700000],
            ['name' => 'Coolant Flush', 'price' => 250000],
            ['name' => 'Spark Plug Replacement', 'price' => 180000],
            ['name' => 'Suspension Repair', 'price' => 600000],
            ['name' => 'Exhaust System Repair', 'price' => 400000],
            ['name' => 'Fuel System Cleaning', 'price' => 350000],
            ['name' => 'AC Service', 'price' => 300000],
            ['name' => 'Headlight Restoration', 'price' => 150000],
            ['name' => 'Windshield Repair', 'price' => 250000],
            ['name' => 'Timing Belt Replacement', 'price' => 900000],
            ['name' => 'Clutch Repair', 'price' => 850000],
            ['name' => 'Power Steering Repair', 'price' => 400000],
            ['name' => 'Radiator Repair', 'price' => 500000],
            ['name' => 'Body Paint Touch-Up', 'price' => 300000],
            ['name' => 'Car Wash', 'price' => 50000],
            ['name' => 'Interior Cleaning', 'price' => 150000],
            ['name' => 'Engine Overhaul', 'price' => 2000000],
            ['name' => 'Starter Motor Repair', 'price' => 450000],
            ['name' => 'Alternator Repair', 'price' => 550000],
            ['name' => 'Fuel Pump Replacement', 'price' => 750000],
            ['name' => 'Door Lock Repair', 'price' => 200000],
            ['name' => 'Wiper Blade Replacement', 'price' => 80000],
            ['name' => 'Dashboard Repair', 'price' => 300000],
        ]);
        SparePart::insert([
            ['name' => 'Oil Filter', 'brand' => 'Bosch', 'price' => 75000, 'stock' => 50],
            ['name' => 'Air Filter', 'brand' => 'Mann', 'price' => 120000, 'stock' => 40],
            ['name' => 'Brake Pads', 'brand' => 'Brembo', 'price' => 350000, 'stock' => 30],
            ['name' => 'Spark Plug', 'brand' => 'NGK', 'price' => 45000, 'stock' => 100],
            ['name' => 'Timing Belt', 'brand' => 'Gates', 'price' => 250000, 'stock' => 20],
            ['name' => 'Wiper Blade', 'brand' => 'Bosch', 'price' => 80000, 'stock' => 60],
            ['name' => 'Battery', 'brand' => 'Yuasa', 'price' => 850000, 'stock' => 15],
            ['name' => 'Radiator', 'brand' => 'Denso', 'price' => 1200000, 'stock' => 10],
            ['name' => 'Fuel Pump', 'brand' => 'Delphi', 'price' => 750000, 'stock' => 25],
            ['name' => 'Alternator', 'brand' => 'Valeo', 'price' => 1500000, 'stock' => 8],
            ['name' => 'Starter Motor', 'brand' => 'Bosch', 'price' => 950000, 'stock' => 12],
            ['name' => 'Clutch Kit', 'brand' => 'Exedy', 'price' => 1800000, 'stock' => 10],
            ['name' => 'Shock Absorber', 'brand' => 'KYB', 'price' => 600000, 'stock' => 20],
            ['name' => 'Headlight Bulb', 'brand' => 'Philips', 'price' => 120000, 'stock' => 50],
            ['name' => 'Tail Light', 'brand' => 'Hella', 'price' => 450000, 'stock' => 15],
            ['name' => 'Exhaust Pipe', 'brand' => 'Walker', 'price' => 700000, 'stock' => 10],
            ['name' => 'Wheel Bearing', 'brand' => 'SKF', 'price' => 300000, 'stock' => 25],
            ['name' => 'Brake Disc', 'brand' => 'Brembo', 'price' => 500000, 'stock' => 20],
            ['name' => 'Fuel Injector', 'brand' => 'Bosch', 'price' => 950000, 'stock' => 15],
            ['name' => 'AC Compressor', 'brand' => 'Denso', 'price' => 2500000, 'stock' => 5],
            ['name' => 'Radiator Hose', 'brand' => 'Gates', 'price' => 150000, 'stock' => 30],
            ['name' => 'Engine Mount', 'brand' => 'Anchor', 'price' => 400000, 'stock' => 20],
            ['name' => 'Drive Belt', 'brand' => 'Dayco', 'price' => 200000, 'stock' => 35],
            ['name' => 'Thermostat', 'brand' => 'Stant', 'price' => 180000, 'stock' => 25],
            ['name' => 'Water Pump', 'brand' => 'Aisin', 'price' => 750000, 'stock' => 15],
            ['name' => 'Oxygen Sensor', 'brand' => 'Denso', 'price' => 550000, 'stock' => 10],
            ['name' => 'Ignition Coil', 'brand' => 'Delphi', 'price' => 350000, 'stock' => 20],
            ['name' => 'Turbocharger', 'brand' => 'Garrett', 'price' => 4500000, 'stock' => 3],
            ['name' => 'EGR Valve', 'brand' => 'Pierburg', 'price' => 1200000, 'stock' => 8],
            ['name' => 'Catalytic Converter', 'brand' => 'MagnaFlow', 'price' => 3000000, 'stock' => 5],
        ]);
       


        $developer = Role::firstOrCreate(['name' => 'developer', 'guard_name' => 'web']);
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
            'servicedetail',
            'reportserviceoperational',

                    
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $developer->syncPermissions(['dashboard','user', 'employee', 'customer',
            'menu','role', 'service', 'sparepart', 'serviceoperational','servicedetail', 'reportserviceoperational']);
        $admin->syncPermissions(['dashboard','user', 'employee', 'customer',
            'role', 'service', 'sparepart', 'serviceoperational','servicedetail', 'reportserviceoperational']);
        $employee->syncPermissions(['serviceoperational', 'servicedetail', 'reportserviceoperational']);

        // Create a developer user

        $developerUser = User::factory()->create([
            'name' => 'developer',
            'email' => 'dev@me',
            'password' => bcrypt('guarajadisini')
        ]);
        $developerUser->assignRole('developer');

        $admin =  User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        $admin->assignRole('admin');

        

        
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
        Submenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Service Operational',
            'route' => 'servicedetail',
            'order' => 8,
            'permission_id' => Permission::where('name', 'servicedetail')->first()->id
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


        $report = Menu::create([
            'name' => 'Report',
            'icon' => 'fa-solid fa-file',
            'route' => null,
            'order' => 4
        ]);
        Submenu::create([
            'menu_id' => $report->id,
            'name' => 'Service Operational',
            'route' => 'reportserviceoperational',
            'order' => 1,
            'permission_id' => Permission::where('name', operator: 'reportserviceoperational')->first()->id
        ]);
    }
}
