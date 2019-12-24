<?php

use App\Models\Maintenance;
use Illuminate\Database\Seeder;

class MaintenanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Maintenance::create([
            'maintenanceTitle' => 'Küçük Bakım',
            'maintenanceMinute' => '01:00',


        ]);
    }
}
