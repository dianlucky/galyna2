<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => password_hash('indigo123', PASSWORD_DEFAULT),
                'role' => 'admin'
            ],
            [
                'name' => 'Adi Aulia Rahman',
                'email' => 'adi@gmail.com',
                'password' => password_hash('indigo123', PASSWORD_DEFAULT),
                'role' => 'admin'
            ],
            [
                'name' => 'User',
                'email' => 'user01@gmail.com',
                'password' => password_hash('user01', PASSWORD_DEFAULT),
            ]
        ];

        DB::table('user')->insert($users);
    }
}
