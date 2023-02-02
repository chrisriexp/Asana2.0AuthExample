<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tasksModel;

class tasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tasksModel::orderBy('created_at', 'DESC')->get();
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
        $newTask = new tasksModel;
        $newTask->appID = $request['appID'];
        $newTask->carrier = $request['carrier'];
        $newTask->desc = $request['desc'];
        $newTask->api = $request['api'];

        $newTask->save();

        return response()->json(["Status"=>"Success", "New Task"=>$newTask]);
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
        $existingTask = tasksModel::find($id);

        $items = ['notes', 'date-completed', 'completed'];
        $data = $request->all();

        foreach ($data as $key => $value){
            foreach ($items as $item){
                if($key == $item){
                    $existingTask->$item = $value;
                    $existingTask->save();
                }
            }
        }
        
        return response()->json(["Status"=>"Update Successful", "New Note"=>$existingTask]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
