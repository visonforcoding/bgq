<script type="text/javascript" src="/mobile/lib/audiojs/audio.min.js"></script>
<script>
  audiojs.events.ready(function() {
    var as = audiojs.createAll();
  });
</script>
<style>
    .audiojs{
        margin:0rem auto;
    }
    .audiojs .play{
        background-position: -9px -8px !important;
    }
    .audiojs .pause{
        background-position: -9px -97px !important;
    }
</style>
<audio  src="<?=$media?>" preload="auto" />