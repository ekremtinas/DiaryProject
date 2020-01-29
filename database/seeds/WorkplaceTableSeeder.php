<?php

use Illuminate\Database\Seeder;

class WorkplaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Workplace::create([
            'workplaceName' => 'İş Yeri',
            'defaultDate' => '2020-01-24',
            'minTime' => '09:00:00',
            'maxTime' => '18:00:00',
            'weekends' =>true,
            'defaultView' => 'timeGridWeek',
        ]);
    }
}
