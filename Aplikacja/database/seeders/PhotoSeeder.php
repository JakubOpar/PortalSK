<?php

namespace Database\Seeders;

use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Photo::truncate();
        });

        Photo::insert([
            [
                'file' => 'example1.jpg',
                'description' => 'to jest przykładowe zjęcie oferty',
                'offer_id' => 1,
            ],
            [
                'file' => 'example2.jpg',
                'description' => 'to jest przykładowe zjęcie oferty',
                'offer_id' => 1,
            ],
            [
                'file' => 'example3.jpg',
                'description' => 'to jest przykładowe zjęcie oferty',
                'offer_id' => 3,
            ],
        ]);
    }
}
