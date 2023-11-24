
@extends('layouts.header')

<br>
<div class="contets-menu mt-5" id="app">
    <div class="container-fluid d-flex justify-content-center">
        <div class="card my-3">
            <div class="card-header">{{ __('動画アップロード') }}</div>
            <div class="card-body">
                <upload-video-component></upload-video-component>
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
        @if(session('video_error'))
        <div class="alert alert-danger">
            <p>{{ session('video_error') }}</p>
        </div>
        @endif
    </div>
</div>


@extends('layouts.footer')
