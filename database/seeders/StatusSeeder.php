<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'status_state' => "unpaid"
        ]); 
        Status::create([
            'status_state' => "paid"
        ]); 
        Status::create([
            'status_state' => "cooking"
        ]); 
        Status::create([
            'status_state' => "needserved"
        ]); 
        Status::create([
            'status_state' => "served"
        ]); 
        Status::create([
            'status_state' => "cancelled"
        ]); 
    }
}
