<?php

use App\Models\Events;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Events::create([
            'saveTitle' => '42 Z 17',
            'saveStart' => '2019-11-08T01:06:35',
            'saveEnd' => '2019-11-08T06:08:35',

        ]);
    }
}
