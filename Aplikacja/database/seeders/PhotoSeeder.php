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
                'file' => 'default.png',
                'description' => 'domyślne zdjęcie dla oferty',
                'offer_id' => '1',
            ],
            [
                'file' => 'default.png',
                'description' => 'domyślne zdjęcie dla oferty',
                'offer_id' => '2',
            ],
            [
                'file' => 'default.png',
                'description' => 'domyślne zdjęcie dla oferty',
                'offer_id' => '3',
            ],
            [
                'file' => 'default.png',
                'description' => 'domyślne zdjęcie dla oferty',
                'offer_id' => '4',
            ],
            [
                'file' => 'default.png',
                'description' => 'domyślne zdjęcie dla oferty',
                'offer_id' => '5',
            ],
        ]);
    }
}
