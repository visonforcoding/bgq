<header class="m-to-more">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <!--<a href="#this" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>-->
    </div>
</header>
<a href="/Wx/share_download/user/<?= $biggie->id ?>">
    <div class="transmitpage clearfix" hidden id="share_download">
        <div>
            <h1><img src="/mobile/images/logo-wx.png"></h1>
            <h3>并购帮<span>并购人的生活方式</span></h3>
        </div>
        <span class="green-btn">立即下载</span>
    </div>
</a>
<div class="wraper">
    <div class="m-to-more">
        <div class="pic-expert">
            <img src="/mobile/css/img/tomore.png">
            <!--<img src="<?= $biggie->savant->cover; ?>">-->
        </div>
        <div class="m-tomore-bottom">
            <span><i class="iconfont">&#xe60b;</i><?= $biggie->savant_read_nums ?></span>
            <!--<span><i class="iconfont">&#xe629;</i><?= $biggie->city ?></span>-->
            <span><i class="iconfont">&#xe616;</i><?= $biggie->meet_nums ?>人约见过</span>
        </div>
    </div>
    <ul class="m-info-box">
        <li class='e-info'>
            <h3><?= $biggie->truename ?><em><?= $biggie->position ?></em></h3>
            <!-- <span class="identification"></span> -->
            <h3 class="mycustorm" ><?= $biggie->company ?></h3>
            <?php if (!$self): ?>
                <?php if ($biggie->subjects): ?>
                    <div class="u-btn meetbtn"><a href="/meet/subject_list/<?= $biggie->id ?>" class="focusbtn">立即约见</a></div>
                <?php endif; ?>
            <?php endif; ?>
        </li>
        <li>
            <a id="recom" href="javascript:void(0);" class="tocommend"><i class="iconfont f7 <?php if ($isReco): ?>color-items<?php endif; ?>">&#xe61a;</i>推荐他</a>
            <span  class="commendnum">
                <a href="/meet/view-more-reco/<?= $biggie->id ?>" class="alink-list">
                    <!-- 只推荐7条 -->

                    <?php foreach ($biggie->reco_users as $reco_user): ?>
                        <img src="<?= empty($reco_user->user->avatar) ? '/mobile/images/touxiang.jpg' : getOriginAvatar($reco_user->user->avatar) ?>"/>
                    <?php endforeach; ?>
                </a>
                <!-- 等<i id="meet_nums"><?= $biggie->savant->reco_nums ?></i>人推荐 -->
               <!--  <a href="/meet/view-more-reco/<?= $biggie->id ?>" class="fr">更多</a> -->
            </span>

        </li>
        <li class="m-page"><a class="alink mr" href="/user/home-page/<?= $biggie->id ?>" class="tohome"><i class="iconfont">&#xe66a;</i>个人主页<span class="iconfont fr">&#xe662;</span></a></li>
    </ul>
    <div class="tabcon border bgff" >
        <ul class="innercon basicon" style="display: block;">
            <li class="b-dq"><span><i class="iconfont">&#xe660;</i>所在地区</span><div><em><?= $biggie->city ?></em></div></li>
            <li class="b-hy">
                <span><i class="iconfont">&#xe654;</i>所在行业</span>
                <div>
                    <?php foreach ($biggie->industries as $k => $v): ?>
                        <em><?= $v['name'] ?></em>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="b-bq">
                <span><i class="iconfont">&#xe653;</i>个人标签</span>
                <div>
                    <?php if (is_array(unserialize($biggie->grbq))): ?>
                        <?php foreach (unserialize($biggie->grbq) as $k => $v): ?>
                            <em><?= $v ?></em>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </li>
            <li class="b-yw noafter">
                <span><i class="iconfont">&#xe655;</i>擅长业务</span>
                <div>
                    <em><?= $biggie->goodat; ?></em>
                </div>
            </li>
        </ul>
    </div>
    <div class="h2">
    </div>
    <div class="m-swiper-items">
        <?php if ($self): ?>
            <div class="u-btn">
                <div class="lbtn"><a href="/meet/my_subjects" class="focusbtn">编辑话题</a></div>
                <div class="rbtn"><a href="/meet/edit-summary" class="cardbtn">编辑简介</a></div>
            </div>
        <?php endif; ?>
        <?php if ($biggie->subjects): ?>
            <ul id="subject" class='mt20'>
                <?php foreach ($biggie->subjects as $v): ?>
                    <li>
                        <div class="inner-li-items">
                            <h3><?= $v['title'] ?></h3>
                            <?php if (!$self): ?>
                                <a class="alink" href="/meet/subject-detail/<?= $v->id ?>">
                                <?php else: ?>
                                    <a class="alink" href="/meet/subject/<?= $v->id ?>">
                                    <?php endif; ?>
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
        <?php endif; ?>
    </div>
    <section class="a-detail newscomment-box m-about-expert">
        <h3 class="comment-title">专家简介
        </h3>
        <p>
            <?php if (!empty($biggie->savant->summary)): ?>
                <?= $biggie->savant->summary ?>
            <?php else: ?>
                无。
            <?php endif; ?>
        </p>
    </section>

</div>
<!-- <div style='height:1.2rem'></div> -->
</div>
<!--底部四个图-->
<!--<div class="iconlist">
    <span class="iconfont" id="share">&#xe619;</span>
    <span class="iconfont" >&#xe615;</span>
    <span class="iconfont" id='goTop'>&#xe606;</span>
</div>-->
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
        window.shareConfig.title = '<?= $biggie->truename ?>的个人主页';
        window.shareConfig.desc = '公司：<?= $biggie->company ?>\n\r职位：<?= $biggie->position ?>\n\r点击查看更多';
                LEMON.show.shareIco();
            })();
</script>
<script>
    if (location.href.indexOf('?share=1') != -1) {
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
            viewDom: $('.m-swiper-items'),
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
                                $('.f7').addClass('color-items');
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
            case 'shadow':
            case 'wxshare':
                setTimeout(function () {
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
