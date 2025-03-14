<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
            'brand' => 'Renault',
            'model' => 'Clio',
            'year' => 2020,
            'color' => 'Rouge',
            'registration_number' => 'AB-173-CD',
            'mileage' => 50000,
            'daily_rate' => 50.00,
            'availability' => true,
            'image_path' => null,
        ]);

        Car::create([
            'brand' => 'Peugeot',
            'model' => '208',
            'year' => 2021,
            'color' => 'Bleu',
            'registration_number' => 'XY-436-ZW',
            'mileage' => 30000,
            'daily_rate' => 60.00,
            'availability' => false,
            'image_path' => null,
        ]);

        Car::create([
            'brand' => 'BMW',
            'model' => 'Serie 3',
            'year' => 2022,
            'color' => 'Noir',
            'registration_number' => 'LM-719-OP',
            'mileage' => 10000,
            'daily_rate' => 100.00,
            'availability' => true,
            'image_path' => null,
        ]);
    }
}