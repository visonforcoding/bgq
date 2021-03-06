<body>
    <style>
        tr, td{text-align: left;}
    </style>
    <?= $this->element('share', ['table'=>'activity', 'id'=>$activity->id]); ?>
    <div class="wraper" id="activity_detail" >
        <section class="newscon-box a-detail">
            <h3><?= $activity->title ? $activity->title : ''; ?></h3>
            <a class="active-autor flex">
                <div class="avatar">
                    <img src="<?= $activity->user->avatar ?>" class="responseimg">
                </div>
                <div class="active-r-info">
                    <span class="user"><?= $activity->user->truename ?></span> | <span class="company"><?= $activity->user->company ?></span> | <span class="job"><?= $activity->user->position ?></span>
                </div>
            </a>
            <div class="inner">
                <time class='a_title_time'><?= $activity->create_time->format('Y-m-d H:i:s'); ?></time>
            </div>
            <div class='innercon'> <img src="<?= $activity->cover; ?>"/>
                <p>主办单位：<?= $activity->company ? $activity->company : ''; ?> 
                    <?php if ($activity->org): ?>
                        <?php foreach(unserialize($activity->org) as $k=>$v): ?>
                            <br /><?= $v['org_key'] ?>：<?= $v['org_val']; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <br />时间：<?= $activity->activity_time ? $activity->activity_time : ''; ?>
                    <br />地点：<?= $activity->address ? $activity->address : ''; ?>
                    <br />规模：<?= $activity->scale ? $activity->scale : ''; ?>人</p>
            </div>
            <div class="a-other-info innercon ac">
                <a><?= $activity->region ? $activity->region->name : ''; ?></a>
                <?php foreach ($activity->industries as $k => $v): ?>
                    <a href="javascript:void(0)"><?= $v->name; ?></a>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="a-detail newscomment-box">
            <h3 class="comment-title">活动介绍</h3>
            <div class="innercon a_process_pic">
                <p><?= str_replace(["\r\n", "\n"], '<br />', $activity->summary); ?></p>
            </div>
        </section>
        <section class="a-detail newscomment-box">
            <h3  class="comment-title">活动流程</h3>
            <div class="innercon a_process_pic"><?= $activity->body; ?></div>
        </section>
        <?php if ($activity->contact): ?>
            <section class="a-detail newscomment-box">
                <h3  class="comment-title">联系方式</h3>
                <div class="innercon a_process_pic"><?= $activity->contact; ?></div>
            </section>
        <?php endif; ?>
        <?php if ($activity->guest): ?>
            <section class="a-detail newscomment-box guests">
                <h3 class="comment-title">参与嘉宾</h3>
                <div class="innercon a_process_pic">
                    <?= $activity->guest; ?>
                </div>
            </section>
        <?php endif; ?>
        <section class="newscomment-box no-t-border"> 
            <div class="con-bottom a-con-bottom clearfix">
                <!--阅读数-->
                <span class="readnums">
                    <!--<i class="iconfont ">&#xe60b;</i>-->
                    阅读
                    <?= $activity->read_nums; ?>
                </span>
                <!--喜欢按钮-->
                <span >
                    <i class="iconfont like color-items <?php if ($isLike): ?>hover<?php endif; ?>" artid="<?= $activity->id; ?>" type="0" id="like"><?php if ($isLike): ?>&#xe61c;<?php else: ?>&#xe61b;<?php endif; ?></i><em class='like_num'><?= $activity->praise_nums ? $activity->praise_nums : '0' ?></em>
                </span>
                <!--收藏按钮-->
                <span >
                    <i class="iconfont color-items <?php if ($isCollect): ?>hover<?php endif; ?>" artid="<?= $activity->id; ?>" type="0" id="collect"><?php if ($isCollect): ?>&#xe681;<?php else: ?>&#xe615;<?php endif; ?></i>
                </span>
            </div>
        </section>
        <?php if ($activity->is_show_apply): ?>
        <section class="newscomment-box joinnumber">
            <h3 class="comment-title">
                已报名
                <!--<a href="/activity/allEnroll/<?= $activity->id ?>" class="allentrol">查看全部</a>-->
            </h3>
            <div class="items  no-bottom">
                <?php if ($userApply): ?>
                    <a href="/activity/allEnroll/<?= $activity->id ?>">
                        <div class="comm-info t-ablock" style="height:.62rem;">
                            <?php foreach ($userApply as $k => $v): ?>
                                <img src="<?= $v['avatar'] ? $v['avatar'] : '/mobile/images/touxiang.png'; ?>"/>
                            <?php endforeach; ?>
                        </div>
                    </a>
                <?php else : ?>
                    <div class="comm-info t-ablock" id="allEnroll">
                        <div style="font-size: 0.32rem;color: #7a7d82;text-align: center;line-height: 0.62rem;">暂时无人报名</div>
                    </div>
                <?php endif; ?>
        <!-- <span>显示全部</span> -->
            </div>
        </section>
        <?php endif; ?>
        <section class="newscomment-box <?php if (!$activity->is_show_apply): ?>joinnumber<?php endif; ?>" >
            <h3 class="comment-title">
                评论
                <span id="article_comment_1" user_id="<?= $user; ?>"><i class="iconfont" >&#xe62e;</i>我要点评</span>
            </h3>
            <div id="comment"><h4 id="noComment">还没任何评论</h4></div>
            <span class='com-all' style="display:none;"><a href="#allcoment" id="showAllComment">查看更多评价</a></span>
        </section>
        <div style="height:.6rem"></div>
        
        <?php if ($activity->activity_recommends): ?>
            <div class="active-commond innercon">
                <section class="my-collection-info  nobottom">
                    <?php foreach ($activity->activity_recommends as $k => $v): ?>
                        <div>
                            <a href="/activity/details/<?= $v['id'] ?>" class="clearfix">
                                <span class="my-pic-acive"><img src="<?= $v['thumb'] ? $v['thumb'] : $v['cover'] ?>"></span>
                                <div class="my-collection-items">
                                    <h3><?= $v['title'] ?></h3>
                                    <span><?= $v['company'] ?> <i><?= $v['apply_nums'] ?>人报名</i></span>
                                    <span><?= $v['time'] ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </section>
            </div>
        <?php endif; ?>
        
        <!--专家推荐-->
        <?php if ($activity->savants): ?>
            <div class="expert-commond innercon">
                <ul>
                    <?php foreach ($activity->savants as $k => $v): ?>
                        <li>
                            <a href="/user/home-page/<?= $v['id'] ?>">
                                <img src="<?= $v['avatar'] ? getSmallAvatar($v['avatar']) : '/mobile/images/touxiang.png' ?>" alt="<?= $v['truename'] ?>" />
                                <h3><?= $v['truename'] ?><span><?= $v['company'] ?> <?= $v['position'] ?></span></h3>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div style='height:1.2rem;'></div>
    </div>

    <div class="wraper" id="allcoment" style="display:none;">
        <section class="newscomment-box">
            <h3 class="comment-title">
                评论
                <span id="article_comment" user_id="<?= $user; ?>"><i class="iconfont">&#xe62e;</i>我要点评</span>
            </h3>
            <div id="allComments"></div>
            <div id="buttonLoading" class="loadingbox"></div>
        </section>
    </div>

    <!--吸底按钮-->
    <div class="a_fixed_group">
        <div class="entrol_group" id="choose">
            <?php if($activity->bonus_start_time < Cake\I18n\Time::now() && $activity->bonus_end_time > Cake\I18n\Time::now()): ?>
                <a href="javascript:$.util.checkLogin('/activity/enroll/<?= $activity->id; ?>');">
                    <span class="choose_num">
                        1人
                        <span style="text-decoration:line-through;">（<?= $activity->apply_fee ?>元/人）</span>
                        （<?= $activity->bonus_fee ? $activity->bonus_fee : $activity->apply_fee ?>元/人）
                    </span>
                </a>
                <a href="javascript:$.util.checkLogin('/activity/choose_member/<?= $activity->id; ?>');">
                    <span class="choose_num">
                        <?= $activity->multi_nums ?>人
                        <span style="text-decoration:line-through;">（<?= $activity->triple_fee ?>元/人）</span>
                        （<?= $activity->bonus_triple_fee ?>元/人）
                    </span>
                </a>
            <?php else: ?>
                <a href="javascript:$.util.checkLogin('/activity/enroll/<?= $activity->id; ?>');">
                    <span class="choose_num">1人（<?= $activity->apply_fee ?>元/人）</span>
                </a>
                <a href="javascript:$.util.checkLogin('/activity/choose_member/<?= $activity->id; ?>');">
                    <span class="choose_num"><?= $activity->multi_nums ?>人（<?= $activity->triple_fee ?>元/人）</span>
                </a>
            <?php endif; ?>
        </div>
        <div class="bottombtn flex">
            <?php if ($activity->apply_end_time < time()): ?>
                <a style="background:gray;" class="l-btn">我要赞助</a>
            <?php else: ?>
                <a href="javascript:$.util.checkLogin('/activity/recommend/<?= $activity->id; ?>')" class="l-btn">我要赞助</a>
            <?php endif; ?>
            <?php if ($activity->apply_end_time < time() || time() < $activity->apply_start_time): ?>
                <a style="background:gray;" class="r-btn">我要报名</a>
            <?php else: ?>
                <!--报名人数-->
                <?php if ($activity->apply_nums < $activity->scale): ?>
                    <!--是否要审核-->
                    <?php if ($activity->must_check): ?>
                        <?php if (empty($activity->activityapply)): ?>
                            <a id="want_enroll" class="r-btn" href="javascript:void(0);" is_multi="<?= $activity->multi_nums ? 1 : 0 ?>">我要报名<?= $activity->triple_fee ? '' : '('.$activity->apply_fee.'元)'; ?></a>
                        <?php else: ?>
                            <?php if ($activity->activityapply['0']->is_pass == 0): ?>
                                <?php if ($activity->activityapply['0']->is_check == 1): ?>
                                    <?php if ($activity->activityapply['0']->triple_pid): ?>
                                        <a class="r-btn">报名中</a>
                                    <?php else: ?>
                                        <a href="/activity/pay/<?= $activity->activityapply['0']->id; ?>" class="r-btn">去付款(<?= $activity->activityapply['0']->is_triple ? $activity->triple_fee : $activity->apply_fee; ?>元)</a>
                                    <?php endif; ?>
                                <?php elseif ($activity->activityapply['0']->is_check == 2): ?>
                                    <a style="background:gray;" class="r-btn">审核未通过</a>
                                <?php else: ?>
                                    <a class="r-btn">审核中</a>
                                <?php endif; ?>
                            <?php elseif ($activity->activityapply['0']->is_pass == 1): ?>
                                <a class="r-btn">已报名</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if (empty($activity->activityapply)): ?>
                            <a id="want_enroll" class="r-btn" href="javascript:void(0);" is_multi="<?= $activity->multi_nums ? 1 : 0 ?>">我要报名<?= $activity->triple_fee ? '' : '('.$activity->apply_fee.'元)'; ?></a>
                        <?php else: ?>
                            <?php if ($activity->activityapply['0']->is_pass == 0): ?>
                                <?php if ($activity->activityapply['0']->triple_pid): ?>
                                    <a class="r-btn">报名中</a>
                                <?php else: ?>
                                    <a href="/activity/pay/<?= $activity->activityapply['0']->id; ?>" class="r-btn">去付款(<?= $activity->activityapply['0']->is_triple ? $activity->triple_fee : $activity->apply_fee; ?>元)</a>
                                <?php endif; ?>
                            <?php elseif ($activity->activityapply['0']->is_pass == 1): ?>
                                <a class="r-btn">已报名</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="r-btn">报名人数已满</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <!-- 微信分享 -->
    <div class="reg-shadow" style="display: none;" id="shadow"></div>
    <div class="wxshare" id="wxshare" hidden>
        <span></span>
        <p></p>
    </div>
    <div class="reg-shadow article-shadow" ontouchmove="return false;" hidden id="article_shadow"></div>
    <div class="shadow-info a-shadow a-forword article">
        <ul>
            <li>
                <textarea type="text" placeholder="请输入评论" name="comment-content-article"></textarea>
            </li>
            <li>
                <a href="javascript:void(0);" id="cancel">取消</a>
                <a href="javascript:void(0);" id="publish_article" activity_id="<?= $activity->id; ?>">发表</a>
            </li>
        </ul>
    </div>

    <div class="reg-shadow reply-shadow" ontouchmove="return false;" hidden id="reply_shadow"></div>
    <div class="shadow-info a-shadow a-forword reply">
        <ul>
            <li>
                <textarea type="text" placeholder="请输入评论" name="comment-content-reply" id="r_textarea"></textarea>
            </li>
            <li>
                <a href="javascript:void(0);" id="cancel">取消</a>
                <a href="javascript:void(0);" id="publish_reply" activity_id="<?= $activity->id; ?>">发表</a>
            </li>
        </ul>
    </div>
    <div class="totips" hidden id="isdel" >
        <h3>确定要删除本条评论？</h3>
        <span style="display:none;"></span>
        <a href="javascript:void(0)" class="tipsbtn bggray" id="no">取消</a><a href="javascript:void(0)" class="tipsbtn bgred" id="yes">确认</a>
    </div>
