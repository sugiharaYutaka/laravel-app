
@extends('layouts.header')

<br>
<div class="contets-menu mt-5" id="app">
    <div class="container-fluid d-flex justify-content-center ">
        <br>
        <div class="card my-3">
            <div class="card-header">{{ __('アカウント情報') }}</div>
            <div class="card-body">
                <form>
                <div class="row my-3">
                    <div class="col-lg-12 col-xl-12">
                        <label class="h6 ">ユーザーネーム</label>
                    </div>
                    <div class="col-lg-12 col-xl-12">

                        <input class="form-control" type="text" id="userName" name="name" value="{{ session('name') }}" readonly>

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-lg-12 col-xl-12">
                        <label class="h6">メールアドレス</label>
                    </div>
                    <div class="col-lg-12 col-xl-12">

                        <input class="form-control" type="text" id="emailAddress" name="email" value="{{ session('email') }}" readonly>

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-lg-12 col-xl-12">
                        <label class="h6">ストリームキー</label>
                    </div>
                    <div class="col-lg-12 col-xl-12">

                        <input class="form-control" type="text" id="passConfirm" name="pass_confirm" value="{{ session('stream_key') }}" readonly>

                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-lg-12 col-xl-12">
                        <label class="h6">アイコン(1MB未満)</label>
                    </div>
                    <div class="col-lg-12 col-xl-12 custom-file">
                        <div class="custom-file">

                            <input  type="file"  class="form-control" name="icon" readonly>

                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center">
        <div class="card my-3">
            <div class="card-header">{{ __('アカウント情報変更') }}</div>
            <div class="card-body">
                <account-component></account-component>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center">
        @if(session('success_message'))
        <div class="d-flex align-items-center">
            <div class="card m-5">
                <div class="card-body alert-success ">
                    <strong class="fw-bold d-flex justify-content-center mx-4" style='margin:0;'>{{ session('success_message') }}</strong>
                </div>
            </div>
        </div>
        @endif
        @if(session('error_message'))
        <div class="d-flex align-items-center">
            <div class="card m-5">
                <div class="card-body alert-warning ">
                    <strong class="fw-bold d-flex justify-content-center mx-4" style='margin:0;'>{{ session('error_message') }}</strong>
                </div>
            </div>
        </div>
        @endif
        @if(session('user_name_error') || session('user_icon_error'))
        <div class="alert alert-danger">
            <ul>
                @if(session('user_icon_error'))
                <li>{{ session('user_icon_error') }}</li>
                @endif
                @if(session('user_name_error'))
                <li>{{ session('user_name_error') }}</li>
                @endif
            </ul>
        </div>
        @endif
    </div>
</div>


@extends('layouts.footer')
