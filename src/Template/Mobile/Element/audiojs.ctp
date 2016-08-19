<!--<style>
    .audio{
        max-width: 90%;
        width: 300px;
        margin: 0.1rem auto;
        text-align: justify;
        position:relative;
    }
    .isapple{position:absolute;max-width:60%;left:20%;}
</style>
<div class="audio">
    <audio preload="auto" style="margin:10px auto;" width="100%" controls="controls">
        <source src="<?= $media ?>" type="audio/mpeg">
    </audio>
    <div class='isapple'><h3>这是一首歌。。。。。</h3></div>
</div>
-->
<!-- <div class="loadout" id="audioCell">
    <div class="m-audio">
        <div class="audio stop" onclick="play_music('audioCell', this)">
        <audio class="myMusic" height='1' width='1' loop="loop">
            <source src="/upload/news/mp3/2016-08-16/57b2ef22c8be3.mp3" type="audio/ogg">
        </audio>
    </div>
    </div>

    <div class="mc_title">
        <h3>这是一首主打歌，唱出了你和我。。。</h3>
    </div>
    <time class="timeCell"></time>
</div> -->

<div class="loadout" id="audioCell2">
    <div class="m-audio">
        <div class="audio stop" onclick="play_music('audioCell2', this)">
            <audio class="myMusic" height='1' width='1' preload="auto">
                <source src="/upload/news/mp3/2016-08-16/57b2ef22c8be3.mp3" type="audio/ogg">
            </audio>
        </div>
    </div>

    <div class="mc_title">
        <h3>这是一首主打歌，唱出了你和我。。。</h3>
    </div>
    <time class="timeCell"></time>
</div>


        <script type="text/javascript">
            function fixedSeconds(value) {
                var hs='', ms='', ss='', n = parseInt(value), h=parseInt(n/3600), m=parseInt(n/60)%60, s=parseInt(n%60);
                hs = h>0 ? h+':' : '';
                ms = m>0 ? (h >0&&m<10?'0':'')+m+':' : '0:';
                ms = m==0 && h>0 ? '00:' : ms;
                ss = s>0 ? (s<10?'0':'')+s: '00';
                return hs+ms+ss;
            }
            function play_music(id, em){
                var jid='#'+id;
                if(!window[jid]){
                    window[jid] = {
                        timer:null,
                        audio: $(jid+' .myMusic').get(0),
                        mc_play: em
                    };
                    $(jid + ' .timeCell').html('<span class="cur_time">0</span>/<span class="total_time">'+fixedSeconds(window[jid].audio.duration)+'</span>');
                    window[jid].cur_time= $(jid+' .cur_time');
                    window[jid].audio.onended = function(){
                        audio.pause();
                        mc_play.className = 'audio stop';
                        clearInterval(window[jid].timer);
                    }
                }
                var audio = window[jid].audio, mc_play=window[jid].mc_play;

                if($(mc_play).hasClass('on')){
                    audio.pause();
                    mc_play.className = 'audio stop';
                    clearInterval(window[jid].timer);
                }else{
                    audio.play();
                    mc_play.className = 'audio on';
                    window[jid].timer = setInterval(function(){
                        cur =  fixedSeconds(audio.currentTime);
                        window[jid].cur_time.html(cur);
                    },1000);
                }
            }
        </script>