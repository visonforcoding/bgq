<link href="/mobile/lib/videojs/video-js.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/mobile/lib/videojs/video.min.js"></script>
<video id="really-cool-video" style="width:6.4rem;height:2.64rem;margin:0 auto;" class="video-js vjs-default-skin" controls
 preload="auto" width="640" height="264" 
 data-setup='{"language":"zh-CN"}' poster="<?=$poster?>" controls>
  <source src="<?= $media ?>" type="video/mp4">
</video>