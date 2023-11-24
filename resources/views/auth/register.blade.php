@extends('layouts.header')

<div class="contets-menu body-margin-top">
    <div class="container-fluid d-flex justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('アカウント登録') }}</div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row my-3">
                        <div class="col-lg-12 col-xl-12">
                            <label class="h6">ユーザーネーム</label>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-12 col-xl-12">
                            <label class="h6">メールアドレス</label>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-12 col-xl-12">
                            <label class="h6">パスワード</label>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-12 col-xl-12">
                            <label class="h6">パスワード確認</label>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                            <input class="btn btn-outline-secondary fw-bold" type="submit" name="btn" value="登録">
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

@extends('layouts.footer')