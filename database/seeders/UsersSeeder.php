<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Alfian MRY',
            'role'=>'admin',
            'email'=>'admin123@gmail.com',
            'password'=>Hash::make('admin123'),
        ]);
    }
}
