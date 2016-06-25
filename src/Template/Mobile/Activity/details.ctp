<body>
    <?= $this->element('header'); ?>
    <div class="wraper" id="activity_detail" style='padding-bottom:1.2rem;'>
        <section class="newscon-box a-detail">
            <h3><?= $activity->title; ?></h3>
           <div> <img src="<?= $activity->cover; ?>"/></div>
            <p>主办单位：<?= $activity->company; ?></p>
            <p>时间：<?= $activity->time; ?></p>
            <p>地点：<?= $activity->address; ?></p>
            <p>规模：<?= $activity->scale; ?></p>
            <div class="a-other-info" style="text-indent: 0;font-size: 0.24rem;line-height: 0.36rem;padding-left: 0;width: 90%;margin: 0 auto;color: #9ba4ad;">
                <a><?= $activity->region->name; ?></a>
                <?php foreach ($activity->industries as $k => $v): ?>
                    <a><?= $v->name; ?></a>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="a-detail newscomment-box">
            <h3 class="comment-title">活动介绍</h3>
            <div class="innercon">
                <?= $activity->summary; ?>
            </div>
        </section>
        <section class="a-detail newscomment-box">
            <h3  class="comment-title">活动流程</h3>
            <div class="innercon"><?= $activity->body; ?></div>
        </section>
        <section class="a-detail newscomment-box guests">
            <?php if ($activity->guest): ?>
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
                    <i class="iconfont like <?php if ($isLike): ?> changecolor<?php endif; ?>" artid="<?= $activity->id; ?>" type="0" id="like">&#xe616;</i>
                </span>
            </div>
        </section>
        <section class="newscomment-box joinnumber">
            <h3 class="comment-title">
                已报名
            </h3>
            <div class="items nobottom">
                <div class="comm-info clearfix">
                    <?php if ($userApply): ?>
                        <?php foreach ($userApply as $k => $v): ?>
                            <a href='/meet/homepage/<?= $v['id'] ?>'><img src="<?= $v['avatar'] ? $v['avatar'] : '/mobile/images/touxiang.png'; ?>"/></a>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div style="font-size:0.2rem;line-height: 0.22rem;">暂时无人报名</div>
                    <?php endif; ?>
                </div>
                <!-- <span>显示全部</span> -->
            </div>
        </section>
        <section class="newscomment-box">
            <h3 class="comment-title">
                评论
                <!-- <i class="iconfont">&#xe618;</i> -->
            </h3>
            <div id="comment"><h4>还没任何评论</h4></div>
            <span class='com-all' style="display:none;"><a href="#allcoment" id="showAllComment">显示全部</a></span>
        </section>
        <div class="a-btn">
            <a href="/activity/recommend/<?= $activity->id; ?>">我要赞助</a>
            <?php if ($isApply != ''): ?>
                <?php if (in_array($activity->id, $isApply)): ?>
                    <a>已报名(<?= $activity->apply_fee; ?>元)</a>
                <?php else: ?>
                    <a id="enroll" activity_id="<?= $activity->id; ?>" user_id="<?= $user; ?>">我要报名(<?= $activity->apply_fee; ?>元)</a>
                <?php endif; ?>
            <?php else: ?>
                <a id="enroll" activity_id="<?= $activity->id; ?>" user_id="<?= $user; ?>">我要报名(<?= $activity->apply_fee; ?>元)</a>
            <?php endif; ?>
        </div>
        <!--专家推荐-->
        <?php if ($activity->savants): ?>
            <div class="expert-commond innercon">
                <ul>
                    <?php foreach ($activity->savants as $k => $v): ?>
                        <li>
                            <a href="javascript:void(0)">
                                <img src="<?= $v['user']['avatar'] ? $v['user']['avatar'] : '/mobile/images/touxiang.png' ?>" alt="<?= $v['user']['truename'] ?>" />
                                <h3><?= $v['user']['truename'] ?><span><?= $v['user']['company'] ?> <?= $v['user']['position'] ?></span></h3>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <div class="wraper pd10" id="allcoment" style="display:none;">
        <section class="newscomment-box">
            <h3 class="comment-title">
                评论
                <span><i class="iconfont">&#xe618;</i>我要点评</span>
            </h3>
            <div id="allComments"></div>
            <div id="buttonLoading" class="loadingbox"></div>
        </section>
    </div>

    <!--底部四个图-->
    <div class="iconlist">
        <span class="iconfont" id="article_comment" user_id="<?= $user; ?>">&#xe618;</span>
        <span class="iconfont <?php if (!$isCollect): ?>active<?php endif; ?>" id="collect" artid="<?= $activity->id; ?>" >&#xe610;</span>
        <span class="iconfont" id="share">&#xe614;</span>
        <span class="iconfont" id='toTop'></span>
    </div>
    <div class="reg-shadow article-shadow" ontouchmove="return false;" hidden>
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
    </div>

    <div class="reg-shadow reply-shadow" ontouchmove="return false;" hidden>
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
    </div>
