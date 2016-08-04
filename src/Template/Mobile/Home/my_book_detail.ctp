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
            <li>
                <span><?=$subject->price?>元/次</span>
                <span>约<?=$subject->last_time?>小时</span>
            </li>
            <li>
                <p>
                    <?=$subject->summary?>
                </p>
            </li>
        </ul>
    </section>
    <?php if($book->status==1):?>
    <a href="/wx/meet-pay/1/<?=$book->lmorder->id?>" class="nextstep">去付款</a>
    <?php endif;?>
    <?php if($book->status==0):?>
        <a href="javascript:void(0)" class="nextstep" id="cancel">取消预约</a>
    <?php endif;?>
</div>
<?php $this->start('script'); ?>
<script>
    $('#cancel').on('tap',function(){
        $.util.ajax({
            url: '/home/cancelMeeting/<?=$book->id?>',
            func: function(res){
                $.util.alert(res.msg);
                if(res.status){
                    setTimeout(function(){
                        location.href = '/home/my-book';
                    }, 2000);
                }
            }
        });
    });
</script>
<?php $this->end('script');