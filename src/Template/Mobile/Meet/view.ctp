<header class="m-to-more">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <!--<a href="#this" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>-->
    </div>
</header>
<div class="wraper m-wraper">
    <div class="m-to-more">
        <div class='inner'>
            <a href='javascript:history.go(-1);' class='toback'></a>
            <!--<a href="#this" class='iconfont collection h-regiser'>&#xe610;</a>
            <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>-->
        </div>
        <div class="m-tomore-bottom">
            <span><i class="iconfont">&#xe624;</i><?= $biggie->city ?></span>
            <span><i class="iconfont">&#xe60b;</i><?= $biggie->meet_nums ?>人约见过</span>
        </div>
    </div>
    <ul class="m-info-box">
        <li>
            <h3><?= $biggie->truename ?><em><?= $biggie->company ?></em><em><?= $biggie->position ?></em></h3>
            <span class="identification"></span>
        </li>
        <li>
            <span  class="commendnum">
                <p id="recom_avatar">
                    <?php foreach ($biggie->reco_users as $reco_user): ?>
                        <img src="<?= empty($reco_user->user->avatar) ? '/mobile/images/touxiang.jpg' : $reco_user->user->avatar ?>"/>
                    <?php endforeach; ?>
                </p>
                等<i id="meet_nums"><?=$biggie->savant->reco_nums?></i>人推荐</span>
            <a id="recom" href="javascript:void(0);">推荐他</a>
        </li>
        <li class="conr"><a class="alink mr" href="/user/home-page/<?= $biggie->id ?>" class="tohome"><i class="iconfont">&#xe60d;</i>个人主页</a></li>
    </ul>
    <div class="m-swiper-items">
        <ul id="subject">
            <?php foreach ($biggie->subjects as $v): ?>
            <li>
                    <div class="inner-li-items">
                        <h3><?= $v['title'] ?><span><?php if ($v['type'] == 1): ?>一对一<?php else: ?>一对多<?php endif; ?>面谈</span></h3>
                        <a class="alink" href="/meet/subject-detail/<?= $v->id ?>">
                            <div class='m-center-con'>
                                <p>
                                    <?= $v['summary'] ?>
                                </p>
                            </div>
                        </a>
                        <div  class='m-bottom-con'>
                            <span>价格<i><?= $v['price'] ?>元/次</i></span>
                            <span>时间<i>约<?= $v['last_time'] ?>小时</i></span>
                        </div>
                    </div>	
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <section class="a-detail newscomment-box m-about-expert">
        <h3 class="comment-title">专家简介</h3>
        <a href="meet-one-detail.html">
            <p>
                <?php if(!empty($biggie->savant->summary)): ?>
                <?= $biggie->savant->summary ?>
                <?php else: ?>
                无。
                <?php endif; ?>
            </p>
        </a>
    </section>

</div>
</div>
<!--底部四个图-->
<div class="iconlist">
        <!--<span class="iconfont">&#xe618;</span>-->
    <span class="iconfont <?php if(!$isCollect): ?>active<?php endif; ?>" id="collect">&#xe610;</span>
    <span class="iconfont" id="share">&#xe614;</span>
    <span class="iconfont" id='goTop'></span>
</div>
<!--底部四个图**end-->
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    // 分享设置
    window.shareConfig.link = 'http://m.chinamatop.com/news/view/<?= $biggie->id ?>';
    window.shareConfig.title = '并购帮大咖·<?= $biggie->truename ?>';
    var share_desc = '<?= isset($biggie->savant->summary)?$biggie->savant->summary:'并购帮大咖' ?>';
    share_desc && (window.shareConfig.desc = share_desc);
</script>
<script>
    var subject = null;
    setTimeout(function(){
        subject = $.util.loop({
            min : 3,
            moveDom: $('#subject'),
            moveChild: $('#subject li'),
            lockScrY: true,
            loopScroll: true,
            autoTime:3000,

        });
    }, 0);
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
            case 'recom':
                $.util.ajax({
                   url:'/meet/recom/<?=$biggie->id?>', 
                   func:function(res){
                       if(typeof res ==='object'){
                           $.util.alert(res.msg);
                           if(res.status===true){
                               $('#recom_avatar').prepend('<img src="'+res.avatar+'"/>');
                               $('#meet_nums').text((parseInt($('#meet_nums').text())+1));
                           }
                       }
                   }
                });
                break;
            case 'share':
                if(navigator.userAgent.toLowerCase().indexOf('micromessenger') == -1)
                {
                    LEMON.share.banner();
                }
                else
                {
                    $.util.alert('请点击右上角分享');
                }
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