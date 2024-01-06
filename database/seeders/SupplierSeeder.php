<?php

namespace Database\Seeders;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            [
                'name' => 'Toko Minuman Horizon',
                'address' => 'Jl. Rungkut Industri Kidul No.25, Rungkut Kidul, Kec. Rungkut, Surabaya, Jawa Timur 60293',
                'phone' => '0851-0479-5839',

            ],
            [
                'name' => 'PT. Tirta Investama Pabrik Pandaan (Aqua Danone)',
                'address' => 'Jalan Raya Surabaya - Malang km 48.5 Sukorejo, Kali Tengah, Karang Jati, Kec. Pandaan, Pasuruan, Jawa Timur 67156',
                'phone' => '(0343) 633022',
            ],
            [
                'name' => 'PT Multi Bintang Indonesia Sampangagung Plant',
                'address' => 'Jl. Raya Mojosari - Pacet Km.50 Sampang Agung Turi, Turi, Sampangagung, Kec. Kutorejo, Kabupaten Mojokerto, Jawa Timur 61383',
                'phone' => '(0321) 2800800',
            ],
            [
                'name' => 'Orang Tua Group',
                'address' => 'Jl. Panjang Jiwo No.48-50, Panjang Jiwo, Kec. Tenggilis Mejoyo, Surabaya, Jawa Timur 60299',
                'phone' => '031-8437138',
                'email'=>'customercare@ot.id'
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
