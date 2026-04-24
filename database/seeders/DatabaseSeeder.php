<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@gmail.com',
            'type' => 'admin',
            'telephone' => '085294532451'
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'type' => 'user',
            'telephone' => '081313043986'
        ]);
    }
}
