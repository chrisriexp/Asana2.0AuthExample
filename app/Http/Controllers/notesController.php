<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\notesModel;

class notesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return notesModel::orderBy('created_at', 'DESC')->get();
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
        $newNote = new notesModel;
        $newNote->title = $request['title'];
        $newNote->desc = $request['desc'];

        $newNote->save();

        return response()->json(["Status"=>"Success", "New Note"=>$newNote]);
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
        $existingNote = notesModel::find($id);

        $items = ['title', 'desc'];
        $data = $request->all();

        foreach ($data as $key => $value){
            foreach ($items as $item){
                if($key == $item){
                    $existingNote->$item = $value;
                    $existingNote->save();
                }
            }
        }

        return response()->json(["Status"=>"Update Successful", "New Note"=>$existingNote]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        notesModel::destroy($id);

        return response()->json(["Status"=>"Note Deleted"]);
    }
}
