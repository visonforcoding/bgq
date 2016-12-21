<div class="wraper">
    <div class="detail-course-box bgff">
        <div class="title">
            <h3 class="color-items"><!--<span>01</span>--> <?= $class->title ?></h3>
        </div>
        <div class="tab-con-box tab-booking inner">
            <div class="booking-items">
                <div class="nav-title flex">
                    <div class="avatar">
                        <img src='<?= $class->mentor->avatar ?>' class="responseimg"/>
                    </div>
                    <div class="avatar-info">
                        <span><?=  $class->mentor->name ?></span> | 
                        <span><?=  $class->mentor->company ?></span> | 
                        <span><?=  $class->mentor->position ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="train-intro-detail bgff mt20">
        <div class="title flex flex_jusitify  inner" id="down">
            <h3 class="color-items">课程简述</h3>
            <div class="iconfont r-ico">&#xe666;</div>
        </div>
        <div class="con inner" id="con">
            <p class='line2'><?= $class->abstract ?></p>
        </div>
    </div>
    <?php if(file_exists(WWW_ROOT . $class->audio)): ?>
    <div class="train-audio-box bgff mt20">
        <div class="title">
            音频资料
        </div>
        <div class="con">
            <div class="audio-box">
                <div class="audio-info flex flex_jusitify">
                    <div class="playbtn iconfont" id="play"></div>
                    <div class="duration"><i id="cur">00:00</i>/<i id="duration">00:00</i></div>
                </div>
                <div class="audio-bar">
                    <div class="bar-progress">
                        <input type="range" class="range" id="range" value="0"/>
                        <audio id="audio" class="myMusic" height='1' width='1' preload="auto">
                            <source src="<?= $class->audio ?>"></source>
                        </audio>
                        <div class="play-line" id="play-line"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(file_exists(WWW_ROOT . $class->zip)): ?>
    <div class="train-intro-detail bgff mt20">
        <div class="title flex flex_jusitify  inner" id="down">
            <h3 class="">PPT课程</h3>
        </div>
        <div class="con inner ppt-box" id='pic'>
            <?php foreach($class->class_pics as $k=>$v): ?>
            <img init_src="<?= $v->pic ?>"/>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
    function fixedSeconds(value) {
        var hs = '', ms = '', ss = '', n = parseInt(value), h = parseInt(n / 3600), m = parseInt(n / 60) % 60, s = parseInt(n % 60);
        hs = h > 0 ? h + ':' : '';
        ms = m > 0 ? (h > 0 && m < 10 ? '0' : '') + m + ':' : '0:';
        ms = m == 0 && h > 0 ? '00:' : ms;
        ss = s > 0 ? (s < 10 ? '0' : '') + s : '00';
        return hs + ms + ss;
    }
    var wid = $('#range').width();
    var timer = null;
    var audio = $('#audio').get(0);
    var cur = audio.currentTime;
    var dur = audio.duration;
    var rightLength = wid - (wid * cur) / dur + 'px';
    $('#play-line').css('right', wid);
    $('#play').on('click', function () {
        audio = $('#audio').get(0);
        dur = audio.duration;
        cur = audio.currentTime;
        $('#duration').html(fixedSeconds(dur));
        $('#cur').html(fixedSeconds(cur));
        $('#range').attr('max', dur);
        $('#range').val(cur);
        wid = $('#range').width();
        rightLength = wid - (wid * cur) / dur + 'px';
        $('#play-line').css('right', rightLength);

        audio.onended = function () {
            audio.pause();
            $('#play').removeClass('active');
            clearInterval(timer);
        }
        if ($(this).hasClass('active')) {
            audio.pause();
            $(this).removeClass('active');

        } else {
            audio.play();
            $(this).addClass('active');
            timer = setInterval(function () {
                $('#range').on('input', function () {
                    audio = $('#audio').get(0);
                    cur = $(this).val();
                    audio.currentTime = cur;
                    console.log(cur);
                    $('#cur').html(fixedSeconds($(this).val()));
                    $("#range").val(this.value);
                    rightLength = wid - (wid * cur) / dur + 'px';
                    $('#play-line').css('right', rightLength);
                })
                dur = audio.duration;
                cur = audio.currentTime;
                $('#duration').html(fixedSeconds(dur));
                $('#cur').html(fixedSeconds(cur));
                $('#range').val(cur);
                rightLength = wid - (wid * cur) / dur + 'px';
                $('#play-line').css('right', rightLength);

            }, 1000);
        }
    });
    
    $.util.initLoadImg('pic');
    
    $('#pic img').on('click', function(){
        var imgs = [];
        $('#pic img').each(function(){imgs.push(this.src)});
        $.util.viewImg(this.src, imgs);
    });
</script>
