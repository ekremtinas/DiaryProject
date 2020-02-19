<?php

use App\Models\BridgeDateTime;
use Illuminate\Database\Seeder;

class BridgeDateTimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BridgeDateTime::create([
            'start' => '2019-11-08T01:06:35',
            'end' => '2019-11-08T06:08:35',
            'bridge_id' => '1'
        ]);
    }
}
