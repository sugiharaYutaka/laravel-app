@extends('layouts.header')

<script src="//cdn.jsdelivr.net/hls.js/latest/hls.min.js"></script>
<div class="contets-menu body-margin-top">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-1 col-xl-1 margin"></div>
      <div class="col-lg-8 col-xl-8 d-flex justify-content-end">
        <div class="border" style="width:100%;" >
            <div class="video-container">
                <div class="letterbox">
                    <video class="rounded-3" id="video" class="video-js vjs-default-skin"
                        src="{{ asset('Video/'. $data->filename) }}" style="width:100%;"  controls autoplay>
                    </video>
                </div>
            </div>
          <br>
          <p class="h5" style="text-align:left">{{ $data->title }}</p>
          <p class="h5 text-secondary" style="text-align:left">{{ $data->views }}回視聴</p>
        </div>

      </div>
      <div class="col-lg-4 col-xl-3 border d-flex" id="app">
        <comment-component :video-id="{{ json_encode($data->id) }}" :icon-public="{{ json_encode(asset('uploadIcon/')) }}"></comment-component>
      </div>
    </div>
  </div>
</div>

@extends('layouts.footer')
