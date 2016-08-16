<link href="/mobile/lib/videojs/video-js.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/mobile/lib/videojs/video.min.js"></script>
<style>
    .video-js{
        background-color:inherit;
    }
</style>
<div class="wrapper">
    <div class="videocontent" style="width:80%;max-width:640px;margin:10px auto;">
        <video id="really-cool-video"  class="video-js vjs-default-skin  vjs-16-9" controls
               preload="auto" width="640" height="264" 
               data-setup='{"language":"zh-CN"}' poster="<?= $poster ?>" controls>
            <source src="<?= $media ?>" type="video/mp4">
        </video>
    </div>
</div>