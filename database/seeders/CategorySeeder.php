<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => "Mie"],
            ['name' => "Rice Bowl"],
            ['name' => "Lalapan"],
            ['name' => "Snacks"],
            ['name' => "Cofee"],
            ['name' => "Non Cofee"],
            ['name' => "Tea Series"],
            ['name' => "Wedang Series"],
            ['name' => "Mojito Series"],
            ['name' => "Beer House"],
            ['name' => "Special Offer Beer"],
            ['name' => "Beer Tower"],
        ]);
    }
}
