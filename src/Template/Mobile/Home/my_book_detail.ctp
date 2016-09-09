<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            话题
        </h1>
        <!-- <a href="#this" class='iconfont share h-regiser'>&#xe614;</a> -->
    </div>
</header>
<div class="wraper">
    <div class="h20">
    </div>
    <section>
        <ul class="m-detail-box">
            <li>
                <h3><?=$subject->title?> <span><?=$subject->truename?> <?=$subject->company?> <?=$subject->position?></span></h3>
            </li>
<!--            <li>
                <span><?=$subject->price?>元/次</span>
                <span>约<?=$subject->last_time?>小时</span>
            </li>-->
            <li>
                <p>
                    <?=$subject->summary?>
                </p>
            </li>
        </ul>
    </section>
    <?php if($book->status==2):?>
        <a href="javscript:void(0)" class="nextstep">预约没通过</a>
    <?php endif;?>
    <?php if($book->status==0):?>
        <a href="javascript:void(0)" class="nextstep" id="cancel">取消预约</a>
    <?php endif;?>
</div>
<div class="reg-shadow" ontouchmove="return false;" hidden id="shadow"></div>
<div class="totips" style="height:3.6rem;" hidden id="isCancel" >
    <h3>确定要取消吗？</h3>
    <span></span>
    <a href="javascript:void(0)" class="tipsbtn" id="no">否</a><a href="javascript:void(0)" class="tipsbtn" id="yes">是</a>
</div>
<?php $this->start('script'); ?>
<script>
    if(document.URL.indexOf('#index') != -1){
        LEMON.sys.back('/meet/index');
    } else if(document.URL.indexOf('#homepage') != -1) {
        LEMON.sys.back('/user/home-page');
    }
    $('#cancel').on('tap', function(){
        setTimeout(function(){
            $('#isCancel').show();
            $('#shadow').show();
        }, 400);
    });
    $('#yes').on('tap',function(){
        $.util.ajax({
            url: '/home/cancelMeeting/<?=$book->id?>',
            func: function(res){
                if(res.status){
                    location.href = '/home/my-book';
                }
            }
        });
    });
    $('#no').on('tap', function(){
        setTimeout(function(){
            $('#isCancel').hide();
            $('#shadow').hide();
        }, 400);
    });
</script>
<?php $this->end('script');