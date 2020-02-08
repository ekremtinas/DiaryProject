<?php

namespace App\Http\Controllers\UserHome;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\EventsJoinMaintenance;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostUserHomeController extends Controller
{
    public function index(Request $request)
    {
        $minuteSum=0;
        foreach ($request->maintenance as $row){
           $minute= strtotime(substr($row,1,5));
           $minuteSum=$minuteSum+$minute;
        }
        $minuteSumFormat=date('H:i:s', $minuteSum);

        $userEventData = array(
            'licensePlate' => $request->get('licensePlate'),
            'maintenance' => $request->get('maintenance'),
            'totalMinute'=>$minuteSumFormat,
        );
        \DebugBar::info($request->get('maintenance'));
        return response($userEventData);
    }
    public function create(Request $request)
    {


        $this->validate($request, [
            'saveTitle' => 'required',
            'saveStart' => 'required',
            'saveEnd' => 'required',
            'maintenanceMinute' => 'required'
        ]);
        $event_data = array(

            'title' => $request->get('saveTitle'),
            'start' => $request->get('saveStart'),
            'end' => $request->get('saveEnd'),

        );
        $maintenanceTitle = $request->get('maintenance');
        $maintenanceId = array();
        foreach ($maintenanceTitle as $row) {

            $maintenanceId[] = Maintenance::where('maintenanceTitle', substr($row, 11))->first();

        }

        $minuteSum = 0;
        foreach ($request->maintenance as $row) {
            $minute = strtotime(substr($row, 1, 5));
            $minuteSum = $minuteSum + $minute;
        }
        $minuteSumFormat = date('H:i:s', $minuteSum);

        if (Events::where('title', $request->saveTitle)->first()) {

            return response()->isServerError();

        }

        else
            {
            if (Events::create($event_data)) {

                $event = Events::where($event_data)->first();
                $event_data += [

                    'id' => $event['id']
                ];
                $eventStartJoinMaintenanceTimeFormat = null;
                for ($i = 0; $i < count($maintenanceId); $i++) {


                    $eventMaintenanceData = array(

                        'eventId' => $event['id'],
                        'maintenanceId' => $maintenanceId[$i]->id,
                    );
                    EventsJoinMaintenance::create($eventMaintenanceData);
                }

                $newEvent = Events::where($event_data)->first();

                $maintenanceMinuteTime = Carbon::parse($minuteSumFormat, 'UTC');//Bakım Türlerinin Dakikalarının Toplamı Event'in Start'ına Eklenmek Üzere Carbon ile parse ediliyor.
                $maintenanceMinuteTimeCarbon = $maintenanceMinuteTime->isoFormat('HH:mm');


                $maintenanceMinuteTimeFormat = strtotime($maintenanceMinuteTimeCarbon);
                $maintenanceMinuteTimeFormatHour = date("H", $maintenanceMinuteTimeFormat);//Sadece Saatin alınması
                $maintenanceMinuteTimeFormatMin = strtotime($maintenanceMinuteTimeCarbon);
                $maintenanceMinuteTimeFormatMinI = date("i", $maintenanceMinuteTimeFormatMin);//Sadece Dakikanın alınması


                $eventStartTime = $newEvent->start;
                $eventStartTimeFormat = strtotime($eventStartTime);

                $eventStartJoinMaintenanceTime = strtotime("+{$maintenanceMinuteTimeFormatHour} hour +{$maintenanceMinuteTimeFormatMinI} minute", $eventStartTimeFormat);
                $eventStartJoinMaintenanceTimeFormat = date('Y-m-d H:i:s', $eventStartJoinMaintenanceTime);


                Events::where($event_data)->update(['end' => $eventStartJoinMaintenanceTimeFormat]);


                $event_data += [

                    'newTime' => $eventStartJoinMaintenanceTimeFormat
                ];
                return response($event_data);
            }
       }
    }
}
