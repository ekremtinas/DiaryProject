<?php

namespace App\Http\Controllers\UserHome;

use App\Http\Controllers\Controller;
use App\Models\Events;
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
            'maintenanceMinute'=>'required'
        ]);
        $event_data = array(

            'title' => $request->get('saveTitle'),
            'start' => $request->get('saveStart'),
            'end' => $request->get('saveEnd'),

        );

        $maintenanceMinute=$request->get('maintenanceMinute');

        $maintenanceMinuteTime = Carbon::parse($maintenanceMinute, 'UTC');
        $maintenanceMinuteTimeCarbon = $maintenanceMinuteTime->isoFormat('HH:mm');


        $maintenanceMinuteTimeFormat = strtotime($maintenanceMinuteTimeCarbon);
        $maintenanceMinuteTimeFormatHour = date("H", $maintenanceMinuteTimeFormat);//Sadece Saatin alınması
        $maintenanceMinuteTimeFormatMin = strtotime($maintenanceMinuteTimeCarbon);
        $maintenanceMinuteTimeFormatMinI = date("i", $maintenanceMinuteTimeFormatMin);//Sadece Dakikanın alınması


        $eventStartTime = $request->saveStart;
        $eventStartTimeFormat = strtotime($eventStartTime);


        $eventStartJoinMaintenanceTime = strtotime("+{$maintenanceMinuteTimeFormatHour} hour +{$maintenanceMinuteTimeFormatMinI} minute", $eventStartTimeFormat);
        $eventStartJoinMaintenanceTimeFormat = date('Y-m-d H:i:s', $eventStartJoinMaintenanceTime);

        if (Events::create($event_data)) {
            $event = Events::where($event_data)->first();
            Events::where($event_data)->update(['end' => $eventStartJoinMaintenanceTimeFormat]);
            $event_data += [

                'id' => $event['id']
            ];
            $event_data += [

                'newTime' => $eventStartJoinMaintenanceTimeFormat
            ];
            return response($event_data);
        }
    }
}
