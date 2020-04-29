<?php

use Illuminate\Database\Seeder;

class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nom' => Str::random(10),
            'login' => 'fhkonan',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('adminadmin'),
        ]);
    }
}
