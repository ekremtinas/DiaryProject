<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ekrem Tınas',
            'email' => 'ekremtinas@gmail.com',
            'password' =>'123456789',
            'remember_token' => 'asdas',
        ]);
    }
}
