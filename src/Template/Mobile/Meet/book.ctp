<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            预约
        </h1>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
    </div>
</header>
<div class="wraper">
    <div class="h20">

    </div>
    <section>
        <ul class="m-detail-box">
            <li>
                <h3><?=$subject->title?><span><?=$subject->user->truename?> <?=$subject->user->company?> <?=$subject->user->position?></span></h3>
                <h3 class="booking-price"><?=$subject->price?>元/次 <span>约<?=$subject->last_time?>小时</span></h3>
            </li>
        </ul>
        <div class="a-form-box m-form-box">
            <ul>

                <li>
                    <i>请简略介绍需求(10-300字)</i>
                    <textarea id="summary"></textarea>
                    <i class="m-tips"><b class="iconfont"></b>详细的介绍能让专家更加了解你<span>你填的信息只有专家能看到，不会公开给其它人</span></i>
                </li>
            </ul>
        </div>
    </section>
    <a href="#this" id="submit" class="nextstep">立即约见</a>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    setTimeout(function(){
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        switch (em.id) {
            case 'submit':
                alert('我要提交了');
                var id = <?=$subject->id ?>;
                alert('我要提交了');
                var summary = $('#summary').val();
                if(!summary){
                    $.util.alert('内容不可为空');
                    return false;
                }
                $.util.ajax({
                   url:'',
                   data:{id:id,summary:summary},
                   func:function(res){
                       alert(res);
                       $.util.alert(res.msg);
                       if(res.status){
                           document.location.href='/meet/book-success';
                       }
                   }
                });
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
    },0);
</script>
<?php $this->end('script'); ?>