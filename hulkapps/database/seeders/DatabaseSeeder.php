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
             'name' => 'Johnny Smith',
             'email' => 'johnny@smith.com',
             'password' => bcrypt('password'),
         ]);

         $this->call(MovieSeeder::class);
         $this->call(UserMovieSeeder::class);
    }
}
