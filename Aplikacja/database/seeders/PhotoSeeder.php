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

        Photo::insert([[
            'file'=>'item.png',
            'description'=>'zdjecie ksiazki',
            'offer_id'=>'1',
        ],
        [
            'file'=>'item2.png',
            'description'=>'zdjecie koszulki',
            'offer_id'=>'2',
        ]

    ]);
    }
}
