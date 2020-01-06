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
        if ($request==null)
        {
            abort(404);
        }
        else {
            $eventId = $request->get('id');
            $eventsjoinmaintenance = null;
            $eventsjoinmaintenanceData = array();
            try {
                $eventsjoinmaintenance = DB::table('events')
                    ->join('eventsjoinmaintenance', 'events.id', '=', 'eventsjoinmaintenance.eventId')
                    ->join('maintenance', 'maintenance.id', '=', 'eventsjoinmaintenance.maintenanceId')
                    ->where('events.id', $eventId)->get();

                $eventsjoinmaintenanceData = array(
                    'maintenanceMinute' => $eventsjoinmaintenance[0]->maintenanceMinute,
                    'maintenanceTitle' => $eventsjoinmaintenance[0]->maintenanceTitle,
                    'eventStart' => $eventsjoinmaintenance[0]->start,
                    'eventEnd' => $eventsjoinmaintenance[0]->end
                );

                return response($eventsjoinmaintenanceData);
            } catch (\Exception $e) {
                abort(404);
                $eventsjoinmaintenanceData += [
                    'joinError' => true,
                ];


                return response($eventsjoinmaintenanceData);
            }
        }
    }
}
