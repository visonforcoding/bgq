<style>
    .video-js{
        background-color: #000;
   		padding: 0 .1rem;
    }
</style>
<div class="wrapper">
    <div class="videocontent" style="width:90%;max-width:640px;margin:10px auto;">
        <video id="really-cool-video"  class="video-js vjs-default-skin  vjs-16-9" 
                preload="auto" width="100%" height="264"  poster="<?= $poster ?>" controls>
            <source src="<?= $media ?>" type="video/mp4">
        </video>
    </div>
</div>