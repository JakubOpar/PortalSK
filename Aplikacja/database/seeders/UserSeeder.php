<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            User::truncate();
        });

        User::insert([[
            'name' => 'admin',
            'surname' => '-',
            'email' => '-',
            'phone_number' => '0',
            'login' => 'admin',
            'password' => Hash::make('admin'),
            'permission' => '1',
        ],

        [
            'name' => 'Jan',
            'surname' => 'Kowalski',
            'email' => 'JKowalski@email.com',
            'phone_number' => '123123123',
            'login' => 'Jkow',
            'password' => Hash::make('1234'),
            'permission' => '2',
        ],

        [
            'name' => 'Anna',
            'surname' => 'Nowak',
            'email' => 'ANowak@email.com',
            'phone_number' => '111222333',
            'login' => 'ANow',
            'password' => Hash::make('1234'),
            'permission' => '2',
        ],
    ]);

    }
}
