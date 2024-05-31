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

        Offer::insert([
            [
                'name' => 'oferta sprzedaży ksiazki',
                'description' => 'sprzedam ksiazke "Pan Tadeusz" Adama Mickiewicza',
                'price' => '35',
                'negotiation' => true,
                'type' => 'sprzedaz',
                'publication_date' => '2024-05-15',
                'status' => 'aktualna',
                'tags' => '#book #sprzedam',
                'user_id' => '2',
            ],

            [
                'name' => 'oferta sprzedaży koszulki',
                'description' => 'sprzedam koszulkę',
                'price' => '45',
                'negotiation' => false,
                'type' => 'sprzedaz',
                'publication_date' => '2024-05-15',
                'status' => 'zakończona',
                'tags' => '#tshirt #sprzedam',
                'user_id' => '3',
            ],

            [
                'name' => 'oferta sprzedaży telefonu',
                'description' => 'sprzedam telefon marki Samsung',
                'price' => '556',
                'negotiation' => true,
                'type' => 'sprzedaz',
                'publication_date' => '2024-05-10',
                'status' => 'aktualna',
                'tags' => '#telefon #Samsung #sprzedam',
                'user_id' => '4',
            ],

            [
                'name' => 'oferta sprzedaży spódnicy',
                'description' => 'sprzedam spódnicę',
                'price' => '30',
                'negotiation' => true,
                'type' => 'sprzedaz',
                'publication_date' => '2024-05-09',
                'status' => 'zarezerwowana',
                'tags' => '#spódnica #sprzedam',
                'user_id' => '5',
            ],

            [
                'name' => 'oferta kupna podręcznika do biologi',
                'description' => 'kupię podrecznik do biologi wydawnictwa Nowa Era 8 klasa szkoły podstawowej',
                'price' => '45',
                'negotiation' => true,
                'type' => 'kupno',
                'publication_date' => '2024-05-09',
                'status' => 'aktualna',
                'tags' => '#podręcznik #biologia #szkoła',
                'user_id' => '3',
            ],
        ]);
    }
}
