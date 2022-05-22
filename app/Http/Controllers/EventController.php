<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\ResponseController;

class EventController extends ResponseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events =  Event::withTrashed()->get();
        $data["data"] = $events;
        $data["msg"] = "Success";
        $data["status"] = 1;
        return $this->successResponse($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return  [
                'data'=>[],
                'errors'=>$validator->messages(),
            ];
        }

        $insert = [
            'name' => $request->name,
            'slug' => str::slug($request->name.date("YmdHis"))
        ];

        $eventId = Event::insertGetId($insert);

        $data["event_id"] = $eventId;
        $data["msg"] = "Event Created successfully";
        $data["status"] = 1;
       
        return $this->successResponse($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);

        $data["data"] = $event;
        $data["msg"] = "Success";
        $data["status"] = 1;
        return $this->successResponse($data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $event = Event::find($id);
        if ($event && $request->name && $request->isMethod('PATCH')) {
            $event->name = $request->name;
            $event->slug = str::slug($request->name.date("YmdHis"));
            $event->save();
        }

        elseif($request->isMethod('PUT')){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
            ]);

            $event = Event::updateOrCreate(
                [
                    'id'   => $id,
                ],
                [
                    'name' => $request->name,
                    'slug' => str::slug($request->name.date("YmdHis"))
                ]
            );
        }

        $data["data"] = $event;
        $data["msg"] = "Success";
        $data["status"] = 1;
        return $this->successResponse($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find( $id );
        $event->delete();

        $data["msg"] = "Success";
        $data["status"] = 1;
        return $this->successResponse($data);
    }

    /**
     * Get Active Events within From and To date.
     */
    public function activeEvents(Request $request){
        $startDate = date('Y-m-d 00:00:00',strtotime($request->startDate));
        $endDate = date('Y-m-d 23:59:59',strtotime($request->endDate));
        $activeEvents = Event::whereBetween('created_at', [$startDate, $endDate])->get();

        $data["data"] = $activeEvents;
        $data["msg"] = "Success";
        $data["status"] = 1;
        return $this->successResponse($data);
    }
}