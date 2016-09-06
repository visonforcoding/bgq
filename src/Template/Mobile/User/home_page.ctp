<a href="/Wx/share-download/user/<?= $user->id ?>">
    <div class="transmitpage clearfix" hidden id="share_download">
        <div>
            <h1><img src="/mobile/images/logo-wx.png"></h1>
            <h3>并购帮<span>并购人的生活方式</span></h3>
        </div>
        <span class="green-btn">立即下载</span>
    </div>
</a>
<div class="wraper content_inner">
    <div class="h2"></div>
    <div class="bg-ff">
        <div class="m_top_des clearfix">
            <div class="m_left-pic fl">
                <img src="<?= $user->avatar ? getSmallAvatar($user->avatar) : '/mobile/images/touxiang.png' ?>"/>
            </div>
            <div class="m_center_des fl">
                <h3 class="m_info_name"><?= $user->truename ?>
                    <?php if ($self): ?>
                        <span>
                            <i class="iconfont">&#xe660;</i>
                            <?= $user->city ? $user->city : '暂未填写' ?>
                        </span>
                    <?php else: ?>
                        <?php if ($user->city): ?>
                            <span>
                                <i class="iconfont">&#xe660;</i>
                                 <?= $user->city ?> 
                            </span>
                        <?php endif; ?>
                    <?php endif; ?>
                </h3>
                <span><?= $user->company ?></span>
                <span><?= $user->position ?> </span>
            </div>
            <div class="m_right_btn fr">
                <?php if ($self): ?>
                    <!-- <a href="/home/my-following/1" class="g-card color-items" >关注 <?= $follows ?></a> -->
                    <!-- <a href="/home/my-following/2" class="g-card bottom_btn" >粉丝<?= $fans ?></a> -->
                <?php else: ?>
                    <span class="g-card color-items" id="follow_btn"><i class="iconfont">&#xe614;</i><?php if ($isFans): ?>取消关注<?php else: ?>加关注<?php endif; ?></span>
                    <span class="g-card bottom_btn" id="giveCard"><i class="iconfont">&#xe686;</i><?php if ($isGive): ?>已递名片<?php else: ?>递名片<?php endif; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="m-listinfo-des">
            <ul class="m-lilist-des">
                    <li>
                        <a>
                            <i><?= $follows ?></i>
                            <span>关注</span>
                        </a>
                    </li>
                    <li>
                        <i><?= $fans ?></i>
                        <span>粉丝</span>
                    </li>
                </ul>
        </div>
    </div>

   
    <!--基本资料-->
    <div class="infotab m-infotab-list">
        <ul class="h-tab">
            <li class="active"><i class="iconfont">&#xe650;</i>基本资料</li>
            <li><i class="iconfont">&#xe651;</i>工作经历</li>
            <li><i class="iconfont">&#xe652;</i>教育经历</li>
        </ul>
        <div class="tabcon bd2">
            <!--基本资料-->
            <?php if (!$self): ?>
                <ul class="cur inner basicon">
                    <li class="b-dq"><span><i class="iconfont">&#xe660;</i>所在地区</span>
                        <div>
                            <em><?= $user->city ? $user->city : '暂未填写' ?></em>
                        </div>
                    </li>
                    <li class="b-hy"><span><i class="iconfont">&#xe654;</i>所在行业</span>
                        <div>
                            <?php if ($user->industries): ?>
                                <?php foreach ($user->industries as $k => $v): ?>
                                    <em><?= $v['name'] ?></em>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>暂未填写</em>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="b-bq"><span><i class="iconfont">&#xe653;</i>个人标签</span>
                        <div>
                            <?php if (is_array(unserialize($user->grbq))): ?>
                                <?php foreach (unserialize($user->grbq) as $k => $v): ?>
                                    <em><?= $v ?></em>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>暂未填写</em>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="b-yw"><span><i class="iconfont">&#xe655;</i>擅长业务</span><div><em><?= $user->goodat ? $user->goodat : '暂未填写' ?></em></div></li>
                    <li class="b-gs nobottom"><span><i class="iconfont">&#xe656;</i>公司业务</span><div><em><?= $user->gsyw ? $user->gsyw : '暂未填写' ?></em></div></li>
                </ul>
            <?php else: ?>
                <ul class="cur inner basicon">
                    <li class="b-dq"><span><i class="iconfont">&#xe660;</i>所在地区</span>
                        <div>
                            <em><?= $user->city ? $user->city : '暂未填写' ?></em>
                        </div>
                    </li>
                    <li class="b-hy"><span><i class="iconfont">&#xe654;</i>所在行业</span>
                        <div>
                            <?php if ($user->industries): ?>
                                <?php foreach ($user->industries as $k => $v): ?>
                                    <em><?= $v['name'] ?></em>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>暂未填写</em>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="b-bq"><span><i class="iconfont">&#xe653;</i>个人标签</span>
                        <div>
                            <?php if (is_array(unserialize($user->grbq))): ?>
                                <?php foreach (unserialize($user->grbq) as $k => $v): ?>
                                    <em><?= $v ?></em>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <em>暂未填写</em>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li class="b-yw"><span><i class="iconfont">&#xe655;</i>擅长业务</span><div><em><?= $user->goodat ? $user->goodat : '暂未填写' ?></em></div></li>
                    <li class="b-gs noafter"><span><i class="iconfont">&#xe656;</i>公司业务</span><div><em><?= $user->gsyw ? $user->gsyw : '暂未填写' ?></em></div></li>
                </ul>
            <?php endif; ?>

            <!--工作经历-->
            <?php if (!$self): ?>
                <?php if ($user->secret): ?>
                    <?php if ($user->secret->career_set == '1'): ?>
                        <ul class="basicon worktab">
                            <?php if ($user->careers): ?>
                                <?php foreach ($user->careers as $career): ?>

                                    <li class="inner">
                                        <span>
                                            <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>
                                            <?= $career->company ?>
                                        </span>
                                    </li>
                                    <li class="inner bd1">
                                        <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                                    </li>
                                    <li class="inner">
                                        <span class="worktime">
                                            <?= $career->descb; ?>
                                        </span>
                                    </li>

                                <?php endforeach; ?>
                            <?php else: ?>

                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未填写
                                    </span>
                                </li>
                                <li class="inner">
                                    <span class="worktime">暂未填写</span>
                                </li>

                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="basicon worktab">
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未公开
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime">暂未公开</span>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                    <ul class="basicon worktab">
                        <?php if ($user->careers): ?>
                            <?php foreach ($user->careers as $career): ?>
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>
                                        <?= $career->company ?>
                                    </span>
                                </li>
                                <li class="inner bd1">
                                    <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                                    <span class="worktime mt20">
                                        <?= $career->descb; ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未填写
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime">暂未填写</span>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            <?php else: ?>
                <ul class="basicon worktab">
                    <?php if ($user->careers): ?>
                        <?php foreach ($user->careers as $career): ?>
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>
                                    <?= $career->company ?>
                                </span>
                            </li>
                            <li class="inner bd1">
                                <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                                <span class="worktime mt20">
                                    <?= $career->descb; ?>
                                </span>
                            </li>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <li class="inner">
                            <span>
                                <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未填写
                            </span>
                        </li>
                        <li class="inner">
                            <span class="worktime  ">暂未填写</span>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>

            <!--教育经历-->
            <?php if (!$self): ?>
                <?php if ($user->secret): ?>
                    <?php if ($user->secret->education_set == '1'): ?>
                        <ul class="basicon worktab">
                            <?php if ($user->educations): ?>
                                <?php foreach ($user->educations as $education): ?>
                                    <li class="inner">
                                        <span>
                                            <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div><?= $education->school ?>
                                        </span>
                                    </li>
                                    <li class="inner">
                                        <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未填写
                                    </span>
                                </li>
                                <li class="inner">
                                    <span class="worktime">暂未填写</span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="basicon worktab">
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未公开
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime">暂未公开</span>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php else: ?>
                    <ul class="basicon worktab">
                        <?php if ($user->educations): ?>
                            <?php foreach ($user->educations as $education): ?>

                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div><?= $education->school ?>
                                    </span>
                                </li>
                                <li class="inner">
                                    <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未填写
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime">暂未填写</span>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            <?php else: ?>
                <ul class="basicon worktab">
                    <?php if ($user->educations): ?>
                        <?php foreach ($user->educations as $education): ?>
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div><?= $education->school ?>
                                </span>
                            </li>
                            <li class="inner">
                                <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="inner">
                            <span>
                                <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未填写
                            </span>
                        </li>
                        <li class="inner">
                            <span class="worktime">暂未填写</span>
                        </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="h2"></div>
     <!--话题-->
    <?php if ($user->level == 2): ?>
        <div class="m-subject-list">
            <div class="m-tomore-bottom m-pos-top">
                <span><i class="iconfont">&#xe61b;</i><span id="meet_nums"><?= $user->savant->reco_nums ?></span>人推荐</span>
                <span><i class="iconfont">&#xe610;</i><?= $user->meet_nums ?>人聊过</span>
            </div>
            <!--推荐-->
            <div class="m-commond-list clearfix">
                <span class="fl <?php if ($isReco): ?>color-items<?php endif; ?>" id="recom"><i class="iconfont <?php if ($isReco): ?>hover<?php endif; ?>"><?php if ($isReco): ?>&#xe61c;<?php else: ?>&#xe61b;<?php endif; ?></i>推荐Ta</span>
                <a href="/meet/view-more-reco/<?= $user->id ?>">
                    <p class="fl" id="recom_avatar">
                        <?php if ($user->reco_users): ?>
                            <?php foreach ($user->reco_users as $k => $v): ?>
                                <img src="<?= $v->user->avatar ? $v->user->avatar : '/mobile/images/touxiang.png'; ?>"/>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </p>
                </a>
            </div>

            <div class="m-sub-header">
                <h3>
                    <i class="iconfont">&#xe670;</i>话题列表
                    <?php if ($self): ?>
                        <a href="/meet/my_subjects">
                            <span class="fr m_edit_items"><i class="iconfont color-items">&#xe64d;</i>话题管理</span>
                        </a>
                    <?php endif; ?>
                </h3>
            </div>
            <div class="m-sub-con">
                <?php if ($user->subjects): ?>
                    <?php foreach ($user->subjects as $k => $v): ?>
                        <section class="m_sub_items">
                            <a href="<?php if ($self): ?>/meet/subject/<?= $v['id'] ?><?php else: ?>javascript:$.util.checkLogin('/meet/subject_detail/<?= $v['id'] ?>/#homepage')<?php endif; ?>">
                                <div class="m-sub-con-h">
                                    <h3 class="line2"><?= $v['title'] ?></h3>
                                </div>
                                <div class="m-sub-con-c">
                                    <p class="line2">
                                        <?= $v['summary'] ?>
                                    </p>
                                </div>
                            </a>
                        </section>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="m-sub-con-h">
                        <h3>暂无话题</h3>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    <?php endif; ?>

