<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = \App\Models\Video::get();

        return response()->json([
                "msg" => "Success",
                "videos" => $videos->toArray() 
            ],200);
    }

    

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $video = new \App\Models\Video();

        $video->author = $request->author;
        $video->title = $request->title;
        $video->summary = $request->summary;
        $video->save();

        return response()->json([
                "msg" => "Success",
                "id" => $video->id 
            ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = \App\Models\Video::find($id);

        return response()->json([
                "msg" => "Success",
                "video" => $video 
            ],200);
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
        $video = \App\Models\Video::find($id);
        $video->author = $request->author;
        $video->title = $request->title;
        $video->summary = $request->summary;
        $video->save();

        return response()->json([
                "msg" => "Success",
                "video" => $video 
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = \App\Models\Video::find($id);
        $video->delete();
        return response()->json([
                "msg" => "Success"
            ],200);

    }
}
