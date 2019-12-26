<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\EventsJoinMaintenance;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsJoinMaintenanceController extends Controller
{
    public function getEventsJoinMaintenance(Request $request)
    {
        $eventId=$request->get('id');

       try {
           $eventsjoinmaintenance = DB::table('events')
               ->join('eventsjoinmaintenance', 'events.id', '=', 'eventsjoinmaintenance.eventId')
               ->join('maintenance', 'maintenance.id', '=', 'eventsjoinmaintenance.maintenanceId')
               ->where('events.id', $eventId)->get();
           $eventsjoinmaintenanceData = array(
               'maintenanceMinute' => $eventsjoinmaintenance[0]->maintenanceMinute,
               'maintenanceTitle' => $eventsjoinmaintenance[0]->maintenanceTitle
           );
           return response($eventsjoinmaintenanceData);
       }
       catch (\Exception $e)
       {
           return response(false);
       }

    }
}
