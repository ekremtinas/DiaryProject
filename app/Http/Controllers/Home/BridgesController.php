<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Bridges;
use Illuminate\Http\Request;

class BridgesController extends Controller
{
    public function bridgesGet()
    {
        $bridges_data=array();
        try {
            $bridges_data=Bridges::all();
            return response($bridges_data);
        }
        catch (\Exception $e)
        {
            return $e;
        }

    }
}