</body>
<?php $this->start('script'); ?>
<script type="text/html" id="comment_tpl">
    <div class="items">
        <div class="comm-info clearfix">
            <a href="/user/home-page/{#user_id#}" class="alink">
            <span><img src="{#user_avatar#}"/></span>
            </a>
            <a href="/user/home-page/{#user_id#}" class="alink">
            <span class="infor-comm">
                <i class="username" id='comment_username_{#id#}'>{#user_truename#} {#reply#}<time>{#create_time#}</time></i>
                <i class="job">{#user_company#} {#user_position#}</i>
            </span>
            </a>
            <span>
                <b class="addnum" id="addnum_{#id#}">+1</b>
                <i class="iconfont" id="likecom_{#id#}" type="0" comid="{#id#}">&#xe615;</i>
                <b>{#praise_nums#}</b>
            </span>
        </div>
        <p class="infor-comm" id="reply_{#id#}" value="{#id#}" user_id="{#user_id#}">{#body#}</p>
    </div>
</script>
<script src="/mobile/js/activity_details.js"></script>
<script>
    // 分享设置
    window.shareConfig.link = 'http://m.chinamatop.com/news/view/<?= $activity->id ?>';
    window.shareConfig.title = '<?= $activity->title ?>';
    var share_desc = '<?= $activity->share_desc ?>';
    share_desc && (window.shareConfig.desc = share_desc);
</script>
<script>
    window.article = true;
    window.reply = true;
    $.util.dataToTpl('comment', 'comment_tpl',<?= $comjson ?>, function (d) {
        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
        d.user_truename = d.user.truename;
        d.user_company = d.user.company;
        d.user_position = d.user.position;
        d.user_id = d.user.id;
        if(d.pid>0)
        {
            d.body = '回复<span style="color:rgba(31, 27, 206, 0.95);"> ' + d.reply.truename + ' </span>：' + d.body;
        }
        return d;
    });
    
    // 少于五条评论隐藏显示全部
    var circle = setInterval(function(){
        if($('#comment').children('.items').length >= 5)
        {
            $('.com-all').show();
            clearInterval(circle);
        }
    },100);

    $(window).on('hashchange', function () {
        if (location.hash == '#allcoment')
        {
            $('#activity_detail').hide('slow');
            $('#allcoment').show('slow');
            $.ajax({
                type: 'post',
                url: '/activity/showAllComment/<?= $activity->id ?>',
                dataType: 'json',
                success: function (res) {
                    if (typeof res === 'object') {
                        if (res.status === true) {
                            $.util.dataToTpl('allComments', 'comment_tpl',res.data, function (d) {
                                d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                d.user_truename = d.user.truename;
                                d.user_company = d.user.company;
                                d.user_position = d.user.position;
                                d.reply = d.pid > 0 ? '@' + d.replyuser.truename : '';
                                return d;
                            });
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
                                    d.reply = d.pid > 0 ? '@' + d.replyuser.truename : ''; // 是否回复别人的评论
                                    return d;
                                });
                                $('#allComments').append(html);
                                page++;
                            }
                        });
                    });
                });
            }, 2000);
        } else
        {
            $('#activity_detail').show('slow');
            $('#allcoment').hide('slow');
        }
    });
    
    
    
</script>
<?php
$this->end('script');
