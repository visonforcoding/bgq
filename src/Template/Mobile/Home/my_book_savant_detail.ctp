<header class="myhome no-bottom">
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            <?php if($book->status==0):?>待确认<?php endif;?>
            <?php if($book->status==1):?>已确认<?php endif;?>
        </h1>
        <!-- <a href="#this" class='iconfont share h-regiser'>&#xe619;</a> -->
    </div>
    
</header>
<div class="wraper">
    <div class="h-home-bottom">
        <div class="t-home-top"><span><img src="<?=  empty($book->user->avatar)?'/mobile/images/touxiang.jpg':$book->user->avatar?>"/></span></div>
        <h3><?=$book->user->truename?><i class="v"></i></h3>
        <div class="info-desc"><span><i></i><?= $book->user->company ?></span><span><i></i><?= $book->user->position ?></span></div>
    </div>
    <ul class="h-info-box">
        <li>
            <h3>标签：<em><?=$industries_str?></em></h3>
        </li>
        <li>
            <h3>联系电话：<em><?=$book->user->phone?></em></h3>
        </li>
        <li>
            <h3>邮箱：<em><?=$book->user->email?></em></h3>
        </li>
        <li>
            <h3>行业：
                <em style="margin-left:5px;">
                <?php foreach($book->user->industries as $industry): ?>
                    <?=$industry->name?>
                <?php endforeach;?>
                </em>
            </h3>
        </li>
        <li class="no-b-border">
            <h3>所在地：<em>深圳</em></h3>
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
    <a id="meetOk" href="javascript:void(0)" class="nextstep paybtn bg-change">约见通过</a>
    <a id="meetNo" href="javascript:void(0)" class="nextstep paybtn bg-change">不通过</a>
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
            var book_id = <?=$book->id?>;
            switch (em.id) {
                case 'meetOk':
                    $.util.ajax({
                       url:'/home/book-ok',
                       data:{id:book_id},
                       func:function(res){
                           $.util.alert(res.msg);
                           setTimeout(function(){
                               window.location.href = '/home/my-book';
                           },1500);
                       }
                    });
                    break;
                case 'meetNo':
                    $.util.ajax({
                       url:'/home/book-no/'+book_id,
                       func:function(res){
                         $.util.alert(res.msg);
                         setTimeout(function(){
                              window.location.href = '/home/my-book';
                           },1500);
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
