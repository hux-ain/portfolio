<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // IMPORTANT: Change these credentials after first login!
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@portfolio.dev'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'), // Change this after login!
                'is_admin' => true,
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info('Admin user created! Email: admin@portfolio.dev, Password: password123');
            $this->command->warn('Please change the password after first login!');
        }
    }
}
