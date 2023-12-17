<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'tes 1',
            'banner' => 'images/tes1.png',
            'is_active' => true
        ]);
        Event::create([
            'name' => 'tes 2',
            'banner' => 'images/tes2.jpg',
            'is_active' => true
        ]);
    }
}