</body>
<?php $this->start('script'); ?>
<script type="text/html" id="comment_tpl">
    <div class="items">
        <div class="comm-info clearfix">
            <span>
                <a href="/user/home-page/{#user_id#}" class="alink">
                    <img src="{#user_avatar#}"/>
                </a>
            </span>
            <span class="infor-comm">
                <a href="/user/home-page/{#user_id#}" class="alink">
                    <i class="username" id='comment_username_{#id#}' user_name="{#user_truename#}">{#user_truename#}<time>{#create_time#}</time></i>
                    <i class="job">{#user_company#} {#user_position#}</i>
                </a>
            </span>
            <span id="likecom_{#id#}" comid="{#id#}" disabled="{#disable#}">
                <b class="addnum">+1</b>
                <i class="iconfont addnum_{#id#}" style="{#style#}">&#xe61a;</i>
                <b class="praise_num">{#praise_nums#}</b>
            </span>
        </div>
        <p class="a_bottom_comm reply_{#id#}" id="reply_{#id#}" value="{#id#}" user_id="{#user_id#}">{#body#}</p>
    </div>
</script>
<script src="/wpadmin/lib/layer_mobile/layer.js"></script>
<script>
    // 分享设置
    window.shareConfig.link = 'http://m.chinamatop.com/activity/details/<?= $activity->id ?>?share=1';
    window.shareConfig.title = '<?= $activity->title ?>';
    var share_desc = '<?= str_replace(["\r\n", "\r", "\n"], '', $activity->summary) ?>';
    share_desc && (window.shareConfig.desc = share_desc);
    LEMON.show.shareIco();
    if ($.util.isAPP && document.URL.indexOf('/enroll') != -1) {
        LEMON.sys.back('/activity/index');
    }

    window.__user_id = <?= !empty($user) ? $user : '0' ?>;
    window.__id = '<?= $activity->id ?>';
    window.activitycom = <?= json_encode($activity->activitycom); ?>;
</script>
<script>
    if(window.__id == '32'){
        setTimeout(function(){
            $('#want_enroll').attr('href', '/beauty/index');
        }, 1000);
    }
    
    window.article = true;
    window.reply = true;
    window.location.hash = '';
    $('table').removeAttr('width');
    $.util.dataToTpl('comment', 'comment_tpl', window.activitycom, function (d) {
        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
        d.user_truename = d.user.truename;
        d.user_company = d.user.company;
        d.user_position = d.user.position;
        d.user_id = d.user.id;
        if (d.pid > 0) {
            d.body = '回复<span style="color:#222"> ' + d.replyuser.truename + ' </span>：' + d.body;
        }
        d.style = '';
        if (d.hasOwnProperty('likes')) {
            if (d['likes'].length) {
                d.style = 'color:#e01a48';
                d.disable = '1';
            }
        }
        return d;
    });

    // 少于五条评论隐藏显示全部，大于一条评论隐藏还没有评论
    var circle = setInterval(function () {
        if ($('#comment').children('.items').length >= 5) {
            $('.com-all').show();
            clearInterval(circle);
        }
        if ($('#comment').children('.items').length > 0) {
            $('#noComment').hide();
        }
    }, 100);

    function checkLogin(func) {
        if (window.__user_id || $.util.getCookie('token_uin')) {
            func();
        } else {
            $.util.alert('请登录后操作');
            setTimeout(function () {
                location.href = '/user/login?redirect_url=/activity/details/' + window.__id;
            }, 1000);
        }
    }

    $(window).on('hashchange', function () {
        if (location.hash == '#allcoment') {
            $('#activity_detail').hide('slow');
            $('#allcoment').show('slow');
            $.ajax({
                type: 'post',
                url: '/activity/showAllComment/<?= $activity->id ?>',
                dataType: 'json',
                success: function (res) {
                    if (typeof res === 'object') {
                        if (res.status === true) {
                            $.util.dataToTpl('allComments', 'comment_tpl', res.data, function (d) {
                                d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                d.user_truename = d.user.truename;
                                d.user_company = d.user.company;
                                d.user_position = d.user.position;
                                d.user_id = d.user.id;
                                if (d.pid > 0) {
                                    d.body = '回复<span style="color:#222;"> ' + d.replyuser.truename + ' </span>：' + d.body;
                                }
                                d.style = '';
                                d.disable = '0';
                                if (d.hasOwnProperty('likes')) {
                                    if (d['likes'].length) {
                                        d.style = 'color:red';
                                        d.disable = '1';
                                    }
                                }
                                return d;
                            });
                            $('.fixed-btn').hide();
                        }
                    }
                }
            });
            var page = 3;
            setTimeout(function () {
                $(window).on("scroll", function () {
                    $.util.listScroll('items', function () {
                        if (page === 9999) {
                            $('#buttonLoading').html('亲，没有更多评论了');
                            return;
                        }
                        $.util.showLoading('buttonLoading');
                        $.getJSON('/activity/getMoreComment/' + page + '/' + <?= $activity->id; ?>, function (res) {
                            $.util.hideLoading('buttonLoading');
                            window.holdLoad = false;  //打开加载锁  可以开始再次加载

                            if (!res.status) {  //拉不到数据了  到底了
                                page = 9999;
                                return;
                            }

                            if (res.status) {
                                var html = $.util.dataToTpl('', 'comment_tpl', res.data, function (d) {
                                    d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                    d.user_truename = d.user.truename; // 名字
                                    d.user_company = d.user.company; // 公司
                                    d.user_position = d.user.position; // 职务
                                    d.user_id = d.user.id;
                                    if (d.pid > 0) {
                                        d.body = '回复<span style="color:#222;"> ' + d.reply.truename + ' </span>：' + d.body;
                                    }
                                    d.style = '';
                                    d.disable = '0';
                                    if (d.hasOwnProperty('likes')) {
                                        if (d['likes'].length) {
                                            d.style = 'color:red';
                                            d.disable = '1';
                                        }
                                    }
                                    return d;
                                });
                                $('#allComments').append(html);
                                page++;
                            }
                        });
                    });
                });
            }, 2000);
        } else {
            $('.fixed-btn').show();
            $('#activity_detail').show('slow');
            $('#allcoment').hide('slow');
        }
    });


    //ii=0;
    //$('body').on('touchstart', function(e){
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        //$('#article_comment').html((ii++)+em.id+'~~'+em.className)
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        switch (em.id) {
            // 喜欢
            case 'like':
                $.util.ajax({
                    url: '/activity/artLike/' + $(em).attr('artid'),
                    func: function (msg) {
                        if (typeof msg === 'object') {
                            $.util.alert(msg.msg);
                            if (msg.status) {
                                $('.like').toggleClass('hover');
                                if ($('.like').hasClass('hover')) {
                                    $('.like').html('&#xe61c;');
                                    $('.like_num').html(parseInt($('.like_num').html()) + 1);
                                } else {
                                    $('.like').html('&#xe61b;');
                                    $('.like_num').html(parseInt($('.like_num').html()) - 1);
                                }
                            } else {

                            }
                        }
                    }
                });
                break;

                // 收藏
            case 'collect':
                checkLogin(function () {
                    $.util.ajax({
                        url: '/activity/collect/' + $(em).attr('artid'),
                        func: function (msg) {
                            if (typeof msg === 'object') {
                                $.util.alert(msg.msg);
                                if (msg.status === true) {
                                    if ($(em).hasClass('hover')) {
                                        $(em).html('&#xe615;');
                                        $(em).removeClass('hover');
                                    } else {
                                        $(em).html('&#xe681;');
                                        $(em).addClass('hover');
                                    }
                                }
                            }
                        }
                    });
                });
                break;

                // 评论文章
            case 'publish_article':
                if (window.article == true)
                {
                    setTimeout(function () {
                        window.article = true;
                    }, 2000);
                    window.article = false;
                    var data = {};
                    var body = $('textarea[name="comment-content-article"]').val();
                    if (!body) {
                        $.util.alert('内容不可为空');
                        return false;
                    }
                    data.body = body;
                    data.pid = 0;
                    var activity_id = $('#publish_article').attr('activity_id');
                    $.util.ajax({
                        url: '/activity/doComment/' + activity_id,
                        data: data,
                        func: function (msg) {
                            if (typeof msg === 'object') {
                                if (msg.status === true) {
                                    $.util.alert(msg.msg);
                                    var html = $.util.dataToTpl('', 'comment_tpl', msg.data, function (d) {
                                        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                        d.user_truename = d.user.truename; // 名字
                                        d.user_company = d.user.company; // 公司
                                        d.user_position = d.user.position; // 职务
                                        if (d.pid > 0) {
                                            d.body = '回复<span style="color:#222"> ' + d.replyuser.truename + ' </span>：' + d.body;
                                        }
                                        return d;
                                    });
                                    $('#comment').prepend(html);
                                    $('#allComments').prepend(html);
                                    setTimeout(function(){
                                        $('.reg-shadow').hide();
                                        $('.shadow-info').removeClass('c-height').addClass('m-height');
                                        $('textarea[name="comment-content-article"]').val('');
                                    }, 400);
                                    
                                } else {
                                    $.util.alert(msg.msg);
                                }
                            }
                        }
                    });
                }
                break;
                // 回复评论
            case 'publish_reply':
                if (window.reply == true)
                {
                    setTimeout(function () {
                        window.reply = true;
                    }, 2000);
                    window.reply == false;
                    var data = {};
                    var body = $('textarea[name="comment-content-reply"]').val();
                    if (!body) {
                        $.util.alert('内容不可为空');
                        return false;
                    }
                    data.body = body;
                    data.pid = $('#publish_reply').attr('value');
                    var activity_id = $('#publish_reply').attr('activity_id');
                    $.util.ajax({
                        url: '/activity/doComment/' + activity_id,
                        data: data,
                        func: function (msg) {
                            if (typeof msg === 'object') {
                                if (msg.status === true) {
                                    $.util.alert(msg.msg);
                                    var html = $.util.dataToTpl('', 'comment_tpl', msg.data, function (d) {
                                        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                        d.user_truename = d.user.truename; // 名字
                                        d.user_company = d.user.company; // 公司
                                        d.user_position = d.user.position; // 职务
                                        if (d.pid > 0) {
                                            d.body = '回复<span style="color:#222;"> ' + d.replyuser.truename + ' </span>：' + d.body;
                                        }
                                        return d;
                                    });
                                    $('#comment').prepend(html);
                                    $('#allComments').prepend(html);
                                    setTimeout(function(){
                                        $('.reg-shadow').hide();
                                        $('.shadow-info').removeClass('c-height').addClass('m-height');
                                        $('textarea[name="comment-content-reply"]').val('');
                                    }, 400);
                                    
                                } else {
                                    $.util.alert(msg.msg);
                                }
                            }
                        }
                    });
                }
                break;
            case 'enroll':
                checkLogin(function () {
                    location.href = '/activity/enroll/' + $(em).attr('activity_id');
                });
                break;
            case 'share':
                if (navigator.userAgent.toLowerCase().indexOf('micromessenger') == -1) {
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
                    $('#isdel').hide();
                    $('#isdel').attr('com_id', '');
                    $('#choose').removeClass('hide_group');
                }, 400);
                break;
            case 'reply_shadow':
                setTimeout(function () {
                    $('.reg-shadow').hide();
                    $('.shadow-info').removeClass('c-height').addClass('m-height');
                }, 400);
                break;
            case 'article_shadow':
                setTimeout(function () {
                    $('.reg-shadow').hide();
                    $('.shadow-info').removeClass('c-height').addClass('m-height');
                }, 400);
                break;
            case 'yes':
                var id = $('#isdel').attr('com_id');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "/activity/del-comment/" + id,
                    success: function (res) {
                        $.util.alert(res.msg);
                        if (res.status) {
                            $('.reply_' + id).parent().remove();
                            setTimeout(function () {
                                $('#shadow').hide();
                                $('#isdel').hide();
                                $('#isdel').attr('com_id', '');
                            }, 400);
                        }
                    }
                });
                break;
            case 'no':
                setTimeout(function () {
                    $('#shadow').hide();
                    $('#isdel').hide();
                    $('#isdel').attr('com_id', '');
                }, 400);
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });

    ii = 0;
    $('body').on('click', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        $('#article_comment').html((ii++) + em.id + '~~' + em.className)
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        // 评论点赞
        if (em.id.indexOf('likecom_') != -1) {
            if ($(em).attr('disabled') == '1') {
                return false;
            }
            $.util.ajax({
                url: '/activity/comLike/' + $(em).attr('comid'),
                func: function (msg) {
                    console.log(msg);
                    if (typeof msg === 'object') {
                        if (msg.status === true) {
                            var num = $('.addnum_' + $(em).attr('comid')).siblings('.praise_num').text();
                            num = parseInt(num) + 1;
                            $('.addnum_' + $(em).attr('comid')).siblings('.praise_num').text(num);
                            $('.addnum_' + $(em).attr('comid')).siblings('.addnum').addClass('show');
                            // 动画结束前只能点击一次
                            var addnum = $('.addnum_' + $(em).attr('comid'))[0];
                            addnum.addEventListener("webkitAnimationEnd", function () {
                                $('.show').removeClass('show');
                            });
                            $('.addnum_' + $(em).attr('comid')).css('color', '#e01a48');
                            $('.addnum_' + $(em).attr('comid')).attr('disable', '1');
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        }
        // 回复评论
        if (em.id.indexOf('reply_') != -1) {
            var id = $(em).attr('value');
            checkLogin(function () {
                if ($(em).attr('user_id') == $('#article_comment').attr('user_id')) {
                    $('#shadow').show();
                    $('#isdel').show();
                    $('#isdel').attr('com_id', id);
                    return;
                }
                var reply_id = id;
                var msg = '回复 ' + $('#comment_username_' + reply_id).attr('user_name') + ' :';
                $('#r_textarea').attr('placeholder', msg);
                $('.reply-shadow').show();
                $('.reply').removeClass('m-height').addClass('c-height');
                var comid = $(em).attr('value');
                $('#publish_reply').attr('value', comid);
            });
        }
        switch (em.id) {
            // 点击评论
            case 'article_comment':
                checkLogin(function () {
                    $('.article-shadow').show();
                    $('.article').removeClass('m-height').addClass('c-height');
                });
                break;
            case 'article_comment_1':
                checkLogin(function () {
                    $('.article-shadow').show();
                    $('.article').removeClass('m-height').addClass('c-height');
                });
                break;
                // 回到顶部
            case 'toTop':
                window.scrollTo(0, 0);
                break;
                // 取消评论
            case 'cancel':
                LEMON.sys.hideKeyboard();
                setTimeout(function(){
                    $('.reg-shadow').hide();
                    $('.shadow-info').removeClass('c-height').addClass('m-height');
                }, 400);
                break;
            case 'want_enroll':
                if($(em).attr('is_multi') == 1){
                    $('#choose').toggleClass('hide_group');
                    if($('#choose').hasClass('hide_group')){
                        $('#shadow').show();
                    } else {
                        $('#shadow').hide();
                    }
                } else {
                    $.util.checkLogin('/activity/enroll/<?= $activity->id; ?>');
                }
                break;
        }
    });

    $('.a-detail img').on('click', function(){
        var imgs = [];
        $('.a-detail img').each(function(){imgs.push(this.src)});
        $.util.viewImg(this.src, imgs);
    });

</script>
<?php
$this->end('script');
