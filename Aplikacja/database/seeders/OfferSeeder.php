<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Offer::truncate();
        });

        Offer::insert([[
            'name' => 'oferta sprzedarzy ksiazki',
            'description' => 'sprzedam ksiazke "Pan Tadeusz" Adama mieckiewicza',
            'price' => '35',
            'negotiation' => true,
            'type' => 'sprzedaz',
            'publication_date' => '2024-05-23',
            'status' => 'aktualna',
            'tags' => '#book #sprzedam',
            'user_id' => '2',
        ],

        [
            'name' => 'oferta sprzedarzy koszulki',
            'description' => 'sprzedam koszulkę',
            'price' => '45',
            'negotiation' => false,
            'type' => 'sprzedaz',
            'publication_date' => '2024-05-15',
            'status' => 'zakończona',
            'tags' => '#tshirt #sprzedam',
            'user_id' => '3',
        ],
    ]);
    }
}
