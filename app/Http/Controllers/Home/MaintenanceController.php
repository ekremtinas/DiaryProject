<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\EventsJoinMaintenance;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class MaintenanceController extends Controller
{
    public function getMaintenance(Request $request)
    {
        if ($request->_token==null)
        {
            abort(404);
        }
        else {
            try {
                $maintenanceData = Maintenance::all();
                return response($maintenanceData);
            } catch (Exception $e) {
                return $e;
            }
        }
    }
    public function addMaintenance(Request $request)
    {
        $this->validate($request, [
            'maintenanceTitle' => 'required',
            'maintenanceMinute' => 'required',
        ]);
        $data = array(
            'maintenanceTitle' => $request->get('maintenanceTitle'),
            'maintenanceMinute' => $request->get('maintenanceMinute'),
        );
        try {
            Maintenance::create($data);
            return response($data);
        }
        catch (\Exception $exception)
        {
            return back()->withInput()->with('error','Maintenance not added');
        }
    }
    public function editMaintenance(Request $request)
    {
        $this->validate($request, [
            'maintenanceEditTitleOld' => 'required',
            'maintenanceEditTitle' => 'required',
            'maintenanceEditMinute' => 'required',
        ]);
        $data = array(
            'maintenanceTitle' => $request->get('maintenanceEditTitle'),
            'maintenanceMinute' => $request->get('maintenanceEditMinute'),
        );
        $maintenanceEditTitleOld=$request->get('maintenanceEditTitleOld');
        try {
            Maintenance::where('maintenanceTitle',$maintenanceEditTitleOld)->update($data);
            return response($data);
        }
        catch (\Exception $exception)
        {
            return back()->withInput()->with('error','Maintenance not added');
        }
    }
    public function deleteMaintenance(Request $request)
    {
        if ($request==null)
        {
            abort(404);
        }
        else {
            $this->validate($request, [
                'maintenanceDeleteTitle' => 'required',
            ]);
            $data = array(
                'maintenanceTitle' => $request->get('maintenanceDeleteTitle'),
            );
            try {
                $maintenanceId = Maintenance::where($data)->first();

                EventsJoinMaintenance::where('maintenanceId', $maintenanceId['id'])->delete();
                Maintenance::where($data)->delete();

                return response($data);
            } catch (\Exception $exception) {
                return back()->withInput()->with('error', 'Maintenance not deleted');
            }
        }
    }
}
