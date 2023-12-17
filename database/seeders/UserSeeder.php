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
            'name' => 'sasha',
            'password' => "123456",
            'role_id' => 1,
            'is_active' => true
        ]);

        User::create ([
            'name' => 'budi',
            'password' => "sadkjhas",
            'role_id' => 2,
            'is_active' => true
        ]);

        User::create ([
            'name' => 'admin',
            'password' => bcrypt('123456'),
            'role_id' => 3,
            'is_active' => true
        ]);
    }
}
