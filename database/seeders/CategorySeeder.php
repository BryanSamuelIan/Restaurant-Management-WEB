<?php
namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
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
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
