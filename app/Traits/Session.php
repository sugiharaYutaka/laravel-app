<?php

namespace App\Traits;

use Illuminate\Foundation\Auth\User;
trait Session
{
    /**
    * @param User $User  Modelから取得したUserテーブルデータ
    *
    * 引数で指定したユーザのSession変数をセットする
    *
    * user_Id , email , name , icon_filename , stream_key
    * @return void
    */
    public function SetUserSession(User $User)
    {
        session([
            "user_id" => $User->id,
            "email" => $User->email,
            "name" => $User->name,
            "icon_filename" => $User->icon_filename,
            "stream_key" => $User->stream_key,
        ]);
    }
}
