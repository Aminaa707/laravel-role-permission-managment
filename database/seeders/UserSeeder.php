<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $user = User::where('email', 'ani@gmail.com')->first();

        if (!($user)) {
            $user = new User();
            $user->name = "ani";
            $user->email = "ani@gmail.com";
            $user->password = Hash::make('12345678');
            $user->save();
        }
    }
}
