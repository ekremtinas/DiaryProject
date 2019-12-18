<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;


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
        return json_encode($data);
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

            if(Events::create($event_data)) {
              $event= Events::where($event_data)->first();
                $event_data +=[

                    'id' => $event['id']
            ];
                return response($event_data);
            }
            else{
            return back()->withInput()->with('error','Error');
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

        if(Events::where('id',$event_data['id'])->update($event_data)) {

            return response($event_data);
        }
        else{
            return back()->withInput()->with('error','Error');
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
