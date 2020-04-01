<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BridgeDateTime;
use App\Models\EndUsers;
use App\Models\Events;
use App\Models\EventsJoinMaintenance;
use App\Models\Maintenance;
use App\Models\Workplace;
use App\User;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class FullCalendarController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public  function index(Request $request)
    {

             if ($request->_token==null)
                {
                    abort(404);
                }
            else {

                $data = array();
                $array = Events::all();
                foreach ($array as $row) {
                    $data[] = array(
                        'id' => $row["id"],
                        'title' => $row["title"],
                        'start' => $row["start"],
                        'end' => $row["end"],

                    );
                }

                return response($data);
            }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSelectAppoinment(Request $request)
    {


        $this->validate($request, [
            'start' => 'required',
            'end' => 'required',
            'licensePlate' => 'required',
            'fullName' => 'required',
            'email' => 'required|email',
            'gsm' => 'required',
            'country' => 'required',
            'lang' => 'required',
            'maintenance' => 'required',
        ]);

        $user_data = array(
            'license_plate'=>$request->get('licensePlate'),
            'fullname' =>  $request->get('fullName'),
            'email' => $request->get('email'),
            'gsm' => $request->get('gsm'),
            'country' => $request->get('country'),
            'lang' => $request->get('lang'),
        );
            //User Eklenmesi Start
             $endUserAdd=EndUsers::create($user_data);
            //User Eklenmesi End
             $bridgeDatetime=BridgeDateTime::where('start','<',$request->get('start'))->orderBy('start', 'desc')->first();

             $appointment_data = array(
            'title' =>  $request->get('licensePlate'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'user_id'=>$endUserAdd['id'],
            'bridge_id'=>$bridgeDatetime['bridge_id'],
            );
                 \DebugBar::info($bridgeDatetime);




            //Bakım Türünün Toplanması Start
            $minuteSum=0;
            foreach ($request->maintenance as $row)
            {
                $minute= strtotime(substr($row,1,5));
                $minuteSum=$minuteSum+$minute;
            }
            $minuteSumFormat=date('H:i:s', $minuteSum);
            //Bakım Türünün Toplanması End

            //Bakım Türünün Idlerinin Alınması Start
            $maintenanceTitle=$request->get('maintenance');
            $maintenanceId=array();
            foreach ($maintenanceTitle as $row) {

                 $maintenanceId[] = Maintenance::where('maintenanceTitle',substr($row,8))->first();
            }
            //Bakım Türünün Idlerinin Alınması End



            $start=$request->get('start');
            if (Events::where('start', $start)->first()) {/*Eventlerde Kesişmeyi Engellenmesi*/
                $appointment_data += [

                    'allDay' => true
                ];
                return response($appointment_data);
            } else {
                if (Events::create($appointment_data)) {
                    $event = Events::where($appointment_data)->first();

                    $appointment_data += [

                        'id' => $event['id']
                    ];

                    //Bakım Türünün Ara Tabloya Eklenmesi Start
                    $eventStartJoinMaintenanceTimeFormat=null;
                    for($i=0;$i<count($maintenanceId);$i++) {


                    $eventMaintenanceData = array(

                        'eventId' => $event['id'],
                        'maintenanceId' => $maintenanceId[$i]->id,
                    );

                    EventsJoinMaintenance::create($eventMaintenanceData);

                    }
                    //Bakım Türünün Ara Tabloya Eklenmesi End
                    //Bakım Türünün Toplamının Starttan Sonraya Eklenmesi Start
                    $newEvent = Events::where($appointment_data)->first();

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



                    Events::where($appointment_data)->update(['end' => $eventStartJoinMaintenanceTimeFormat]);
                    //Bakım Türünün Toplamının Starttan Sonraya Eklenmesi End


                    $appointment_data += [

                        'newTime' => $eventStartJoinMaintenanceTimeFormat
                    ];
                    return response($appointment_data);
                }
            }


    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request){

        $this->validate($request, [
            'editId'=>'required',
            'editTitle' => 'required',
            'editStart' => 'required',
            'editEnd' => 'required',


        ]);
        $event_data = array(
            'id'=>$request->get('editId'),
            'title' => $request->get('editTitle'),
            'start' => $request->get('editStart'),
            'end' => $request->get('editEnd'),
        );
        $minuteSum=0;
        foreach ($request->maintenance as $row){
            $minute= strtotime(substr($row,1,5));
            $minuteSum=$minuteSum+$minute;
        }
        $minuteSumFormat=date('H:i:s', $minuteSum);



        $maintenanceTitle=$request->get('maintenance');
        $maintenanceId=array();
        foreach ($maintenanceTitle as $row) {

            $maintenanceId[] = Maintenance::where('maintenanceTitle',substr($row,8))->first();
        }



            if (Events::where('id', $event_data['id'])->update($event_data)) {


                $EventJoinAll=EventsJoinMaintenance::where('eventId',$event_data['id'])->get();

                $eventStartJoinMaintenanceTimeFormat=null;
                EventsJoinMaintenance::where('eventId', $event_data['id'])->delete();

                for($i=0;$i<count($maintenanceId);$i++) {


                    $eventMaintenanceData = array(

                        'eventId' => $event_data['id'],
                        'maintenanceId' => "".$maintenanceId[$i]->id."",
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

                        $eventsjoinmaintenance = DB::table('events')->select('maintenance.maintenanceTitle')
                            ->join('eventsjoinmaintenance', 'events.id', '=', 'eventsjoinmaintenance.eventId')
                            ->join('maintenance', 'maintenance.id', '=', 'eventsjoinmaintenance.maintenanceId')
                            ->where('events.id', $event_data['id'])->get();
                        $maintenanceTitle = $eventsjoinmaintenance->toArray();

                        $event_data += [

                            'newTime' => $eventStartJoinMaintenanceTimeFormat,
                            'maintenanceTitle'=> $maintenanceTitle
                        ];

                    return response($event_data);
                }






             else {
                 $event_data += [

                     'errorEdit' => true
                 ];
                 return response($event_data);
            }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editTime(Request $request)
    {
        $editEvent = $request->post('Event');
        if (isset($editEvent)){

            $id = $editEvent[0];
            $start = $editEvent[1];
            $end = $editEvent[2];

            $editDB = Events::where('id',$id)->update(['start'=>$start,'end'=>$end]);
              if ($editDB) {
                return response($editEvent);
            }
            else{
                return back()->with('error','Error');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        if($id==null)
        {
            abort(404);
        }
        else {
            if (Events::find($id)->delete($id)) {
                EventsJoinMaintenance::where('eventId', $id)->delete();


                $data[] = array([
                    'id' => $id,
                ]);

                return response($data);

            } else {
                return back()->with('error', 'Error');
            }
        }
    }
    public function getWorkplace(Request $request){
        if ($request->_token==null)
        {
            abort(404);
        }
        else {

            $data = array();
            $array = Workplace::all();
            foreach ($array as $row) {
                $data[] = array(
                    'id' => $row["id"],
                    'workplaceName' => $row["workplaceName"],
                    'defaultDate' => $row["defaultDate"],
                    'minTime' => $row["minTime"],
                    'maxTime' => $row["maxTime"],
                    'weekends' => $row["weekends"],
                    'defaultView' =>$row["defaultView"]

                );
            }

            return response($data);
        }
    }
    public function postWorkplace(Request $request)
    {
        $this->validate($request, [
            'workplaceName' => 'required',
            'minTime' => 'required',
            'maxTime' => 'required',
            'defaultView' => 'required',
        ]);

        if($request->get('weekends')=='on')
        {
            $weekends=true;
        }
        else
        {
            $weekends=false;
        }
        $workplace_data = array(

            'workplaceName' => $request->get('workplaceName'),
            'defaultDate' => $request->get('defaultDate'),
            'minTime' => $request->get('minTime'),
            'maxTime' => $request->get('maxTime'),
            'weekends' => $weekends,
            'defaultView' => $request->get('defaultView'),
        );

        $id = $request->get('id');

        $workplaceEdit = Workplace::where('id',$id)->update($workplace_data);
        if ($workplaceEdit) {
            return response($workplace_data);
        }
        else{
            return back()->with('error','Error');
        }
    }
}
