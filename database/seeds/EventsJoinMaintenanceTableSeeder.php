<?php

use App\Models\EventsJoinMaintenance;
use Illuminate\Database\Seeder;

class EventsJoinMaintenanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventsJoinMaintenance::create([
            'eventId' => '1',
            'maintenanceId' => '1',

        ]);
    }
}
