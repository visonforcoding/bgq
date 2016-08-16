<div class="wraper content_inner">
    <div class="h2"></div>
    <div class="bg-ff">
        <div class="m_top_des clearfix">
            <div class="m_left-pic fl">
                <img src="<?= $user->avatar ? getOriginAvatar($user->avatar) : '/mobile/images/touxiang.png' ?>"/>
            </div>
            <div class="m_center_des fl">
                <h3><?= $user->truename ?></h3>
                <span><?= $user->company ?></span>
                <span><?= $user->position ?> </span>
            </div>
            <div class="m_right_btn fr">
                <?php if (!$self): ?>
                    <span class="r-focus <?php if ($isFans): ?>focusgray<?php endif; ?>" id="follow_btn"><?php if ($isFans): ?>取消关注<?php else: ?>关注<?php endif; ?></span>
                    <span class="g-card <?php if ($isGive): ?>cardgray<?php endif; ?>" id="giveCard"><?php if ($isGive): ?>已递名片<?php else: ?>递名片<?php endif; ?></span>    
                <?php endif; ?>
            </div>
        </div>
        <div class="m-listinfo-des">
            <ul class="m-lilist-des">
                <li>
                    <i class="iconfont">&#xe660;</i>
                    <span><?= $user->city ? $user->city : '暂未填写' ?></span>
                </li>
                <li>
                    <i class="iconfont">&#xe671;</i>
                    <?php if (!$self): ?>
                        <?php if ($user->secret): ?>
                            <?php if ($user->secret->phone_set == '1'): ?>
                                <a href="tel:<?= $user->phone ?>" onclick="if ($.util.isAPP) {
                                                        LEMON.event.tel(<?= $user->phone ?>);
                                                    }"><span><?= $user->phone ? $user->phone : '暂未填写' ?></span></a>
                            <?php else: ?>
                                <span>暂未公开</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="tel:<?= $user->phone ?>" onclick="if ($.util.isAPP) {
                                                LEMON.event.tel(<?= $user->phone ?>);
                                            }"><span><?= $user->phone ? $user->phone : '暂未填写' ?></span></a>
                           <?php endif; ?>
                       <?php else: ?>
                        <span><?= $user->phone ? $user->phone : '暂未填写' ?></span>
                    <?php endif; ?>
                </li>
                <li>
                    <i class="iconfont">&#xe672;</i>
                    <?php if (!$self): ?>
                        <?php if ($user->secret): ?>
                            <?php if ($user->secret->email_set == '1'): ?>
                                <span><?= $user->email ? $user->email : '暂未填写' ?></span>
                            <?php else: ?>
                                <span>暂未公开</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span><?= $user->email ? $user->email : '暂未填写' ?></span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span><?= $user->email ? $user->email : '暂未填写' ?></span>
                    <?php endif; ?>
                </li>
            </ul>
            <div class="m-tomore-bottom">
                <span><i class="iconfont">&#xe60b;</i><?= $user->homepage_read_nums ?>人浏览过</span>
            </div>
        </div>
    </div>
    <?php if($user->level === 2 && $user->subjects): ?>
        <!--话题-->
        <div class="m-subject-list">
            <div class="m-tomore-bottom m-pos-top">
                <span><i class="iconfont">&#xe61b;</i><span id="meet_nums"><?= $user->savant->reco_nums ?></span>人推荐</span>
                <span><i class="iconfont">&#xe610;</i><?= $user->meet_nums ?>人聊过</span>
            </div>
            <div class="m-sub-header">
                <h3><i class="iconfont">&#xe670;</i>话题列表<?php if($self): ?><a href="/meet/my_subjects"><span class="fr">编辑话题</span></a><?php endif; ?></h3>
            </div>
            <div class="m-sub-con">
                <?php foreach ($user->subjects as $k=>$v): ?>
                <section>
                    <a href="<?php if($self): ?>/meet/subject/<?= $v['id'] ?><?php else: ?>/meet/subject_detail/<?= $v['id'] ?><?php endif; ?>">
                        <div class="m-sub-con-h">
                            <h3><?= $v['title'] ?></h3>
                        </div>
                        <div class="m-sub-con-c">
                            <p><?= $v['summary'] ?>
                            </p>
                        </div>
                    </a>
                </section>
                <?php endforeach; ?>
            </div>
            <!--推荐-->
            <div class="m-commond-list clearfix">
                <span class="fl <?php if($isReco): ?>color-items<?php endif; ?>" id="recom"><i class="iconfont <?php if($isReco): ?>hover<?php endif; ?>"><?php if($isReco): ?>&#xe61c;<?php else: ?>&#xe61b;<?php endif; ?></i>推荐他</span>
                <a href="/meet/view-more-reco/<?= $user->id ?>">
                    <p class="fl" id="recom_avatar">
                        <?php if($user->reco_users): ?>
                            <?php foreach ($user->reco_users as $k=>$v): ?>
                                <img src="<?= $v->user->avatar ? getOriginAvatar($v->user->avatar) : '/mobile/images/touxiang.png'; ?>"/>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </p>
                </a>
            </div>
        </div>
    <?php endif; ?>
    <!--基本资料-->
    <div class="infotab m-infotab-list">
        <ul class="h-tab">
            <li class="active"><i class="iconfont">&#xe650;</i>基本资料</li>
            <li><i class="iconfont">&#xe651;</i>工作经历</li>
            <li><i class="iconfont">&#xe652;</i>教育经历</li>
        </ul>
        <div class="tabcon bd2">
            <?php if (!$self): ?>
                <?php if ($user->secret): ?>
                    <?php if ($user->secret->profile_set == '1'): ?>
                        <ul class="cur inner basicon">
                            <li class="b-dq"><span><i class="iconfont">&#xe660;</i>所在地区</span>
                                <div>
                                    <em><?= $user->city ? $user->city : '暂未填写' ?></em>
                                </div>
                            </li>
                            <li class="b-hy"><span><i class="iconfont">&#xe654;</i>所在行业</span>
                                <div>
                                    <?php if($user->industries): ?>
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
                                    <em>暂未公开</em>
                                </div>
                            </li>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <ul class="cur inner basicon">
                    <li class="b-dq"><span><i class="iconfont">&#xe660;</i>所在地区</span>
                        <div>
                            <em><?= $user->city ? $user->city : '暂未填写' ?></em>
                        </div>
                    </li>
                    <li class="b-hy"><span><i class="iconfont">&#xe654;</i>所在行业</span>
                        <div>
                            <?php if($user->industries): ?>
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
            <?php if (!$self): ?>
                <?php if ($user->secret): ?>
                    <?php if ($user->secret->profile_set == '1'): ?>
                        <ul class="basicon worktab">
                            <?php if ($user->careers): ?>
                                <?php foreach ($user->careers as $career): ?>
                                    <a class="bd1">
                                        <li class="inner"> <span><div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div><?= $career->company ?></span></li>
                                        <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <a class="bd1">
                                    <li class="inner">
                                        <span>
                                            <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未填写
                                        </span>
                                    </li>
                                    <span class="worktime">暂未填写</span>
                                </a>
                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="basicon worktab">
                            <a class="bd1">
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未公开
                                    </span>
                                </li>
                                <span class="worktime">暂未公开</span>
                            </a>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <ul class="basicon worktab">
                    <?php if ($user->careers): ?>
                        <?php foreach ($user->careers as $career): ?>
                            <a class="bd1">
                                <li class="inner"> <span><div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div><?= $career->company ?></span></li>
                                <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <a class="bd1">
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont">&#xe651;</i>工作经历</div>暂未填写
                                </span>
                            </li>
                            <span class="worktime">暂未填写</span>
                        </a>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
            <?php if (!$self): ?>
                <?php if ($user->secret): ?>
                    <?php if ($user->secret->profile_set == '1'): ?>
                        <ul class="basicon worktab">
                            <?php if ($user->educations): ?>
                                <?php foreach ($user->educations as $education): ?>
                                    <a class="bd1">
                                        <li class="inner">
                                            <span>
                                                <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div><?= $education->school ?>
                                            </span>
                                        </li>
                                        <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <a class="bd1">
                                    <li class="inner">
                                        <span>
                                            <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未填写
                                        </span>
                                    </li>
                                    <span class="worktime">暂未填写</span>
                                </a>
                            <?php endif; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="basicon worktab">
                            <a class="bd1">
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未公开
                                    </span>
                                </li>
                                <span class="worktime">暂未公开</span>
                            </a>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <ul class="basicon worktab">
                    <?php if ($user->educations): ?>
                        <?php foreach ($user->educations as $education): ?>
                            <a class="bd1">
                                <li class="inner">
                                    <span>
                                        <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div><?= $education->school ?>
                                    </span>
                                </li>
                                <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <a class="bd1">
                            <li class="inner">
                                <span>
                                    <div class="h-tips"><i class="iconfont green">&#xe652;</i>教育经历</div>暂未填写
                                </span>
                            </li>
                            <span class="worktime">暂未填写</span>
                        </a>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="h2"></div>
