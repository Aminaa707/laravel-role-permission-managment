<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new  Admin();
        $user->name = "anika";
        $user->email = "anika@gmail.com";
        $user->username = "anika";
        $user->password = Hash::make('12345678');
        $user->save();
    }
}
