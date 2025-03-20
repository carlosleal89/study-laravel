<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RootUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Root',
            'email' => 'root@genius.com',
            'password' => Hash::make('root123'),
        ]);
    }
} 