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
                    ->join('end_users', 'end_users.id', '=', 'events.user_id')
                    ->where('events.id', $eventId)->get();

                $maintenanceTitle='';
                $maintenanceMinute='';
                for ($i=0;$i<count($eventsjoinmaintenance);$i++)
                {
                    $maintenanceTitle = $maintenanceTitle.''.$eventsjoinmaintenance[$i]->maintenanceTitle.',';//Titleların birleştirilmesi
                    $maintenanceMinute = $maintenanceMinute.''.$eventsjoinmaintenance[$i]->maintenanceMinute.',';
                }

                $eventsjoinmaintenanceData = array(
                    'maintenanceMinute' => $maintenanceMinute,
                    'maintenanceTitle' => $maintenanceTitle,
                    'eventStart' => $eventsjoinmaintenance[0]->start,
                    'eventEnd' => $eventsjoinmaintenance[0]->end,
                    'fullname'=> $eventsjoinmaintenance[0]->fullname,
                    'country'=> $eventsjoinmaintenance[0]->country,
                    'lang'=> $eventsjoinmaintenance[0]->lang,
                    'gsm'=> $eventsjoinmaintenance[0]->gsm,
                    'email'=> $eventsjoinmaintenance[0]->email,
                );

                return response($eventsjoinmaintenanceData);
            }

            catch (\Exception $e) {

                $eventsjoinmaintenanceData += [
                    'joinError' => true,
                ];


                return response($eventsjoinmaintenanceData);
            }
        }
    }
}
