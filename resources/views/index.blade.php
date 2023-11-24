@extends('layouts.header')

<div class="contets-menu body-margin-top">
    <div class="container-fluid">
        <div class="row">
        @foreach($videos as $data)
            <div class="col-lg-4 text-center">
                <div class="video-container border mb-5">
                    <a href="{{ url('/play', $data->id ) }}">
                        <div class="letterbox" style="border-radius: 10px;">
                            <img class="v-thumb" src="{{ asset('Thumbnail/' . $data->thumnail_name) }}">
                        </div>
                    </a>
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-lg-2 mt-2" style="text-align:left">
                            <img src="{{ asset('uploadIcon/' . $data->icon_filename) }}" class="icon rounded" style="width: 48px; height: 48px; filter: saturate(200%);"/>
                          </div>
                          <div class="col-lg-10 text-center">
                            <p class="h5 mt-1" style="text-align:left">{{ $data->title }}</p>
                            <p class="text-secondary align-bottom" style="text-align:left; margin:0;">{{ $data->name }}</p>
                            <p class="h5 text-secondary" style="text-align:left">{{ $data->views }}回視聴</p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
  </div>

@extends('layouts.footer')
