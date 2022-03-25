<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            [
            'name' => 'ananda bayu',
            'email' => 'bayu@gmail.com',
            'npp' => 12345,
            'npp_supervisior' => 111111,
            'password' => Hash::make('password')
            ],
            [
            'name' => 'supri',
            'email' => 'supri@gmail.com',
            'npp' => 54321,
            'npp_supervisior' => 111111,
            'password' => Hash::make('password')
            ],
            [
            'name' => 'supervisior',
            'email' => 'spv@gmail.com',
            'npp' => 11111,
            'npp_supervisior' => null,
            'password' => Hash::make('password')
            ],
        ]);
    }
}
