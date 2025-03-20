<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        User::create([
            'name' => 'Root',
            'email' => 'root@genius.com',
            'password' => Hash::make('root123'),
        ]);
    }

    public function down()
    {
        User::where('email', 'root@genius.com')->delete();
    }
}; 