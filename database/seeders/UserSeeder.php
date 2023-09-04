<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'idoutlet' => '1',
                'nama' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('123'),
                'role' => 'admin'
            ],
            [
                'idoutlet' => '1',
                'nama' => 'kasir',
                'username' => 'kasir1',
                'password' => bcrypt('123'),
                'role' => 'kasir'
            ],
            [
                'idoutlet' => '1',
                'nama' => 'owner',
                'username' => 'owner',
                'password' => bcrypt('123'),
                'role' => 'owner'
            ],
        ];

        foreach ($user as $key => $value){
            User::create($value);
        }
    }
}
