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
            [
                'name' => 'Oferta sprzedaży laptopa',
                'description' => 'Sprzedam laptopa marki Dell, model XPS 15, rocznik 2023.',
                'price' => '2800',
                'negotiation' => true,
                'type' => 'sprzedaz',
                'publication_date' => '2024-05-20',
                'status' => 'aktualna',
                'tags' => '#laptop #Dell #sprzedam',
                'user_id' => '2',
            ],

            [
                'name' => 'Oferta wynajmu mieszkania',
                'description' => 'Wynajmę 2-pokojowe mieszkanie w centrum miasta, umeblowane, od zaraz.',
                'price' => '2000',
                'negotiation' => false,
                'type' => 'wynajem',
                'publication_date' => '2024-05-18',
                'status' => 'aktualna',
                'tags' => '#wynajem #mieszkanie #centrum',
                'user_id' => '3',
            ],

            [
                'name' => 'Oferta sprzedaży samochodu',
                'description' => 'Sprzedam samochód marki Toyota, model Corolla, rok produkcji 2022, przebieg 20 000 km.',
                'price' => '45000',
                'negotiation' => true,
                'type' => 'sprzedaz',
                'publication_date' => '2024-05-15',
                'status' => 'aktualna',
                'tags' => '#samochod #Toyota #sprzedam',
                'user_id' => '4',
            ],

            [
                'name' => 'Oferta sprzedaży roweru',
                'description' => 'Sprzedam rower górski marki Trek, kolor czarny, stan bardzo dobry.',
                'price' => '1200',
                'negotiation' => true,
                'type' => 'sprzedaz',
                'publication_date' => '2024-05-12',
                'status' => 'aktualna',
                'tags' => '#rower #Trek #sprzedam',
                'user_id' => '5',
            ],
        ]);
    }
}
