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
                        <video class="rounded-3 ratio ratio-16x9" id="video" style="width:100%;" class="video-js vjs-default-skin"
                        src="{{ asset('live/' . session('stream_key') . '.m3u8') }}" controls autoplay>

                            <script type="text/javascript">
                                if(Hls.isSupported)
                                {
                                var src = "{{ asset('live/' . session('stream_key') . '.m3u8') }}";
                                var video = document.getElementById("video");
                                var hls = new Hls();
                                hls.loadSource(src);
                                hls.attachMedia(video);
                                video.play();
                                }
                            </script>
                        </video>
                    </div>
                </div>
            <br>
            <button onclick = "copy()">共有用リンクをコピー</button><textarea row="1">{{url()->current()}}</textarea>

            </div>
      </div>
      <div class="col-lg-4 col-xl-3 border d-flex" id="app">
        <comment-component></comment-component>
      </div>
    </div>
  </div>
</div>
<script>
  function copy() {
    var text = document.getElementsByTagName("textarea")[0];
    text.select();
    document.execCommand("copy");
  }
</script>
@extends('layouts.footer')
