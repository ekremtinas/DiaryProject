<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Bridges;
use Illuminate\Http\Request;

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
}
