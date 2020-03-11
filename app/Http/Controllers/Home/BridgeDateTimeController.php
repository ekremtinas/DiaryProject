<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BridgeDateTime;
use Illuminate\Http\Request;

class BridgeDateTimeController extends Controller
{
  public  function  bridgeDatetimeDelete(Request $request)
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
          try {

              BridgeDateTime::where($data)->delete();
              return response($data);
          }
          catch (\Exception $exception)
          {
              return back()->withInput()->with('error', 'Bridge Datetime not deleted');
          }
      }
  }
}
