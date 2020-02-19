<?php

use App\Models\EndUsers;
use Illuminate\Database\Seeder;

class EndUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EndUsers::create([
            'fullname' => 'Ekrem Tınas',
            'license_plate' => '42 FB 42',
            'country' => 'Turkey',
            'lang' => 'tr',
            'gsm' => '05423725116',
            'email' => 'ekremtinas@gmail.com',
        ]);
    }
}
