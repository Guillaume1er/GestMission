<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => '123456789',
            'role' => 'ADMIN',
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'USER',
            'email' => 'user@gmail.com',
            'password' => '123456789',
            'role' => 'USER',

        ]);
    }
}
