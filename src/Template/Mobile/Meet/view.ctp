<header class="m-to-more">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <!--<a href="#this" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>-->
    </div>
</header>
<div class="transmitpage clearfix" hidden id="share_download">
    <div>
        <h1><img src="/mobile/images/logo-wx.png"></h1>
        <h3>并购圈<span>并购人的生活方式</span></h3>
    </div>
    <a href="/Wx/share_download">立即下载</a>
</div>
<div class="wraper">
    <div class="m-to-more">
        <div class='inner'>
            <a href='javascript:history.go(-1);' class='toback'></a>
            <!--<a href="#this" class='iconfont collection h-regiser'>&#xe610;</a>
            <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>-->
        </div>
        <div class="m-tomore-bottom">
            <span><i class="iconfont">&#xe629;</i><?= $biggie->city ?></span>
            <span><i class="iconfont">&#xe616;</i><?= $biggie->meet_nums ?>人约见过</span>
        </div>
    </div>
    <ul class="m-info-box">
        <li>
            <h3><?= $biggie->truename ?><em><?= $biggie->position ?></em></h3>
            <!-- <span class="identification"></span> -->
            <h3 class="mycustorm" ><?= $biggie->company ?></h3>
        </li>
        <li>
            <a id="recom" href="javascript:void(0);" class="tocommend"><i class="iconfont f7 <?php if($isReco): ?>changecolor<?php endif; ?>">&#xe61a;</i>推荐他</a>
            <span  class="commendnum">
                <p id="recom_avatar">
                    <!-- 只推荐7条 -->

                    <?php foreach ($biggie->reco_users as $reco_user): ?>
                        <a href="/user/home-page/<?= $reco_user->user->id; ?>">
                            <img src="<?= empty($reco_user->user->avatar) ? '/mobile/images/touxiang.jpg' : $reco_user->user->avatar ?>"/>
                        </a>
                    <?php endforeach; ?>
                </p>
                <!-- 等<i id="meet_nums"><?= $biggie->savant->reco_nums ?></i>人推荐 -->
                <a href="/meet/view-more-reco/<?= $biggie->id ?>" class="fr">查看更多</a>
            </span>

        </li>
        <li class="conr"><a class="alink mr" href="/user/home-page/<?= $biggie->id ?>" class="tohome"><i class="iconfont">&#xe612;</i>个人主页</a></li>
    </ul>
    <div class="m-swiper-items">
        <?php if ($self): ?>
            <h3 class="s-eidt"><a href="/meet/my-subjects">编辑话题</a></h3>
        <?php endif; ?>
        <ul id="subject">
            <?php foreach ($biggie->subjects as $v): ?>
                <li>
                    <div class="inner-li-items">
                        <h3><?= $v['title'] ?><span><?php if ($v['type'] == 1): ?>一对一面谈<?php else: ?>众筹约见<?php endif; ?></span></h3>
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
        <h3 class="comment-title">专家简介
            <?php if ($self): ?>
                <a href="/meet/edit-summary" class="fr color-items">编辑</a>
            <?php endif; ?>
        </h3>
        <p>
            <?php if (!empty($biggie->savant->summary)): ?>
                <?= $biggie->savant->summary ?>
            <?php else: ?>
                无。
            <?php endif; ?>
        </p>
    </section>
    <div class="tabcon border bgff" >
        <ul class="inner basicon" style="display: block;">
            <li class="b-hy">
                <span><i class="iconfont">&#xe654;</i>所在行业</span>
                <div>
                    <?php foreach ($biggie->industries as $k=>$v): ?>
                    <em><?= $v['name'] ?></em>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="b-bq">
                <span><i class="iconfont">&#xe653;</i>个人标签</span>
                <div>
                    <?php if(is_array(unserialize($biggie->grbq))): ?>
                        <?php foreach (unserialize($biggie->grbq) as $k=>$v): ?>
                            <em><?= $v ?></em>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </li>
            <li class="b-yw nobottom">
                <span><i class="iconfont">&#xe655;</i>擅长业务</span>
                <div>
                    <em><?= $biggie->goodat; ?></em>
                </div>
            </li>
        </ul>
    </div>
</div>
<div style='height:1.2rem'></div>
</div>
<!--底部四个图-->
<div class="iconlist">
        <!--<span class="iconfont">&#xe618;</span>-->
    <!--<span class="iconfont <?php if (!$isCollect): ?>active<?php endif; ?>" id="collect">&#xe610;</span>-->
    <span class="iconfont" id="share">&#xe612;</span>
    <span class="iconfont" >&#xe615;</span>
    <span class="iconfont" id='goTop'>&#xe606;</span>
</div>
<!--底部四个图**end-->
<!-- 微信分享 -->
<div class="reg-shadow" style="display: none;" id="shadow"></div>
<div class="wxshare" id="wxshare" hidden>
    <span></span>
    <p></p>
</div>
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    (function () {
        var imgUrl = '<?= $biggie->avatar ?>';
        if (imgUrl)
            window.shareConfig.imgUrl = location.origin + imgUrl;
        window.shareConfig.link = 'http://m.chinamatop.com/meet/view/<?= $biggie->id ?>?share=1';
        window.shareConfig.title = '并购帮大咖';
        window.shareConfig.desc = '<?= $biggie->company ?>  <?= $biggie->truename ?>';
                LEMON.show.shareIco();
            })();
</script>
<script>
    if(location.href.indexOf('?share=1') != -1){
        $('#share_download').show();
    }
    var subject = null;
    setTimeout(function () {
        subject = $.util.loop({
            min: 3,
            moveDom: $('#subject'),
            moveChild: $('#subject li'),
            lockScrY: true,
            loopScroll: true,
            autoTime: 3000,
            viewDom:$('.m-swiper-items'),
        });
    }, 0);
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('common_')) {
            console.log($(em));
        }
        switch (em.id) {
            case 'imageViewer':
            case 'fullImg':
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
                    url: '/meet/recom/<?= $biggie->id ?>',
                    func: function (res) {
                        if (typeof res === 'object') {
                            $.util.alert(res.msg);
                            if (res.status === true) {
                                $('#recom_avatar').prepend('<img src="' + res.avatar + '"/>');
                                $('#meet_nums').text((parseInt($('#meet_nums').text()) + 1));
                                $('.f7').addClass('changecolor');
                            }
                        }
                    }
                });
                break;
            case 'share':
                if ($.util.isAPP) {
                    LEMON.share.banner();
                } else if ($.util.isWX) {
                    $('#wxshare').show();
                    $('#shadow').show();
                }
                break;
            case 'shadow':case 'wxshare':
                setTimeout(function(){
                    $('#shadow').hide();
                    $('#wxshare').hide();
                }, 400);
                break;
            case 'goTop':
                window.scrollTo(0, 0);
                e.preventDefault();
                break;
        }
    });

</script>
<?php
$this->end('script');
