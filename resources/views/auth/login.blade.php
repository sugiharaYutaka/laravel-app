@extends('layouts.header')
<div class="contets-menu body-margin-top">
    <div class="container-fluid d-flex justify-content-center">
        <div class="card">
            <div class="card-header">{{ __('ログイン') }}</div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST" >
                    @csrf
                    <div class="row my-3">
                        <div class="col-lg-12 col-xl-12">
                            <label class="h6">メールアドレス</label>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <input class="form-control" type="text" id="emailAddress" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-12 col-xl-12">
                            <label class="h6">パスワード</label>
                        </div>
                        <div class="col-lg-12 col-xl-12">
                            <input class="form-control" type="password" id="password" name="password" required autocomplete="current-password">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                            <input class="btn btn-outline-secondary fw-bold" type="submit" name="btn" value="ログイン">
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger my-5">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

@extends('layouts.footer')
