<!DOCTYPE html>
<html lang="ja">
<head>
    <script src="https://www.academic-gihara0655.com/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link href="https://www.academic-gihara0655.com/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/index.css') }}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>
<body>
  <div class="header fixed-top">
    <div class="container-fluid">
      <div class="row border">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="col-lg-2">
            <button type="button" class="btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-menu"><span class="navbar-toggler-icon"></span></button>

            @extends('layouts.offcanvas')

            <a><img src="https://www.academic-gihara0655.com/streaming/logo1.png" style="width: 128px; height: 48px;"></a>
          </div>
          <div class="col-lg-8 aline-item-center">
              <div class="serch mx-5">
                <form class="input-group my-1 ">
                  <input type="text" class="form-control" placeholder="検索" aria-label="Search" aria-describedby="button-addon2">
                  <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                </form>
              </div>
          </div>
          <div class="col-lg-2">
            <div class="btn-group">
            @guest
              <a href="{{ route('login') }}"><button class="btn btn-outline-secondary fw-bold" type="button" id="button-addon2">ログイン</button></a>
              <a href="{{ route('register') }}"><button class="btn btn-outline-secondary fw-bold me-3" type="button" id="button-addon2" >登録</button></a>
            @else

            @endguest

            </div>

            @guest
              <a href="#modalProfile" data-bs-toggle="modal"><img src="{{ asset('uploadIcon/deff_icon.png') }}" class="img-thumbnail icon " style="width: 48px; height: 48px;"/></a>
            @else
              <a href="#modalProfile" data-bs-toggle="modal"><img src="{{ asset('uploadIcon/' . session('icon_filename')) }}" class="img-thumbnail icon " style="width: 48px; height: 48px;"/></a>
            @endguest

          </div>
        </nav>
      </div>
    </div>
  </div>


  @extends('layouts.modalProfile')
