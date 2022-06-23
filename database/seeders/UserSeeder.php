<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'level' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123'),
        ]);
        User::create([
            'name' => 'teknisi 1',
            'level' => 'teknisi',
            'email' => 'teknisi1@gmail.com',
            'password' => bcrypt('123123'),
        ]);
        User::create([
            'name' => 'teknisi 2',
            'level' => 'teknisi',
            'email' => 'teknisi2@gmail.com',
            'password' => bcrypt('123123'),
        ]);
    }
}
