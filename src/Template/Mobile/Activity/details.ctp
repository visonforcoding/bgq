<body>
    <header>
        <div class='inner'>
            <a href='#this' class='toback'></a>
            <h1><?= $pagetitle ?></h1>
            <!--<a href="#this" class='iconfont collection h-regiser'>&#xe610;</a> // 收藏图标-->
            <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
        </div>
    </header>

    <div class="wraper" style="margin-bottom:2rem;">
        <section class="newscon-box a-detail">
            <h3><?= $activity->title; ?></h3>
            <img src="<?= $activity->cover; ?>"/>
            <p>主办单位：<?= $activity->company; ?></p>
            <p>时间：<?= $activity->time; ?></p>
            <p>地点：<?= $activity->address; ?></p>
            <p>规模：<?= $activity->scale; ?></p>
            <div class="a-other-info" style="text-indent: 0;font-size: 0.24rem;line-height: 0.36rem;padding-left: 0;width: 90%;margin: 0 auto;color: #9ba4ad;">
            <?php foreach ($activity->industries as $k=>$v): ?>
                <a><?= $v->name; ?></a>
            <?php endforeach; ?>
            </div>
        </section>
        <section class="a-detail newscomment-box">
            <h3 class="comment-title">活动介绍</h3>
            <p class="p"><?= $activity->summary; ?></p>
        </section>
        <section class="a-detail newscomment-box">
            <h3  class="comment-title">活动流程</h3>
            <?= $activity->body; ?>
        </section>
        <section class="a-detail newscomment-box guests">
	<?php if($activity->guest): ?>
            <h3 class="comment-title">参与嘉宾</h3>
            <?= $activity->guest; ?>
	<?php endif; ?>
            <div class="con-bottom clearfix">
                <!--阅读数-->
                <span class="readnums">
                    <i class="iconfont" style="font-size:0.3rem;">&#xe601;</i>
                    <?= $activity->read_nums; ?>
                </span>
                <!--喜欢按钮-->
                <span >
                    <i class="iconfont like <?php if ($isLike):?> changecolor<?php endif; ?>" artid="<?= $activity->id; ?>" type="0" id="like">&#xe616;</i>
                </span>
                <!--收藏按钮-->
                <span>
                    <i class='iconfont collect h-regiser <?php if ($isCollect):?> changecolor<?php endif; ?>' artid="<?= $activity->id; ?>" type="0" id="collect">&#xe610;</i>
                </span>
            </div>
        </section>
        <section class="newscomment-box joinnumber">
            <h3 class="comment-title">
                已报名
            </h3>
            <div class="items nobottom">
                <div class="comm-info clearfix">
                    <?php if($userApply): ?>
                    <?php foreach ($userApply as $k=>$v): ?>
                    <a href='javascript:void(0);'><img src="<?= $v['avatar']; ?>"/></a>
                    <?php endforeach; ?>
                    <?php else : ?>
                    暂时无人报名
                    <?php endif; ?>
                </div>
                <!-- <span>显示全部</span> -->
            </div>



        </section>
        <section class="newscomment-box">
            <h3 class="comment-title">
                评论
                <i class="iconfont">&#xe618;</i>
                <span id="article-comment">我要点评</span>
            </h3>
            <div id="comment"></div>
            <div id="buttonLoading" class="loadingbox"></div>
        </section>
        <footer class="footer">
            <div class="a-btn">
                <a href="/activity/recommend/<?= $activity->id; ?>">我要推荐</a>
                <?php if ($isApply != ''): ?>
                <?php if(in_array($activity->id, $isApply)): ?>
                <a>已报名(<?= $activity->apply_fee; ?>元)</a>
                <?php else: ?>
                <a href="/activity/enroll/<?= $activity->id; ?>">我要报名(<?= $activity->apply_fee; ?>元)</a>
                <?php endif; ?>
                <?php else: ?>
                <a href="/activity/enroll/<?= $activity->id; ?>">我要报名(<?= $activity->apply_fee; ?>元)</a>
                <?php endif; ?>
            </div>
        </footer>
    </div>
    <div class="reg-shadow article-shadow" ontouchmove="return false;" hidden>
        <div class="shadow-info a-shadow a-forword article">
            <ul>
                <li><textarea type="text" placeholder="请输入评论" name="comment-content-article"></textarea></li>
                <li>
                    <a href="javascript:void(0);" id="cancel">取消</a>
                    <a href="javascript:void(0);" id="publish-article" activity_id="<?= $activity->id; ?>">发表</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="reg-shadow reply-shadow" ontouchmove="return false;" hidden>
        <div class="shadow-info a-shadow a-forword reply">
            <ul>
                <li><textarea type="text" placeholder="请输入评论" name="comment-content-reply"></textarea></li>
                <li>
                    <a href="javascript:void(0);" id="cancel">取消</a>
                    <a href="javascript:void(0);" id="publish-reply" activity_id="<?= $activity->id; ?>">发表</a>
                </li>
            </ul>
        </div>
    </div>
