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
        User::create(['name' => 'messi', 'email' => 'messi@gmail.com','password' => '12345678']);
        User::create(['name' => 'zidane', 'email' => 'zidane@gmail.com','password' => '12345678']);
        User::create(['name' => 'maradona', 'email' => 'maradona@gmail.com','password' => '12345678']);
    }
}
