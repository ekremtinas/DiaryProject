<?php

use App\Models\Bridges;
use Illuminate\Database\Seeder;

class BridgesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bridges::create([
            'bridges_name' => 'Büyük Köprü'
        ]);
    }
}
