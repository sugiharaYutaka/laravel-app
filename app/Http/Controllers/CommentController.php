<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Events\CommentSend;

class CommentController extends Controller
{
    public function insertComment(Request $request)
    {
        $comment = $request->comment;
        $video_id = $request->video_id;
        Comment::create([
            "video_id" => $video_id,
            "user_email" => session("email"),
            "text" => $comment,
        ]);
        broadcast(new CommentSend($comment));

    }
    public function getComment(Request $request)
    {
        $data = Comment::select([
            'comments.user_email',
            'comments.text',
            'comments.video_id',
            'comments.id',
          ])
          ->from('comments')
          ->where("video_id","=", $request->video_id)
          ->join('users', function($join) {
              $join->on('comments.user_email', '=', 'users.email');
          })
          ->orderBy('comments.id','asc')
          ->select('users.name','users.icon_filename', 'comments.*')
          ->get();
        return response()->json(["video_data" => $data]);

    }
}
