<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'maans',
            'email' => 'imel@e.mail',
            'password' => Hash::make('admin')
        ]);

        DB::table('users')->insert([
            'name' => 'meen',
            'email' => 'mail@mail.com',
            'password' => Hash::make('admin')
        ]);
    }
}
