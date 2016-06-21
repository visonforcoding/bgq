<!--<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            话题详情
        </h1>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
    </div>
</header>-->
<div class="wraper">
    <div class="h20">
    </div>
    <section>
        <ul class="m-detail-box">
            <li >
                <h3><?=$subject->title?><span><?=$subject->user->truename?> <?=$subject->user->company?> <?=$subject->user->position?></span></h3>
                <span class="meet-type">
                    <?php if($subject->type==2):?>
                    一对多面谈
                    <?php else:?>
                    一对一面谈
                    <?php endif;?>
                </span>
            </li>
            <li>
                <span><?=$subject->price?>元/次</span>
                <span>约<?=$subject->last_time?>小时</span>
            </li>
            <li>
                <p><?=$subject->summary?>
                </p>
            </li>
            <li>
                <div>
                    <span>地点：<?=$subject->address?></span>
                    <span>时间：<?=$subject->invite_time?></span>
                </div>
            </li>
        </ul>
    </section>
    <a href="/meet/book/<?=$subject->id?>" id="submit" class="nextstep">预约</a>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
</script>
<?php
$this->end('script');