</div>

<?php if ($self): ?>
    <div style="height:1.2rem"></div>
    <a href="javascript:location.href = ('/home/edit-userinfo?ref='+encodeURI(location.href))" class="f-bottom">编辑个人资料</a>
<?php elseif ($user->level == 2 && $user->subjects): ?>
    <div style="height:1.2rem"></div>
    <a href="/meet/subject-list/<?= $user->id ?>" class="f-bottom">立即约见</a>
<?php endif; ?>
<?php $this->start('script') ?>
<script>
    (function () {
        var imgUrl = '<?= $user->avatar ?>';
        if (imgUrl)
            window.shareConfig.imgUrl = location.origin + imgUrl;
        window.shareConfig.link = 'http://m.chinamatop.com/user/home-page/<?= $user->id ?>?share=1';
        window.shareConfig.title = '<?= $user->truename ?>的个人主页';
        window.shareConfig.desc = '公司：<?= $user->company ?>\n\r职位：<?= $user->position ?>\n\r点击查看更多';
        LEMON.show.shareIco();
    })();
</script>
<script>
    if (location.href.indexOf('?share=1') != -1) {
        $('#share_download').show();
    }
    window.onBackView = function () {
        location.reload();
    };

    $('.h-tab>li').on('click', function () {
        var index = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.tabcon>ul').eq(index).addClass('cur').siblings().removeClass('cur');
    });

    $(function () {
        $('#follow_btn').on('click', function () {
            //关注
            $.util.ajax({
                url: '/user/follow',
                data: {id: <?= $user->id ?>},
                func: function (res) {
                    $.util.alert(res.msg);
                    if (res.status) {
                        if (res.msg.indexOf('取消关注') != '') {
                            $('#follow_btn').text('取消关注');
//                            $('#follow_btn').addClass('focusgray');
                        } else {
                            $('#follow_btn').text('关注');
//                            $('#follow_btn').removeClass('focusgray');
                        }
                    }

                }
            });
        });
    });

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
            case 'giveCard':
                $.util.ajax({
                    url: '/user/giveCard/<?= $user->id ?>',
                    func: function (msg) {
                        if (typeof msg == 'object') {
                            $.util.alert(msg.msg);
                            $('#giveCard').text('已递名片');
                            $('#giveCard').addClass('cardgray');
                        }
                    }
                });
                break;
            case 'recom':
                $.util.ajax({
                    url: '/meet/recom/<?= $user->id ?>',
                    func: function (res) {
                        if (typeof res === 'object') {
                            $.util.alert(res.msg);
                            if (res.status === true) {
                                $('#recom_avatar').prepend('<img src="' + res.avatar + '"/>');
                                $('#meet_nums').text((parseInt($('#meet_nums').text()) + 1));
                                $('#recom').addClass('hover');
                                $('#recom').children('i').html('&#xe61c;');
                            }
                        }
                    }
                });
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
