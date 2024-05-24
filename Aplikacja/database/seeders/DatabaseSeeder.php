<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE photos AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE offers AUTO_INCREMENT = 1');
        $this->call([
            UserSeeder::class,
            OfferSeeder::class,
            PhotoSeeder::class,
        ]);
    }
}
