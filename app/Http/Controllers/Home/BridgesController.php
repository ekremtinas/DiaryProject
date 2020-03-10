<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BridgeDateTime;
use App\Models\Bridges;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class BridgesController extends Controller
{
    public function bridgesGet()
    {
        $bridges_data=array();
        try {
            $bridges_data=Bridges::all();
            return response($bridges_data);
        }
        catch (\Exception $e)
        {
            return $e;
        }

    }
    public function bridgesAdd(Request $request)
    {
        $this->validate($request, [
            'bridgeName' => 'required',
        ]);
        $data = array(
            'bridge_name' => $request->get('bridgeName'),
        );
        try {
            Bridges::create($data);
            $bridgesId=Bridges::where($data)->select('id')->first();
            \DebugBar::info($bridgesId->id);
            $data+=[
                'id'=>$bridgesId->id
            ];
            return response($data);
        }
        catch (\Exception $exception)
        {
            return back()->withInput()->with('error','Bridges not added');
        }
    }
    public function bridgesDelete(Request $request)
    {
        if ($request==null)
        {
            abort(404);
        }
        else {
            $this->validate($request, [
                'bridgeId' => 'required',
            ]);
            $data = array(
                'id' => $request->get('bridgeId'),
            );
            try {

                Bridges::where($data)->delete();
                return response($data);
            }
            catch (\Exception $exception)
            {
                return back()->withInput()->with('error', 'Bridges not deleted');
            }
        }
    }
    public function bridgesEdit(Request $request)
    {
        if ($request==null)
        {


            abort(404);
        }
        else {

            $this->validate($request, [
                'bridgeIdEdit' => 'required',
                'bridgeNameEdit' => 'required',
            ]);
            $data = array(
                'id' => $request->get('bridgeIdEdit'),
                'bridge_name' => $request->get('bridgeNameEdit'),
            );
            try {

                Bridges::where('id',$data['id'])->update($data);
                return response($data);
            }
            catch (\Exception $exception)
            {
                return back()->withInput()->with('error', 'Bridges not edited');
            }
        }
    }
    //Bridge Date Time Eklenmesi İşlemi

    public function bridgeDTAdd(Request $request){

        \DebugBar::info($request);

        $this->validate($request, [
            'bridge_name' => 'required',
            'bridge_id' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        $bridge_data = array(

            'bridge_id'=>$request->get('bridge_id'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
        );
        $bridgeName=$request->get('bridge_name');
        try
        {
            BridgeDateTime::create($bridge_data);
            $bridge_data+=[
                'bridge_name'=>$bridgeName
            ];
            return response($request);
        }
        catch (Exception $exception){
            return back()->withInput()->with('error', 'Bridge DateTime not add');
        }
    }
    public  function bridgeDTGet(Request $request)
    {
        $data = array();
        $array = BridgeDateTime::all();

        foreach ($array as $row) {

            $bridgejoinbridgedt = DB::table('bridge_datetime')->select('bridges.bridge_name')
                ->join('bridges', 'bridge_datetime.bridge_id', '=', 'bridges.id')
                ->where('bridge_datetime.id', $row["id"])->get();
            $bridgeName = $bridgejoinbridgedt[0]->bridge_name;

            \DebugBar::info($bridgeName);
            $data[] = array(
                'id' => $row["id"],
                'title' => $bridgeName,
                'start' => $row["start"],
                'end' => $row["end"],

            );
        }

        return response($data);
    }
    public function bridgeEditTime(Request $request)
    {
        $editEvent = $request->post('Event');
        if (isset($editEvent)){

            $id = $editEvent[0];
            $start = $editEvent[1];
            $end = $editEvent[2];

            $editDB = BridgeDateTime::where('id',$id)->update(['start'=>$start,'end'=>$end]);
            if ($editDB) {
                return response($editEvent);
            }
            else{
                return back()->with('error','Error');
            }
        }
    }


}
