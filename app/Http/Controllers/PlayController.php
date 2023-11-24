<?php

namespace App\Http\Controllers;
use App\Video;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    /**
    * 引数で指定したvideoのデータを返す
    * @param string $ID 取得したいvideoのID
    *
    * @return mixed   videoの情報
    */
    private function getVideo($ID)
    {
        $data = Video::where('ID', '=', $ID)->first();
        return $data;
    }
    private function incrementViews($video)
    {
        $views = $video->views;
        $views += 1;
        Video::where('id', '=',$video->id)->update([
            'views' => $views,
        ]);
    }
    public function show($id)
    {
        $data = $this->getVideo($id);
        $this->incrementViews($data);
        return view("play",compact("data"));
    }
}
