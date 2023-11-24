<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\Session;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    use Session;
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        return view('account');
    }
    public function updateAccount(Request $request)
    {
        $redirectTo = "/account";
        if ($request->has('user_name')) {
            $validateData['user_name'] = 'string|max:225';
        }

        if ($request->hasFile('user_icon')) {
            $validateData['user_icon'] = 'image|max:1024';
        }
        $validator = Validator::make($request->all(), $validateData);

        if ($validator->fails()) {
            if( $validator->errors()->get('user_name'))
            {
                session()->flash('user_name_error', implode(', ', $validator->errors()->get('user_name')));
            }
            if( $validator->errors()->get('user_icon'))
            {
                session()->flash('user_icon_error', implode(', ', $validator->errors()->get('user_icon')));
            }
            return response()->json(['redirectTo' => $redirectTo]);
        }


        $success_message = null;

        if($request->has('user_name'))
        {
            User::where('email', '=',session('email'))->update([
                'name' => $request->user_name,
            ]);
            $success_message = "アカウント情報が変更されました";
        }

        if($request->has('user_icon'))
        {
            $image = $request->file('user_icon');
            //時間とファイル名を結合して一意のファイル名を生成
            $imageName = time() . $image->getClientOriginalName();

            $this->deleteIconFile( session('icon_filename') );

            //update account info
            User::where('email', '=',session('email'))->update([
                'icon_filename' => $imageName,
            ]);

            // public/uploadIconに画像をアップロード
            $image->move(public_path('uploadIcon'), $imageName);
            $success_message = "アカウント情報が変更されました";
        }

        $user = User::where('email','=',session('email'))->first();
        $this->SetUserSession($user);
        if($success_message)
        {
            session()->flash("success_message",$success_message);
        }
        else
        {
            session()->flash("error_message",'アカウント情報は変更されませんでした');
        }
        return response()->json(['redirectTo' => $redirectTo]);

    }


    public function deleteIconFile($filename)
    {
    $filePath = public_path('uploadIcon/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }

}
