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
        <ul class="m-detail">
            <li >
                <h3><?=$subject->title?><span class='m-block'><?=$subject->user->truename?> <?=$subject->user->company?> <?=$subject->user->position?></span></h3>
<!--                <span class="meet-type">
                </span>-->
            </li>
            <li>
                <span><?=$subject->price?>元/次</span>
                <span class="fr">约<?=$subject->last_time?>小时</span>
            </li>
            <li>
                <h3 class="t-tittle">话题简介</h3>
                <p><?=$subject->summary?>
                </p>
            </li>
            <li>
                <h3 class="t-tittle">约见保障计划</h3>
                <div class="p20">
                    <p>1.学员在申请约见时清楚写明自己的问题和个人相关背景；</p>
                    <p>2.专家在约见前根据学员的问题提前做好准备；</p>
                    <p>3.面谈时，专家以学员的问题为核心，从学员自身情况出发，
                        为其答疑解惑、出谋划策、提出问题的解决之道；避免泛
                        泛而谈或者脱离学员实际情况；</p>
                    <p>4.双方见面不迟到，在面谈过程手机保持静音，不查收信息
                        或接打电话；</p>
                    <p>5.双方改期需提前24小时通知。
                    </p>
                </div>
            </li>
        </ul>
    </section>
    <a href="/meet/book/<?=$subject->id?>" id="submit" class="nextstep">立即预约</a>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
</script>
<?php
$this->end('script');
