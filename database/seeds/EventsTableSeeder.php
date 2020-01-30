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
            'title' => '42 Z 17',
            'start' => '2019-11-08T01:06:35',
            'end' => '2019-11-08T06:08:35',

        ]);
    }
}
