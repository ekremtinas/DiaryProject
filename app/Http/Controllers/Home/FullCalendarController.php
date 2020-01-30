<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\EventsJoinMaintenance;
use App\Models\Maintenance;
use App\Models\Workplace;
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
    public function create(Request $request)
    {


        $this->validate($request, [
            'saveTitle' => 'required',
            'saveStart' => 'required',
            'saveEnd' => 'required',
        ]);
        $event_data = array(

            'title' => $request->get('saveTitle'),
            'start' => $request->get('saveStart'),
            'end' => $request->get('saveEnd'),
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
        $saveStart=$request->get('saveStart');





            if (Events::where('start', $saveStart)->first()) {
                $event_data += [

                    'allDay' => true
                ];
                return response($event_data);
            } else {
                if (Events::create($event_data)) {
                    $event = Events::where($event_data)->first();

                    $event_data += [

                        'id' => $event['id']
                    ];


                    $eventStartJoinMaintenanceTimeFormat=null;
                    for($i=0;$i<count($maintenanceId);$i++) {


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

                $eventStartJoinMaintenanceTimeFormat=null;
                for($i=0;$i<count($maintenanceId);$i++) {


                    $eventMaintenanceData = array(

                        'eventId' => $event_data['id'],
                        'maintenanceId' => "".$maintenanceId[$i]->id."",
                    );

                    EventsJoinMaintenance::where('eventId',$event_data['id'])->update($eventMaintenanceData);


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
