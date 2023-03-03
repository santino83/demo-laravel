<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'firstname' => 'Mario',
            'lastname' => 'Rossi',
            'email' => 'demo@email.com',
            'password' => Hash::make('pass1234')
        ]);

        $this->call([
            CarouselSeeder::class,
            ThematicSeeder::class
        ]);

    }
}
