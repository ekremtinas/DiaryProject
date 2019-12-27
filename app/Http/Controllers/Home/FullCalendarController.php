<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\EventsJoinMaintenance;
use App\Models\Maintenance;
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
    public  function index()
    {
        $data =array();
        $array= Events::all();
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
            'maintenanceTitle'=>'required',
        ]);
        $event_data = array(

            'title' => $request->get('saveTitle'),
            'start' => $request->get('saveStart'),
            'end' => $request->get('saveEnd'),
        );
        $maintenanceTitle=$request->get('maintenanceTitle');
        $maintenanceId=Maintenance::where('maintenanceTitle',$maintenanceTitle)->first();
        $saveStart=$request->get('saveStart');
        $saveEnd=$request->get('saveEnd');





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
                    $eventMaintenanceData = array(

                        'eventId' => $event['id'],
                        'maintenanceId' => $maintenanceId['id'],
                    );

                    if (EventsJoinMaintenance::create($eventMaintenanceData)) {
                        $eventsjoinmaintenance = DB::table('events')
                            ->join('eventsjoinmaintenance', 'events.id', '=', 'eventsjoinmaintenance.eventId')
                            ->join('maintenance', 'maintenance.id', '=', 'eventsjoinmaintenance.maintenanceId')
                            ->where('events.id', $event['id'])->get();
                        $maintenanceMinute = $eventsjoinmaintenance[0]->maintenanceMinute;
                        $newEvent = Events::where($event_data)->first();


                        $maintenanceMinuteTime = Carbon::parse($maintenanceMinute, 'UTC');
                        $maintenanceMinuteTimeCarbon = $maintenanceMinuteTime->isoFormat('HH:mm');


                        $maintenanceMinuteTimeFormat = strtotime($maintenanceMinuteTimeCarbon);
                        $maintenanceMinuteTimeFormatHour = date("H", $maintenanceMinuteTimeFormat);//Sadece Saatin alınması
                        $maintenanceMinuteTimeFormatMin = strtotime($maintenanceMinuteTimeCarbon);
                        $maintenanceMinuteTimeFormatMinI = date("i", $maintenanceMinuteTimeFormatMin);//Sadece Dakikanın alınması


                        $eventStartTime = $newEvent->start;
                        $eventStartTimeFormat = strtotime($eventStartTime);

                        $eventStartJoinMaintenanceTime = strtotime("+{$maintenanceMinuteTimeFormatHour} hour +{$maintenanceMinuteTimeFormatMinI} minute", $eventStartTimeFormat);
                        $eventStartJoinMaintenanceTimeFormat = date('Y-m-d H:i:s', $eventStartJoinMaintenanceTime);


                         $queryEventUpdate= Events::where($event_data)->update(['end' => $eventStartJoinMaintenanceTimeFormat]);


                     /*   $eventsTimeSmall = Events::select('end')->where('end','<',$saveEnd)->orderBy('end', 'desc')->first();;
                        $eventsTimeBig = Events::select('start')->where('start','',$eventStartJoinMaintenanceTimeFormat)->orderBy('start', 'asc')->first();;


                        if(isset($eventsTimeBig['start']))
                        {

                            \DebugBar::info($eventsTimeSmall['end'].' - betweeen - '.$eventsTimeBig['start']);
                            $event_data += [

                                'conflict' => true
                            ];
                            return response($event_data);
                        }*/






                        $event_data += [

                            'newTime' => $eventStartJoinMaintenanceTimeFormat
                        ];
                        return response($event_data);

                    }
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
            'maintenanceTitle'=>'required',

        ]);
        $event_data = array(
            'id'=>$request->get('editId'),
            'title' => $request->get('editTitle'),
            'start' => $request->get('editStart'),
            'end' => $request->get('editEnd'),
        );

        $maintenanceTitle=$request->get('maintenanceTitle');
        $maintenanceId=Maintenance::where('maintenanceTitle',$maintenanceTitle)->first();

        $editStart=$request->get('editStart');

        if(Events::where('start',$editStart)->first())
        {
            $event_data += [

                'allDay' => true
            ];
            return response($event_data);
        }

        else {
            if (Events::where('id', $event_data['id'])->update($event_data)) {

                $eventMaintenanceData = array(

                    'eventId' => $event_data['id'],
                    'maintenanceId' => $maintenanceId['id'],
                );
                if (EventsJoinMaintenance::where('eventId',$event_data['id'])->update($eventMaintenanceData))
                {
                    $eventsjoinmaintenance = DB::table('events')
                        ->join('eventsjoinmaintenance', 'events.id', '=', 'eventsjoinmaintenance.eventId')
                        ->join('maintenance', 'maintenance.id', '=', 'eventsjoinmaintenance.maintenanceId')
                        ->where('events.id', $event_data['id'])->get();
                    $maintenanceMinute = $eventsjoinmaintenance[0]->maintenanceMinute;
                    $newEvent = Events::where($event_data)->first();


                    $maintenanceMinuteTime = Carbon::parse($maintenanceMinute, 'UTC');
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
                }



                    return response($event_data);
                }






             else {
                return back()->withInput()->with('error', 'Error');
            }
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
        if(Events::find($id)->delete($id))
        {



            $data[]=array([
                'id'=>$id,
            ]);
            return response($data);

        }
        else{
            return back()->with('error','Error');
        }
    }
}
