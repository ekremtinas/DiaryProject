<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BridgeDateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BridgeDateTimeController extends Controller
{
    public  function  bridgeDatetimeDelete(Request $request)
    {
        if ($request == null) {
            abort(404);
        } else {
            $this->validate($request, [
                'id' => 'required',
            ]);
            $data = array(
                'id' => $request->get('id'),
            );
            try {

                BridgeDateTime::where($data)->delete();
                return response($data);
            } catch (\Exception $exception) {
                return back()->withInput()->with('error', 'Bridge Datetime not deleted');
            }
        }
    }
        public  function  bridgeJoinAppointment(Request $request)
    {
        if ($request==null)
        {
            abort(404);
        }
        else {
            $this->validate($request, [
                'id' => 'required',
            ]);
            $data = array(
                'id' => $request->get('id'),
            );

                $id=$request->get('id');

                $bridgejoinbridgedatetime = DB::table('bridge_datetime')->where('bridge_datetime.id', $id);

                $bridgejoinappointment = DB::table('bridge_datetime')/*Bridge DateTime İle Bridgenin , Events(Appointment) ve End_Users Tablolarının Join Edilmesi*/

                     ->join('events', 'events.bridge_id', '=', 'bridge_datetime.id')
                    ->join('end_users', 'events.user_id', '=', 'end_users.id')
                    ->where('bridge_datetime.id', $id)->get();


               $bridgeDTStart=$bridgejoinbridgedatetime->select('start')->first();/*İd'si Gönderilen BridgeDateTime'in Start'ı Alındı */
                $bridgeDTEnd=$bridgejoinbridgedatetime->select('end')->first();/*İd'si Gönderilen BridgeDateTime'in End'i Alındı */

                $bridgejoinappointment=$bridgejoinappointment->where('start','>=',$bridgeDTStart->start)->where('end','<=',$bridgeDTEnd->end);/*Bridge DateTime'in Start ve End'inin Arasında Appointment(Randevu) Olanları Getirir*/
                $bridgejoinappointmentArray=$bridgejoinappointment->all();



                return response($bridgejoinappointmentArray);

        }
    }

}
