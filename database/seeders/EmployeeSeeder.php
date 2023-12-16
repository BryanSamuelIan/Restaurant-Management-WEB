<?php

namespace Database\Seeders;

use App\Models\Employee;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Employee::create([
            ['name' => 'Anita',
                'phone' => '1234567',
                'sallary' => 10000,
                'is_active' => true],
            ['name' => 'Ari',
                'phone' => '+62 878-5310-5022',
                'sallary' => 0,
                'is_active' => true,
            ],
        ]);
    }
}
