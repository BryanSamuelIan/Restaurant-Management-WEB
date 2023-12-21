<?php

namespace Database\Seeders;

use App\Models\Payment_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment_type::create([
            'name' => "Cash"
        ]);
        Payment_type::create([
            'name' => "Debit"
        ]);
    }
}
