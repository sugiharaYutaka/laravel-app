<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function show($user_id)
    {
        //$video_url = env("LIVE_LOCATION") . session('stream_key') . ".m3u8";
        $video_url = "http://www.academic-gihara0655.com/streaming/live/" . session('stream_key') . ".m3u8";


        return view("live",compact("video_url"));
    }
}
