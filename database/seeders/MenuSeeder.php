<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            [
                'category_id' => 1,
                'name' => 'Mie Goreng',
                'description' => 'Mie Goreng Indonesia',
                'price' => 10000,
            ],[
                'category_id' => 1,
                'name' => 'Mie Goreng Ayam',
                'description' => 'Mie Goreng Indonesia dengan topping ayam suwir',
                'price' => 18000,
            ],[
                'category_id' => 1,
                'name' => 'Mie Goreng Spesial',
                'description' => 'Mie Goreng Indonesia dengan toping ayam dan telur',
                'price' => 20000,
            ],[
                'category_id' => 1,
                'name' => 'Mie Kuah',
                'description' => 'Mie Goreng Indonesia',
                'price' => 10000,
            ],[
                'category_id' => 1,
                'name' => 'Mie Kuah Ayam',
                'description' => 'Mie Kuah Indonesia dengan topping ayam suwir',
                'price' => 18000,
            ],[
                'category_id' => 1,
                'name' => 'Mie Kuah Spesial',
                'description' => 'Mie Kuah Indonesia dengan toping ayam dan telur',
                'price' => 20000,
            ],
        ]);
        Menu::create([
            [
                'category_id' => 2,
                'name' => 'Rice Bowl Ayam Teriaki',
                'description' => 'Rice Bowl lezat dengan Ayam Teriaki',
                'price' => 18000,
            ],[
                'category_id' => 2,
                'name' => 'Rice Bowl Ayam Lada Hitam',
                'description' => 'Rice Bowl lezat dengan Ayam lada Hitam',
                'price' => 18000,
            ],[
                'category_id' => 2,
                'name' => 'Rice Bowl Ayam BBQ',
                'description' => 'Rice Bowl lezat dengan Ayam BBQ',
                'price' => 18000,
            ],[
                'category_id' => 2,
                'name' => 'Rice Bowl Ayam Asam Manis',
                'description' => 'Rice Bowl lezat dengan Ayam Asam Manis',
                'price' => 18000,
            ],[
                'category_id' => 2,
                'name' => 'Rice Bowl Ayam Sambal Mata',
                'description' => 'Rice Bowl lezat dengan Ayam Sambal Mata',
                'price' => 18000,
            ],
        ]);

        Menu::create([
            [
                'category_id' => 3,
                'name' => 'Nasi Ayam Geprek',
                'description' => 'Nasi Ayam Geprek dengan sambal',
                'price' => 18000,
            ],
            [
                'category_id' => 3,
                'name' => 'Nasi Bakwan Penyet',
                'description' => 'Nasi Bakwan Penyet dengan sambal',
                'price' => 20000,
            ],
            [
                'category_id' => 3,
                'name' => 'Nasi 3T Penyet',
                'description' => 'Nasi Tahu, Tempe Penyet dengan sambal',
                'price' => 15000,
            ],
            [
                'category_id' => 3,
                'name' => 'Nasi 3T Telur Penyet',
                'description' => 'Nasi Tahu, Tempe, Telur Penyet dengan sambal',
                'price' => 18000,
            ],
            [
                'category_id' => 3,
                'name' => 'Nasi Putih',
                'description' => 'Nasi Putih saja',
                'price' => 4000,
            ],

        ]);

        Menu::create([
            [
                'category_id' => 4,
                'name' => 'Kentang Goreng',
                'description' => 'Kentang Goreng Crispy',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Tahu Goreng Kriuk',
                'description' => 'Tahu Goreng Kriuk Crispy',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Pisang Goreng',
                'description' => 'Pisang Goreng',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Pisang Bakar',
                'description' => 'Bisang Bakar Manis',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Ayam POK',
                'description' => 'Ayam dadu goreng',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Tempe Mendoan',
                'description' => 'Tempe Mendoam',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Singkong Goreng',
                'description' => 'Singkong Goreng',
                'price' => 10000,
            ],[
                'category_id' => 4,
                'name' => 'Sosis Bakar',
                'description' => 'Sosis Bakar',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Nugget',
                'description' => 'Nugget ayam goreng',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Roti Bakar Keju',
                'description' => 'Roti Bakar Keju',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Roti Bakar Cokelat',
                'description' => 'Roti Bakar Cokelat',
                'price' => 15000,
            ],[
                'category_id' => 4,
                'name' => 'Roti Bakar Strawberry',
                'description' => 'Roti Bakar Strawberry',
                'price' => 15000,
            ],

        ]);

        Menu::create([
            [
                'category_id' => 5,
                'name' => 'Hot Vietnam Drip',
                'description' => 'Kopi hangat dengan metode Vietnam Drip',
                'price' => 8000,
            ],[
                'category_id' => 5,
                'name' => 'Hot Vietnam Drip Susu',
                'description' => 'Kopi Susu hangat dengan metode Vietnam Drip',
                'price' => 10000,
            ],[
                'category_id' => 5,
                'name' => 'Hot Kopi Onoeiki',
                'description' => 'Kopi ala Onoeiki',
                'price' => 5000,
            ],[
                'category_id' => 5,
                'name' => 'Hot Kopi Onoeiki Susu',
                'description' => 'Kopi susu hangat ala Onoeiki',
                'price' => 8000,
            ],
            [
                'category_id' => 5,
                'name' => 'Ice Kopi Onoeiki Susu',
                'description' => 'Es Kopi Susu ala Onoeiki',
                'price' => 10000,
            ],
            [
                'category_id' => 5,
                'name' => 'Hot Kopi Tubruk Jahe',
                'description' => 'Kopi tubruk jahe hangat ala Onoeiki',
                'price' => 6000,
            ],
        ]);

        Menu::create([
            [
                'category_id' => 6,
                'name' => 'Hot Chococlate',
                'description' => 'Cokelat hangat',
                'price' => 10000,
            ],
            [
                'category_id' => 6,
                'name' => 'Ice Chocolate',
                'description' => 'Es cokelat',
                'price' => 12000,
            ],[
                'category_id' => 6,
                'name' => 'Hot Matcha',
                'description' => 'Matcha hangat ala Jepang',
                'price' => 10000,
            ], [
                'category_id' => 6,
                'name' => 'Ice Matcha',
                'description' => 'Es matcha ala Jepang',
                'price' => 12000,
            ],[
                'category_id' => 6,
                'name' => 'Hot Red Velvet',
                'description' => 'Minuman Redvelvet hangat',
                'price' => 10000,
            ], [
                'category_id' => 6,
                'name' => 'Ice Red Velvet',
                'description' => 'Minuman Redvelvet dingin',
                'price' => 12000,
            ],[
                'category_id' => 6,
                'name' => 'Hot Taro',
                'description' => 'Minuman Taro(talas) hangat',
                'price' => 10000,
            ], [
                'category_id' => 6,
                'name' => 'Ice Taro',
                'description' => 'Minuman Taro(talas) dingin',
                'price' => 12000,
            ],[
                'category_id' => 6,
                'name' => 'Hot Bubblegum',
                'description' => 'Minuman rasa permenkaret hangat',
                'price' => 10000,
            ], [
                'category_id' => 6,
                'name' => 'Ice Bubblegum',
                'description' => 'Minuman rasa perenkaret dingin',
                'price' => 12000,
            ],[
                'category_id' => 6,
                'name' => 'Jeruk Nipis Hangat',
                'description' => 'Jeruk Nipis Hangat',
                'price' => 6000,
            ], [
                'category_id' => 6,
                'name' => 'Jeruk Nipis Dingin',
                'description' => 'Jeruk Nipis Dingin',
                'price' => 7000,
            ],[
                'category_id' => 6,
                'name' => 'Jeruk Manis Hangat',
                'description' => 'Jeruk Manis Hangat',
                'price' => 7000,
            ], [
                'category_id' => 6,
                'name' => 'Jeruk Manis Dingin',
                'description' => 'Jeruk Manis Dingin',
                'price' => 8000,
            ],[
                'category_id' => 6,
                'name' => 'Jeruk Manis Dingin',
                'description' => 'Jeruk Manis Dingin',
                'price' => 8000,
            ],[
                'category_id' => 6,
                'name' => 'Jeruk Manis Dingin',
                'description' => 'Jeruk Manis Dingin',
                'price' => 8000,
            ],[
                'category_id' => 6,
                'name' => 'Es Soda Gembira',
                'description' => 'Es Soda dicampur dengan susu kental manis',
                'price' => 13000,
            ],[
                'category_id' => 6,
                'name' => 'Es Joshua',
                'description' => 'Es Extrajos dicampur dengan susu kental manis',
                'price' => 10000,
            ],[
                'category_id' => 6,
                'name' => 'Es Mega Mendung',
                'description' => 'Es Cola dicampur dengan susu kental manis',
                'price' => 10000,
            ],[
                'category_id' => 6,
                'name' => 'Air Mineral',
                'description' => 'Air Mineral',
                'price' => 5000,
            ],[
                'category_id' => 6,
                'name' => 'Air Mineral Dingin',
                'description' => 'Air Mineral Dingin',
                'price' => 5000,
            ],
        ]);


        Menu::create([
            [
                'category_id' => 1,
                'supplier_id' => 1,
                'name' => 'Sample Menu 1',
                'description' => 'This is a sample menu item.',
                'price' => 10,
                'alcohol%' => 5,
                'photo' => 'sample_photo_1.jpg',
            ],

        ]);

    }
}
