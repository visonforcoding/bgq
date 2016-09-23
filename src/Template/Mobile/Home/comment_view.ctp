<!--<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>活动详情</h1>
    </div>
</header>-->
<div class="wraper pd10" style="display: block;">
    <section class="newscon-box a-detail">
        <a href="<?php if ($table == 'Activity'): ?>/activity/details/<?php else: ?>/news/view/<?php endif; ?><?= $relate_id ?>">
            <h3><?= $table->title ?></h3>
        </a>
        <!--add-->
        <h1 class="con-des origin"><!--<span><img src="../images/user.png" /></span>王璟-->
            <div class="website">
                <?php if ($table->user): ?><?= $table->truename ?><?php else: ?><?= $table->source ?><?php endif; ?>
            </div>
            <time><?= $table->create_time->i18nFormat('yyyy-MM-dd HH:mm') ?></time></h1>
    </section>
    <section class="newscomment-box no-t-border com_con_des">
        <div class="items">
            <div class="comm-info clearfix">
                <span><img src="<?= getAvatar($comment->user->avatar) ?>"/></span>
                <span class="infor-comm">
                    <i class="username"><?= $comment->user->truename ?><time><?= $comment->create_time->i18nFormat('yyyy-MM-dd HH:mm') ?></time></i>
                    <i class="job"><?= $comment->user->company ?> <?= $comment->user->position ?></i>
                </span>
                <span style="display:none;">
                    <i class="iconfont">&#xe61a;</i><?= $comment->praise_nums ?>
                </span>
            </div>
            <p class="a_bottom_comm"><?= $comment->body ?></p>
        </div>
    </section>

    <?php if ($likes): ?>
        <section class="newscomment-box com_img_pic ">
            <div class="items  no-bottom" >
                <a href="/home/all-like/<?= $id ?>?type=<?= $type ?>" style="width:100%;height:.42rem;display:block;">
                    <div class="comm-info fl">
                        <?php foreach ($likes as $like): ?>
                            <img src="<?= getAvatar($like->user->avatar) ?>"/>
                        <?php endforeach; ?>
                    </div>
                    <span id="" class="fr total_number">
                        <em><?= $comment->praise_nums ?></em>人赞过
                        <i class="iconfont">&#xe665;</i>	
                    </span>
                </a>
            </div>
        </section>
    <?php endif; ?>
    <section class="newscomment-box comm_bottom_des">
        <h3 class="comment-title " style="color:gray;">
            回复我的评论：
        </h3>
        <!--<div id="comment"><h4>还没任何评论</h4></div>-->
        <div id="comment"><h4>还没任何评论</h4></div>
    </section>
    <div class="shadow-info a-shadow a-forword">
        <ul>
            <li><textarea id="content" type="text" placeholder="请输入评论"></textarea></li>
            <li><a id="cancel" href="javascript:void(0);">取消</a><a id="submit" href="javascript:void(0);">发表</a></li>
        </ul>
    </div>
    <div class="reg-shadow" style="display: none;" id="shadow"></div>
    <div class="totips" hidden id="isdel" >
        <h3>确定要删除本条评论？</h3>
        <span style="display:none;"></span>
        <a href="javascript:void(0)" class="tipsbtn bggray" id="no">取消</a><a href="javascript:void(0)" class="tipsbtn bgred" id="yes">确认</a>
    </div>
</div>

