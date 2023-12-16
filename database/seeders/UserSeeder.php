<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create ([
            'name' => 'Employee',
            'password' => bcrypt('123456'),
            'role_id' => 1
        ]);

        User::create ([
            'name' => 'Admin',
            'password' => bcrypt('123456'),
            'role_id' => 2
        ]);

        User::create ([
            'name' => 'Owner',
            'password' => bcrypt('123456'),
            'role_id' => 3
        ]);
    }
}
