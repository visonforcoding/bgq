<header class="m-to-more">
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <a href="#this" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
    </div>
    <div class="m-tomore-bottom">
        <span><i class="iconfont">&#xe624;</i>广东 深圳</span>
        <span><i class="iconfont">&#xe60b;</i>22人约见过</span>
    </div>
</header>
<div class="wraper m-wraper">
    <ul class="m-info-box">
        <li>
            <h3><?= $savant->truename ?><span><?= $savant->company ?> <?= $savant->position ?></span></h3>
            <span class="identification"><i>实名认证</i><i>专家认证</i></span>
        </li>
        <li>
            <span>
                <p><i class="iconfont">&#xe615;</i><img src="../images/user.png"/><img src="../images/user.png"/><img src="../images/user.png"/><img src="../images/user.png"/><img src="../images/user.png"/></p>等<i>64</i>人推荐</span>
            <a href="javascript:void(0);">推荐他</a>
        </li>
        <li><a href="/home/my-home-page/<?= $savant->id ?>"><span class="myhome">个人主页</span></a></li>
    </ul>
    <a href="/meet/subject" class="eduit">编辑</a>
    <div class="m-swiper-items toone">
        <ul id="subject">
            <?php foreach ($savant->subjects as $subject): ?>
                <?php if ($subject->type == '2'): ?>
                    <li class="s-to-more">
                    <a href="/meet/subject-detail/<?=$subject->id?>">
                        <h3><?= $subject->title ?><span>一对多面谈</span></h3>
                    <?php else: ?>
                    <li class="s-to-one">
                    <a href="/meet/subject-detail/<?=$subject->id?>">
                        <h3><?= $subject->title ?><span>一对一面谈</span></h3>
                    <?php endif; ?>
                    <div class='m-center-con'>
                        <p><?= $subject->summary ?></p>
                    </div>
                    <div  class='m-bottom-con'>
                        <span>价格<i><?= $subject->price ?>元/次</i></span>
                        <span>时间<i>约<?= $subject->last_time ?>小时</i></span>
                    </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <section class="a-detail newscomment-box m-about-expert">
        <h3 class="comment-title">专家简介</h3>
        <p><?= $savant->summary ?></p>
    </section>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    var subject = null;
    //setTimeout(function(){
    subject = $.util.loop({
        min: 5,
        moveDom: $('#subject'),
        moveChild: $('#subject li'),
        lockScrY: true,
        loopScroll: true
    });
</script>
<?php
$this->end('script');