<script type="text/html" id="tpl">
    <div class="items">
        <div class="comm-info clearfix">
            <span><a class="alink" href="/user/home-page/{#user_id#}"><img src="{#user_avatar#}"/></a></span>
            <span class="infor-comm">
                <a href="/user/home-page/{#user_id#}"> <i class="username">{#user_truename#}<time>{#create_time#}</time></i>  </a>
                <i class="job">{#user_company#} {#user_position#}</i>
            </span>
            <span data-disable="{#disable#}" data-id="{#id#}" id="praise_{#id#}">
                <b class="addnum">+1</b>
                <i style="{#style#}" class="iconfont praise_{#id#}">&#xe61a;</i>
                <em>{#praise_nums#}</em>
            </span>
        </div>
        <p class='a_bottom_comm' data-id="{#id#}" data-userid="{#user_id#}" data-username="{#user_truename#}" id="common_{#id#}">{#body#}</p>
    </div>
</script>
<?php $this->start('script'); ?>
<script>
    var table = '<?= $type=='1'?'news':'activity'; ?>';
    window.__user_id = <?= isset($user_id) ? $user_id : 0 ?>;
    window.comme_submit = true;
    window.__id = <?= $relate_id ?>;
</script>
<script>
    $.util.dataToTpl('comment', 'tpl', <?= json_encode($replys) ?>, function (d) {
        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
        d.user_truename = d.user.truename;
        d.user_company = d.user.company;
        d.user_position = d.user.position;
        d.user_id = d.user.id;
//        if (d.pid > 0) {
//            d.body = '回复<span style="color:rgba(0, 0, 0, 0.95);"> ' + d.reply.truename + ' </span>：' + d.body;
//        }
        d.style = '';
        d.disable = '0';
        if (d.hasOwnProperty('likes')) {
            if (d['likes'].length) {
                d.style = 'color:#b71c2d';
                d.disable = '1';
            }
        }
        return d;
    });
    
    function checkLogin(func) {
        if (window.__user_id || $.util.getCookie('token_uin')) {
            func();
        } else {
            $.util.alert('请登录后操作');
            setTimeout(function () {
                location.href = '/user/login?redirect_url=/news/view/' + window.__id;
            }, 1000);
        }
    }

    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        switch (em.id) {
            case 'commit':
                //弹出评论框
                checkLogin(function () {
                    $('#shadow').show('slow');
                    $('.shadow-info').removeClass('m-height').addClass('c-height');
                });
                break;
            case 'cancel':
                //关闭 评论框
                setTimeout(function () {
                    $('#shadow').hide('slow');
                    $('.shadow-info').removeClass('c-height').addClass('m-height');
                }, 400);
                break;
            case 'submit':
                //提交评论
                var content = $('#content').val();
                if (!content) {
                    $.util.alert('评论内容不可为空');
                    return false;
                }
                if (window.comme_submit == true)
                {
                    setTimeout(function () {
                        window.comme_submit = true;
                    }, 2000);
                    window.comme_submit = false;
                    $.util.ajax({
                        url: '/' + table + '/comment',
                        data: {reply_id: reply_id, content: content, id: window.__id},
                        func: function (res) {
                            if (res.status == true) {
                                $.util.alert(res.msg);
                                console.log(res.data);
                                var html = $.util.dataToTpl('', 'tpl', [res.data], function (d) {
                                    //d.industries_html = $.util.dataToTpl('', 'subTpl', d.industries);
                                    d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                    d.user_truename = d.user.truename;
                                    d.user_company = d.user.company;
                                    d.user_position = d.user.position;
                                    if (d.pid > 0) {
                                        d.body = '回复<span style="color:rgba(31, 27, 206, 0.95);"> ' + d.reply.truename + ' </span>：' + d.body;
                                    }
                                    d.style = '';
                                    d.disable = '0';
                                    if (d.hasOwnProperty('likes')) {
                                        if (d['likes'].length) {
                                            d.style = 'color:#b71c2d';
                                            d.disable = '1';
                                        }
                                    }
                                    return d;
                                });
                                $('#comment').prepend(html);
                                $('#allComments').prepend(html);
                                setTimeout(function () {
                                    $('#shadow').hide('slow');
                                    $('.shadow-info').removeClass('c-height').addClass('m-height');
                                    $('#content').val('');
                                }, 400);
                            } else {
                                $.util.alert(res.msg);
                            }
                        }
                    });
                }
                break;
            case 'shadow':
                setTimeout(function () {
                    $('#shadow').hide();
                    $('.shadow-info').removeClass('c-height').addClass('m-height');
                    $('#isdel').hide();
                    $('#isdel').attr('com_id', '');
                }, 400);
                break;
        }
    });
    
    if ($.util.isIOS) {
        $.util.tap($('body'), doClick);
    } else {
        $('body').on('click', doClick);
    }
    
    function doClick(e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('praise_') !== -1) {
            //对评论的赞
            var id = $(em).data('id');
            var obj = $(em);
            if (obj.data('disable') === '1') {
                return false;
            }
            $('#praise_' + id).data('disable', '1');
            checkLogin(function () {
                $.util.ajax({
                    url: '/news/comment-praise',
                    data: {id: id},
                    func: function (res) {
                        if (res.status) {
                            console.log($('.praise_' + id));
                            $('.praise_' + id).siblings('.addnum').show();
                            $('.praise_' + id).siblings('em').html(parseInt(obj.find('em').text()) + 1);
                            $('.praise_' + id).css('color', '#b71c2d');
                            setTimeout(function () {
                                $('.praise_' + id).siblings('.addnum').hide();
                            }, 1000);
                        } else {
                            $('#praise_' + id).data('disable', '0');
                        }
                    }
                });
            });
        }
        if (em.id.indexOf('common_') !== -1) {
            //回复评论
            var id = $(em).data('id');
            var user_id = window.__user_id;
            if ($(em).data('userid') == user_id) {
                $('#shadow').show();
                $('#isdel').show();
                $('#isdel').attr('com_id', id);
                return;
            }
            reply_id = id;
            $('#content').attr('placeholder', '回复 ' + $(em).data('username') + '：');
            $('#shadow').show('slow');
            $('.shadow-info').removeClass('m-height').addClass('c-height');
        }
    }
</script>
<?php
$this->end('script');
