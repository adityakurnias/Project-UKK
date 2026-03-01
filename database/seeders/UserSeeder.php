<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@giga.id',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Customer',
            'email' => 'customer@giga.id',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);
    }
}
