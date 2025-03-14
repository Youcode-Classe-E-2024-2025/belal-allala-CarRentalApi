<?php

namespace Database\Seeders;

use App\Models\Rental;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Car;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer des utilisateurs et des voitures existants (ou en créer si nécessaire)
        $user1 = User::first() ?? User::factory()->create(); // Récupère le premier utilisateur ou en crée un
        $user2 = User::skip(1)->first() ?? User::factory()->create(); // Récupère le deuxième utilisateur ou en crée un

        $car1 = Car::first() ?? Car::factory()->create(); // Récupère la première voiture ou en crée une
        $car2 = Car::skip(1)->first() ?? Car::factory()->create(); // Récupère la deuxième voiture ou en crée une

        // Créer des locations
        Rental::create([
            'user_id' => $user1->id,
            'car_id' => $car1->id,
            'start_date' => '2025-03-15',
            'end_date' => '2025-03-20',
            'rental_rate' => 50.00,
            'total_amount' => 250.00,
            'status' => 'active',
        ]);

        Rental::create([
            'user_id' => $user2->id,
            'car_id' => $car2->id,
            'start_date' => '2025-03-22',
            'end_date' => '2025-03-25',
            'rental_rate' => 60.00,
            'total_amount' => 180.00,
            'status' => 'completed',
        ]);

        Rental::create([
            'user_id' => $user1->id,
            'car_id' => $car2->id,
            'start_date' => '2025-04-01',
            'end_date' => '2025-04-05',
            'rental_rate' => 70.00,
            'total_amount' => 280.00,
            'status' => 'pending',
        ]);
    }
}