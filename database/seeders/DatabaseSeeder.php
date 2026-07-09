<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\TestDataSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'TamStore Admin',
            'email' => 'admin@tamstore.az',
            'password' => Hash::make('123456'),
        ]);

        $this->call(TestDataSeeder::class);
    }
}
