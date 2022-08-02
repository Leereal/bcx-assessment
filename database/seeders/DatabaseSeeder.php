<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\Role::factory()->create([
            'name' => "Admin",
            'description' => "Must have full rights",
        ]);
        \App\Models\Role::factory()->create([
            'name' => "Support",
            'description' => "Must be able to view and edit users",
        ]);
        \App\Models\Role::factory()->create([
            'name' => "Manager",
            'description' => "Must be able to create user and view user",
        ]);
        \App\Models\Role::factory()->create([
            'name' => "User",
            'description' => "Must be able to view and edit own details",
        ]);
        \App\Models\Role::factory()->create([
            'name' => "Custom",
            'description' => "Is blank must be able to do nothing",
        ]);

        \App\Models\User::factory()->create([
            'name' => "AdminName",
            'surname' => "AdminSurname",
            'username' => "Admin",
            'cell' => "27123456987",
            'email' => "admin@bcx.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'address' => "123 Address Street, Pretoria",
            'job_title' => "System Admin",
            'role_id' => 1,
            'remember_token' => Str::random(10),
        ]);
    }
}
