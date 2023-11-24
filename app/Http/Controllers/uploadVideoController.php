<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UploadVideoController extends Controller
{
    public function show()
    {
        return view("uploadVideo");
    }
    private function createThumbnail($videoName,$thumbnailName) {
        // FFmpegコマンドを構築
        $thumbnailPath = public_path('Thumbnail') . $thumbnailName;
        $videoPath = public_path('Video') . $videoName;
        //$ffmpegCommand = "ffmpeg -i " . $videoPath . " -ss 00:00:01.000 -vframes 1 " .$thumbnailPath;
        //$ffmpegCommand = "C:\\xampp\\htdocs\\bin\\ffmpeg.exe -i  C:\\test-app6\\public\\Video\\" . $videoName . " -ss 00:00:01.000 -vframes 1 C:\\test-app6\\public\\Thumbnail\\" .$thumbnailName ;
        //$ffmpegCommand = "D:\\xampp\\htdocs\\bin\\ffmpeg.exe -i  D:\\test-app6\\public\\Video\\" . $videoName . " -ss 00:00:01.000 -vframes 1 D:\\test-app6\\public\\Thumbnail\\" .$thumbnailName ;
        //$ffmpegCommand = "/usr/bin/ffmpeg -i  " . $videoPath . " -ss 00:00:01.000 -vframes 1" .$thumbnailPath ;
        $ffmpegCommand = "/usr/bin/ffmpeg -i  /laravelApp/test-app6/laravel-app/public/Video/" . $videoName . " -ss 00:00:01.000 -vframes 1 /laravelApp/test-app6/laravel-app/public/Thumbnail/" .$thumbnailName;

        // FFmpegコマンドを実行
        shell_exec($ffmpegCommand);
    }
    public function uploadVideo(Request $request)
    {

        $redirectTo = "/uploadVideo";
        $validateData = null;
        if ($request->hasFile('video')) {
            $this->$validateData['video'] = 'required|mimetypes:video/*|max:307200';
        }
        if ($request->hasFile('thumbnail')) {
            $this->$validateData['thumbnail'] = 'image|max:5120';
        }
        if ($request->hasFile('title')) {
            $this->$validateData['title'] = 'required|string|max:65';
        }
        $validator = Validator::make($request->all(), $this->$validateData);

        if ($validator->fails()) {
            if( $validator->errors()->get('video'))
            {
                session()->flash('video_error', implode(', ', $validator->errors()->get('video')));
            }
            if( $validator->errors()->get('thumbnail'))
            {
                session()->flash('thumbnail_error', implode(', ', $validator->errors()->get('thumbnail')));
            }
            if( $validator->errors()->get('title'))
            {
                session()->flash('title_error', implode(', ', $validator->errors()->get('title')));
            }
            return response()->json(['redirectTo' => $redirectTo]);
        }


        $success_message = null;
        $thumbnailName = '';

        $video = $request->file('video');
        //ffmpegが半角スペースに対応してないので置換する
        $videoName = time() . str_replace(' ', '', $video->getClientOriginalName() );
        $video->move(public_path('Video'), $videoName);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            //ffmpegが半角スペースに対応してないので置換する
            $this->$thumbnailName = time() . str_replace(' ', '', $thumbnail->getClientOriginalName());
            $thumbnail->move(public_path('Thumbnail'), $this->$thumbnailName);
        }
        else
        {
            $this->$thumbnailName = $videoName . 'thumbnail.png';
            $this->createThumbnail($videoName, $this->$thumbnailName);
        }

        $success_message = "動画がアップロードされました";


        Video::create([
            'filename' => $videoName,
            'thumnail_name' => $this->$thumbnailName,
            'title' => $request->title,
            'email' => session('email'),
        ]);

        if($success_message)
        {
            session()->flash("success_message",$success_message);
        }
        return response()->json(['redirectTo' => $redirectTo]);

    }
}
