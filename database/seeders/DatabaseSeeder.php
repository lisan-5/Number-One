<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin role and default admin user (idempotent)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user = User::firstOrCreate(
            ['email' => 'admin@numberone.store'],
            ['name' => 'Admin', 'password' => Hash::make('number_1one')]
        );
        $user->assignRole($adminRole);
    }
}
