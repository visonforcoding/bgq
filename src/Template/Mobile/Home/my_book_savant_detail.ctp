<header class="m-to-more myhome">
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            <?php if($book->status==0):?>待确认<?php endif;?>
            <?php if($book->status==1):?>已确认<?php endif;?>
        </h1>
        <a href="#this" class='iconfont share h-regiser'>&#xe619;</a>
    </div>
    <div class="h-home-bottom">
        <div><span><img src="<?=  empty($book->user->avatar)?'/mobile/images/touxiang.jpg':$book->user->avatar?>"/></span><i class="iconfont">&#xe61e;</i></div>
        <h3><?=$book->user->truename?><span><?=$book->user->company?> <?=$book->user->position?></span></h3>
    </div>
</header>
<div class="m-wraper m-fixed-bottom no-margin-b">
    <ul class="h-info-box">
        <li>
            <h3>标签：<span>杨涛</span></h3>
        </li>
        <li>
            <h3>联系电话：<span><?=$book->user->phone?></span></h3>
        </li>
        <li>
            <h3>邮箱：<span><?=$book->user->email?></span></h3>
        </li>
        <li>
            <h3>行业：
                <?php foreach($book->user->industries as $industry): ?>
                    <span style="margin-left:5px;"><?=$industry->name?></span>
                <?php endforeach;?>
            </h3>
        </li>
        <li class="no-b-border">
            <h3>所在地：<span>深圳</span></h3>
        </li>
    </ul>
    <ul class="h-info-box s-title-pass">
        <li>
            <h3>约谈话题</h3>
        </li>
        <li>
            <p><?=$book->subject->title?></p>
        </li>
    </ul>
    <ul class="h-info-box s-title-pass">
        <li>
            <h3>需求介绍</h3>
        </li>
        <li>
            <p><?=$book->summary?> </p>
        </li>
    </ul>
    <?php if($book->status==0):?>
    <a id="meetOk" class="nextstep paybtn bg-change">约见通过</a>
    <a id="meetNo" class="nextstep paybtn bg-change">不通过</a>
    <?php endif;?>
</div>
<?php $this->start('script') ?>
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
            case 'meetOk':
                var book_id = <?=$book->id?>;
                $.util.ajax({
                   url:'/home/book-ok',
                   data:{id:book_id},
                   func:function(res){
                       $.util.alert(res.msg);
                   }
                });
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
    },0);
</script>
<?php $this->end('script'); ?>
