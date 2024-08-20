<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Courier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientData = [
            ["username" => "client", "password" => Hash::make('password')],
            ["username" => fake()->unique()->userName(), "password" => Hash::make('password')],
        ];

        $courierData = [
            ["username" => "courier", "password" => Hash::make('password')],
            ["username" => fake()->unique()->userName(), "password" => Hash::make('password')],
            ["username" => fake()->unique()->userName(), "password" => Hash::make('password')],
            ["username" => fake()->unique()->userName(), "password" => Hash::make('password')],
        ];

        Client::insert($clientData);
        Courier::insert($courierData);
    }
}
