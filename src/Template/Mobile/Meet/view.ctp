<!--<header class="m-to-more">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <a href="#this" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
    </div>
    <div class="m-tomore-bottom">
        <span><i class="iconfont">&#xe624;</i>广东 深圳</span>
        <span><i class="iconfont">&#xe60b;</i>22人约见过</span>
    </div>
</header>-->

<div class="wraper m-wraper">
    <ul class="m-info-box">
        <li>
            <h3><?= $biggie->truename ?><span><?= $biggie->company ?> <?= $biggie->position ?></span></h3><span class="identification"><i>实名认证</i><i>专家认证</i></span>
        </li>
        <li>
            <span>
                <p>
                    <i class="iconfont">&#xe615;</i>
                    <img src="/mobile/images/user.png"/>
                    <img src="/mobile/images/user.png"/>
                    <img src="/mobile/images/user.png"/>
                    <img src="/mobile/images/user.png"/>
                    <img src="/mobile/images/user.png"/>
                </p>等<i>64</i>人推荐</span>
            <a href="javascript:void(0);">推荐他</a>
        </li>
        <li class="conr"><a href="/meet/myhome/<?= $biggie->id ?>" class="tohome"><i class="iconfont">&#xe60d;</i>个人主页</a></li>

    </ul>
    <div class="m-swiper-items">
        <ul id="subject">
            <?php foreach ($biggie->subjects as $v): ?>
            <li>
                <a href="/meet/subject_detail/<?= $v['id'] ?>">
                    <div class="inner-li-items">
                        <h3><?= $v['title'] ?><span><?php if($v['type'] == 1): ?>一对一<?php else: ?>一对多<?php endif; ?>面谈</span></h3>
                        <div class='m-center-con'>
                            <p>
                                <?= $v['summary'] ?>
                            </p>
                        </div>
                        <div  class='m-bottom-con'>
                            <span>价格<i><?= $v['price'] ?>元/次</i></span>
                            <span>时间<i>约<?= $v['last_time'] ?>小时</i></span>
                        </div>
                    </div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <section class="a-detail newscomment-box m-about-expert">
        <h3 class="comment-title">专家简介</h3>
        <a href="/meet/myhome/<?= $biggie->id ?>">
            <p>
                <?= $biggie->savant->summary ?>
            </p>
        </a>

    </section>

</div>
<!--底部四个图-->

<div class="iconlist">
        <!--<span class="iconfont">&#xe618;</span>-->
    <span class="iconfont <?php if(!$isCollect): ?>active<?php endif; ?>" id="collect">&#xe610;</span>
    <span class="iconfont">&#xe614;</span>
    <span class="iconfont" id='goTop'></span>
</div>
<!--底部四个图**end-->
<?php $this->start('script'); ?>
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
    //}, 0);

    $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('common_')){
            console.log($(em));
        }
        switch(em.id){
            case 'imageViewer': case 'fullImg':
                //do();
            break;
            case 'collect':
                $.util.ajax({
                    url: '/meet/collect/<?= $biggie->id ?>',
                    func: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $.util.alert(msg.msg);
                                $(em).toggleClass('active');
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'detailClosePC':
                //do();
                break;
            case 'goTop':
                window.scrollTo(0,0);
                e.preventDefault();
                break;
        }
    });

</script>
<?php
$this->end('script');
