<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer des locations existantes
        $rental1 = Rental::first() ?? Rental::factory()->create();
        $rental2 = Rental::skip(1)->first() ?? Rental::factory()->create();

        // Créer des paiements
        Payment::create([
            'rental_id' => $rental1->id,
            'payment_date' => '2025-03-18',
            'amount' => 250.00,
            'payment_method' => 'credit_card',
            'transaction_id' => 'TX123456789',
        ]);

        Payment::create([
            'rental_id' => $rental2->id,
            'payment_date' => '2025-03-24',
            'amount' => 180.00,
            'payment_method' => 'paypal',
            'transaction_id' => 'TX987654321',
        ]);
    }
}