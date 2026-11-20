<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['full_name' => 'Maria Santos', 'email' => 'maria.santos@example.com', 'phone' => '+63 917 123 4101'],
            ['full_name' => 'John Reyes', 'email' => 'john.reyes@example.com', 'phone' => '+63 918 234 5202'],
            ['full_name' => 'Angela Cruz', 'email' => 'angela.cruz@example.com', 'phone' => '+63 919 345 6303'],
            ['full_name' => 'Paolo Mendoza', 'email' => 'paolo.mendoza@example.com', 'phone' => '+63 920 456 7404'],
            ['full_name' => 'Sofia Garcia', 'email' => 'sofia.garcia@example.com', 'phone' => '+63 921 567 8505'],
            ['full_name' => 'Luis Navarro', 'email' => 'luis.navarro@example.com', 'phone' => '+63 922 678 9606'],
        ];

        foreach ($customers as $customer) {
            Customer::updateOrCreate(['email' => $customer['email']], $customer);
        }

        $users = [
            ['username' => 'admin.jdelacruz', 'full_name' => 'Juan Dela Cruz', 'role' => 'Administrator'],
            ['username' => 'cashier.mramos', 'full_name' => 'Mika Ramos', 'role' => 'Cashier'],
            ['username' => 'manager.rlim', 'full_name' => 'Rafael Lim', 'role' => 'Manager'],
            ['username' => 'cashier.tflores', 'full_name' => 'Trisha Flores', 'role' => 'Cashier'],
            ['username' => 'inventory.csy', 'full_name' => 'Carlo Sy', 'role' => 'Inventory Staff'],
            ['username' => 'supervisor.agarcia', 'full_name' => 'Ana Garcia', 'role' => 'Supervisor'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['username' => $user['username']], $user);
        }
    }
}
