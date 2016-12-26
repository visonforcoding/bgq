<div class="wraper">
    <div class="detail-course-box bgff">
        <div class="title">
            <h3 class="color-items"><!--<span>01</span>--> <?= $class->title ?></h3>
        </div>
        <div class="tab-con-box tab-booking inner">
            <div class="booking-items">
                <div class="nav-title flex" id='mentor_<?= $class->mentor->id ?>' mentor_id='<?= $class->mentor->id ?>'>
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
    <div class="reg-shadow" style="display: none;" id="mentorData"></div>
</div>
<script type="text/html" id="mentorTpl">
    <div class="flex flex_center fullwraper">
        <div class="alert-booking">
            <div class="tab-con-box tab-booking">
                <div class="booking-items">
                    <div class="nav-title flex">
                        <div class="avatar">
                            <img src='{#avatar#}' class="responseimg"/>
                        </div>
                        <div class="avatar-info">
                            <h3 class="user-name"><span>{#name#}</span></h3>
                            <div class="company-info">
                                <span>{#company#}</span> | 
                                <span>{#position#}</span>
                            </div>
                        </div>
                        <div class="btn-booking color-items" id="subscr_{#id#}" mentor_id="{#id#}">{#subscr_msg#}</div>
                    </div>
                    <div class="pro">
                        <p>{#introduce#}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text/javascript">
    <?php if($class->audio): ?>
    LEMON.sys.storeUrl('<?= $class->audio ?>', '<?= $class->audio_mime ?>');
    LEMON.sys.mediaPlay();
    <?php endif; ?>
    
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
    function setAudio() {
        dur = audio.duration;
        cur = audio.currentTime;
        $('#duration').html(fixedSeconds(dur));
        $('#cur').html(fixedSeconds(cur));
        $('#range').attr('max', dur);
        $('#range').val(cur);
        rightLength = wid - (wid * cur) / dur + 'px';
        console.log(rightLength)
        $('#play-line').css('right', rightLength);
    }

    function clearTimer() {
        clearInterval(timer);
        timer = null;
    }

    audio.onloadedmetadata = setAudio;
    audio.onended = function () {
        audio.pause();
        $('#play').removeClass('active');
        clearTimer();
    }

    audio.onplaying = function () {
        if(!timer) timer = setInterval(setAudio, 1000);
    }

    $('#range').on('input', function () {
        audio.currentTime = $(this).val();
        setAudio()
        audio.play();
    });
    /**
    $('#range').on('touchstart', function () {
        clearTimer();
    });
    $('#range').on('ontouchend', function () {
        audio.play();
    });
     */

    $('#play').on('click', function () {
        if ($(this).hasClass('active')) {
            audio.pause();
            $(this).removeClass('active');
        } else {
            audio.play();
            $(this).addClass('active');
        }
    });

    $.util.initLoadImg('pic');
    
    $('#pic img').on('click', function(){
        var imgs = [];
        $('#pic img').each(function(){imgs.push(this.src)});
        $.util.viewImg(this.src, imgs);
    });
    
    $.util.tap($('body'), function(e){
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if(em.id.indexOf('mentor_') != -1){
            var tapObj = $(em);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/course/get-mentor-data/"+tapObj.attr('mentor_id'),
                success: function (res) {
                    if(res.status){
                        var html = $.util.dataToTpl('', 'mentorTpl', res.data, function(d){
                            if(d.mentor_subscribe){
                                d.subscr_msg = d.mentor_subscribe.is_del ? '订阅' : '取消订阅';
                            } else {
                                d.subscr_msg = '订阅';
                            }
                            return d;
                        });
                        $('#mentorData').html(html).show();
                    }
                }
            });
        }
        if(em.id.indexOf('subscr_') != -1){
            if(!$.util.isLogin()){
                $.util.alert('请先登录');
                setTimeout(function(){location.href = '/user/login?redirect_url='+document.URL;}, 500);
                return;
            }
            var tapObj = $(em);
            $.util.ajax({
                url: '/course/subscr-mentor/'+$(em).attr('mentor_id'),
                func: function(res){
                    $.util.alert(res.msg);
                    if(res.data){
                        $('#subscr_'+tapObj.attr('mentor_id')).html('订阅');
                    } else {
                        $('#subscr_'+tapObj.attr('mentor_id')).html('取消订阅');
                    }
                }
            });
        }
        switch(em.id){
            case 'mentorData': 
                $('#mentorData').hide();
                return false;
            case 'shadow': case 'closed':
                $('#buy').toggleClass('charge-box-hide');
                setTimeout(function(){$('#shadow').hide();}, 100);//和动画一致
                break;
            case 'down':
                $('#con').find('p').toggleClass('line2');
                $(em).find('.r-ico').toggleClass('rote');
                break;
        }
    });
    
</script>
