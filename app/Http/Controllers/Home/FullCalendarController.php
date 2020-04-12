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
use mysql_xdevapi\Exception;


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


        /*  $this->validate($request, [
              'start' => 'required',
              'end' => 'required',
              'licensePlate' => 'required',
              'fullName' => 'required',
              'email' => 'required|email',
              'gsm' => 'required',
              'country' => 'required',
              'lang' => 'required',
              'maintenance' => 'required',
          ]);*/

        $user_data = array(
            'license_plate' => $request->get('licensePlate'),
            'fullname' => $request->get('fullName'),
            'email' => $request->get('email'),
            'gsm' => $request->get('gsm'),
            'country' => $request->get('country'),
            'lang' => $request->get('lang'),
        );
        $appointment_data = array();


            if(EndUsers::where('email',$user_data['email'])->first())
            {
                $appointment_data += [
                    'errorUser' =>true
                ];
                return $appointment_data;
            }
            else{
                //User Eklenmesi Start
                $endUserAdd = EndUsers::create($user_data);
                //User Eklenmesi End
            }


        $appointment_data = array(
            'title' => $request->get('licensePlate'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'user_id' => $endUserAdd['id'],

        );

        $appointmentStart = $request->get('start');
        $appointmentEnd = $request->get('end');
        $bridgeDatetime = BridgeDateTime::where('start', '<', $appointmentStart)->where('end', '>', $appointmentEnd)->orderBy('start', 'desc')->get();

       $bridgejoinappointmentControl = DB::table('bridge_datetime')
            ->join('events', 'events.bridge_id', '=', 'bridge_datetime.id')
            ->select('*', 'bridge_datetime.start as bridge_datetime_start', 'bridge_datetime.end as bridge_datetime_end', 'events.start as events_start', 'events.end as events_end')
            ->where('events.start','>=',$appointmentStart)
            ->where('events.end', '<=', $appointmentEnd)
            ->get();
        $bridgejoinappointmentControl=$bridgejoinappointmentControl->toArray();

        $bridgejoinappointment = DB::table('bridge_datetime')
        ->join('events', 'events.bridge_id', '=', 'bridge_datetime.id')
        ->select('*', 'bridge_datetime.start as bridge_datetime_start', 'bridge_datetime.end as bridge_datetime_end', 'events.start as events_start', 'events.end as events_end')
        ->where('events.start', '<=', $appointmentStart)
        ->where('events.end', '>=', $appointmentEnd)
        ->get();

        $appointmentInBridgeFiltered=$bridgejoinappointment->toArray();//Seçilen alanın altındaki randevular
        $bridgeDatetimeArray = $bridgeDatetime->toArray();//Bu seçilen alanın dışındakidaki tüm bridgeler

        $diffAppointmentSmall= array_diff_key($bridgejoinappointmentControl,$appointmentInBridgeFiltered);//İki Array'den key ile çıkarma işlemi burda event'ten daha küçük olan randevular alındı.
        $appointmentInBridgeCombine=array_merge($diffAppointmentSmall,$appointmentInBridgeFiltered);//Burda Eventten daha küçük olan randevuları daha önceki randevularla birleştirme işlemi yapıldı
        $diffAppointment= array_diff_key($bridgeDatetimeArray,$appointmentInBridgeCombine);//İki Array'den key ile çıkarma işlemi

            foreach ($diffAppointment as $raw)//Boş olan bridge'e randevu atanması
            {
                if($raw['id']!=null) {
                    $appointment_data += [
                        'bridge_id' => $raw['id']
                    ];
                }
            }




                if (count($appointment_data) == 5)//Bridgeler dolduktan sonra bilgilendirme mesajı
                {
                    //Bakım Türünün Toplanması Start
                    $minuteSum = 0;
                    foreach ($request->maintenance as $row) {
                        $minute = strtotime(substr($row, 1, 5));
                        $minuteSum = $minuteSum + $minute;
                    }
                    $minuteSumFormat = date('H:i:s', $minuteSum);
                    //Bakım Türünün Toplanması End

                    //Bakım Türünün Idlerinin Alınması Start
                    $maintenanceTitle = $request->get('maintenance');
                    $maintenanceId = array();
                    foreach ($maintenanceTitle as $row) {

                        $maintenanceId[] = Maintenance::where('maintenanceTitle', substr($row, 8))->first();
                    }
                    //Bakım Türünün Idlerinin Alınması End


                    if (Events::create($appointment_data)) {
                        $event = Events::where($appointment_data)->first();

                        $appointment_data += [

                            'id' => $event['id']
                        ];

                        //Bakım Türünün Ara Tabloya Eklenmesi Start
                        $eventStartJoinMaintenanceTimeFormat = null;
                        for ($i = 0; $i < count($maintenanceId); $i++) {


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

                  else
                    {
                        \Debugbar::info( 'boş');
                        EndUsers::where('id', $appointment_data['user_id'])->delete();

                        $appointment_data += [
                            'errorBridge' =>true
                        ];
                        return $appointment_data;
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
             $eventSelect= Events::where('id',$id)->select('user_id')->first();
            if (Events::find($id)->delete($id)) {
                EventsJoinMaintenance::where('eventId', $id)->delete();
                EndUsers::where('id', $eventSelect->user_id)->delete();//Kullanıcı Silinmesi
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
