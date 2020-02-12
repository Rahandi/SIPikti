<?php

use Illuminate\Database\Seeder;

use Hash;
use App\User;

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
            'email' => 'admin',
            'password' => Hash::make('admin')
        ]);
    }
}