</div>
<div style="height:1rem"></div>
<?php if($self): ?>
    <a href="/home/edit_userinfo" class="f-bottom">编辑个人资料</a>
<?php else: ?>
    <a href="/meet/subject_list/<?= $user->id ?>" class="f-bottom">立即约见</a>
<?php endif; ?>
<?php $this->start('script') ?>
<script>
//    (function () {
//        var imgUrl = '<?= $user->avatar ?>';
//        if (imgUrl)
//            window.shareConfig.imgUrl = location.origin + imgUrl;
//        window.shareConfig.link = location.href;
//        window.shareConfig.title = '<?= $user->truename ?>的会员主页';
//        window.shareConfig.desc = '<?= $user->company ?>  <?= $user->truename ?>';
//                LEMON.show.shareIco();
//            })();
    (function () {
        var imgUrl = '<?= $user->avatar ?>';
        if (imgUrl)
            window.shareConfig.imgUrl = location.origin + imgUrl;
        window.shareConfig.link = 'http://m.chinamatop.com/user/home_page/<?= $user->id ?>?share=1';
        window.shareConfig.title = '<?= $user->truename ?>的个人主页';
        window.shareConfig.desc = '公司：<?= $user->company ?>\n\r职位：<?= $user->position ?>\n\r点击查看更多';
                LEMON.show.shareIco();
            })();
</script>
<script>
    
    
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
                            $('#follow_btn').addClass('focusgray');
                        } else {
                            $('#follow_btn').text('关注');
                            $('#follow_btn').removeClass('focusgray');
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
                        if (typeof msg == 'object')
                        {
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
