<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'ahmed hany',
            'email' => 'ahmed@gmail.com',
            'password' => Hash::make('123123123'),
            'phone_number' => '1234567890',
        ]);
    }
}
