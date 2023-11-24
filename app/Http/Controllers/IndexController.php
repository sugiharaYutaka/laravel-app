<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\User;

class IndexController extends Controller
{
    private function omission($text)
    {
        $maxLength = 64; //最大文字数
        if (mb_strlen($text) > $maxLength) {
            return mb_substr($text, 0, $maxLength) . '...';
        } else {
            return $text;
        }
    }
    /**
    * 全てのvideoのデータを返す
    *
    *
    * @return mixed  videoの情報
    */
    private function getVideoJoinUser()
    {
        $data = Video::select([
            'videos.filename',
            'videos.thumnail_name',
            'videos.title',
            'videos.email',
            'videos.views',
          ])
          ->from('videos')
          ->join('users', function($join) {
              $join->on('videos.email', '=', 'users.email');
          })
          ->orderBy('videos.views','desc')
          ->limit(30)
          ->select('users.name','users.icon_filename', 'videos.*')
          ->get();
        return $data;
    }
    /**
     * 画面を表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $videos = $this->getVideoJoinUser();
        return view('index',compact("videos"));
    }
}