</body>
<?php $this->start('script'); ?>
<script type="text/html" id="comment_tpl">
    <div class="items">
        <div class="comm-info clearfix">
            <span><img init_src="{#user_avatar#}"/></span>
            <span class="infor-comm">
                <i class="username">{#user_truename#} {#reply#}</i>
                <i class="job">{#user_company#} {#user_position#}</i>
            </span>
            <span>
                <b class="addnum" id="addnum_{#id#}">+1</b><i class="iconfont" id="likecom_{#id#}" type="0" comid="{#id#}">&#xe615;</i><b>{#praise_nums#}</b>
            </span>
        </div>
        <p class="infor-comm" id="reply_{#id#}" value="{#id#}">{#body#}</p>
    </div>
</script>
<script src="/mobile/js/details.js"></script>
<script>
    $.util.dataToTpl('comment', 'comment_tpl',<?= $comjson ?>, function (d) {
        d.user_avatar = d.user.avatar;
        d.user_truename = d.user.truename;
        d.user_company = d.user.company;
        d.user_position = d.user.position;
        d.reply = d.pid > 0 ? '@' + d.replyuser.truename : '';
        return d;
    });

    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                if (page == 9999) {
                    $('#buttonLoading').html('亲，没有更多资讯了，请明天再来吧');
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
                            d.avatar = d.user.avatar; // 头像
                            d.truename = d.user.truename; // 名字
                            d.company = d.user.company; // 公司
                            d.position = d.user.position; // 职务
                            d.reply = d.pid > 0 ? '@' + d.replyuser.truename : ''; // 是否回复别人的评论
                            return d;
                        });
                        $('#comment').append(html);
                        page++;
                    }
                });
            });
        });
    }, 2000);

//    $('.comment').click(function () {
//        $('.article-shadow').show();
//        $('.article').show();
//    });

//    $('.infor-comm').click(function () {
//        $('.reply-shadow').show();
//        $('.reply').show();
//        var comid = $(this).attr('value');
//        $('.publish-reply').attr('value', comid);
//    });

//    $('.cancel').click(function () {
//        $('.reg-shadow').hide();
//        $('.shadow-info').hide();
//    });

//    // 评论点赞
//    $('#likecom').on('click', function () {
//        $.ajax({
//            type: 'post',
//            url: '/activity/comLike/' + $(this).attr('comid'),
//            data: 'type=' + $(this).attr('type') + '&relate_id=' + $(this).attr('comid'),
//            dataType: 'json',
//            success: function (msg) {
//                if (typeof msg === 'object') {
//                    if (msg.status === true) {
//                        var num = $('.addnum').siblings('b').text();
//                        num = parseInt(num) + 1;
//                        $('.addnum').siblings('b').text(num);
//                        $('#likecom').siblings('.addnum').addClass('show');
//                        // 动画结束前只能点击一次
//                        var addnum = $('.addnum')[0];
//                        addnum.addEventListener("webkitAnimationEnd", function () {
//                            $('.show').removeClass('show');
//                        });
//                    } else {
//                        $.util.alert(msg.msg);
//                    }
//                }
//            }
//        });
//    });


//// 喜欢按钮
//$('.like').click(function () {
//    $.ajax({
//        type: 'post',
//        url: '/activity/artLike/' + $(this).attr('artid'),
//        data: 'type=' + $(this).attr('type') + '&relate_id=' + $(this).attr('artid'),
//        dataType: 'json',
//        success: function (msg) {
//            if (typeof msg === 'object') {
//                if (msg.status === true) {
//                    $('.like').toggleClass('changecolor');
//                } else {
//                    $.util.alert(msg.msg);
//                }
//            }
//        }
//    });
//});

//// 收藏按钮
//$('.collect').click(function () {
//    $.ajax({
//        type: 'post',
//        url: '/activity/collect/' + $(this).attr('artid'),
//        data: 'type=' + $(this).attr('type') + '&relate_id=' + $(this).attr('artid'),
//        dataType: 'json',
//        success: function (msg) {
//            if (typeof msg === 'object') {
//                if (msg.status === true) {
//                    $('.collect').toggleClass('changecolor');
//                } else {
//                    $.util.alert(msg.msg);
//                }
//            }
//        }
//    });
//});


//// 我要点评
//    $('.publish-article').click(function () {
//        var data = {};
//        var body = $('textarea[name="comment-content-article"]').val();
//        if (!body) {
//            $.util.alert('评论内容不可为空');
//            return false;
//        }
//        data.body = body;
//        data.pid = 0;
//        $.ajax({
//            type: 'post',
//            url: '/activity/doComment/<?= $activity->id ?>',
//            data: data,
//            dataType: 'json',
//            success: function (msg) {
//                if (typeof msg === 'object') {
//                    if (msg.status === true) {
//                        $.util.alert(msg.msg);
//                        setTimeout(function () {
//                            window.location.reload();
//                            window.doScroll('scrollbarDown');
//                        }, 3000);
//                    } else {
//                        $.util.alert(msg.msg);
//                    }
//                }
//            }
//        });
//    });
//
//    $('.publish-reply').click(function () {
//        var data = {};
//        var body = $('textarea[name="comment-content-reply"]').val();
//        if (!body) {
//            $.util.alert('评论内容不可为空');
//            return false;
//        }
//        data.body = body;
//        data.pid = $('.publish-reply').attr('value');
//        $.ajax({
//            type: 'post',
//            url: '/activity/doComment/<?= $activity->id ?>',
//            data: data,
//            dataType: 'json',
//            success: function (msg) {
//                if (typeof msg === 'object') {
//                    if (msg.status === true) {
//                        $.util.alert(msg.msg);
//                        setTimeout(function () {
//                            window.location.reload();
//                            window.doScroll('scrollbarDown');
//                        }, 3000);
//                    } else {
//                        $.util.alert(msg.msg);
//                    }
//                }
//            }
//        });
//    });

</script>
<?php $this->end('script');