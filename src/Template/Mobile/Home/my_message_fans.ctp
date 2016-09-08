<header>
    <div class='inner'>
        <a href='/home/index' class='toback'></a>
        <h1 class="m-message-top">
            我的消息
        </h1>
        <!--   <h1 class="m-message-top">
              <a href="javascript:void(0);" class="active">新的关注<i><?= $unReadCount ?></i></a>|
              <a href="/home/my-message-sys">系统消息<i>3</i></a>
          </h1> -->
        <!-- <a href="javascript:void(0);" class="h-regiser h-add"></a> -->
    </div>
</header>
<div class="wraper">
    <div class="inner my-home-menu m-message-top" >
        <a href="javascript:void(0)" id="newFollow">新的关注<?php if ($unReadFollowCount): ?><i><?= $unReadFollowCount ?></i><?php endif; ?></a>
        <a href="javascript:void(0)" id="sysMes">系统消息<?php if ($unReadSysCount): ?><i><?= $unReadSysCount ?></i><?php endif; ?></a>
    </div>
    <ul id='follow' class="systerm-info-box"></ul>
    <div id="buttonLoading" class="loadingbox"></div>
</div>
<script type="text/html" id="fansTpl">
    <section class="internet-v-info no-margin-top">
        <div class="innercon">
            <a href="/user/home-page/{#follower_id#}">
                <span class="head-img"><img src="{#follower_avatar#}"/>{#v#}</span>
            </a>
            <div class="vipinfo my-meet-info">
                <h3>{#follower_truename#}</h3>
                <a class="alink" href="/user/home-page/{#follower_id#}">
                    <span class="job">{#follower_company#}&nbsp;&nbsp;{#follower_position#}</span>
                    <div class="mark">
                        <span class="datetime">{#create_time#} <span class="meetnum">{#follower_fans#}人已关注</span></span>
                    </div>
                </a>
            </div>
        </div>
    </section>	
</script>
<script type="text/html" id="sysTpl">
    <li>
        <div>
            <a url="{#jump_url#}" style="background: none;" msg_id='{#id#}' class="read">
                <h3>{#title#}</h3>
                <span class="msg_color {#color#}">{#msg#}</span>
                <span class='datetime'>{#create_time#}</span>
            </a>
        </div>
        <a url="{#jump_url#}" class="fr r-more read" status="{#status#}" msg_id='{#id#}'><span style='display:inline;' id="msg_{#id#}">{#status_msg#}</span><i class="iconfont">&#xe667;</i></a>
    </li>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    var type = '<?= $type ?>';
</script>
<script>
    if ($.util.isAPP) {
        LEMON.sys.back('/home/index');
    }
    var page = 2;
    function followTap(em) {
        if ($(em).hasClass('active')) {
            return;
        } else {
            $(em).addClass('active');
            $('#sysMes').removeClass('active');
        }
        $.util.hideLoading('buttonLoading');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/get-fans-message",
            success: function (res) {
                if (res.status) {
                    $.util.dataToTpl('follow', 'fansTpl', res.data, function (d) {
                        d.follower_truename = d.u.truename;
                        d.follower_company = d.u.company;
                        d.follower_avatar = d.u.avatar ? d.u.avatar : '/mobile/images/touxiang.png';
                        d.follower_position = d.u.position;
                        d.follower_id = d.u.id;
                        if (d.uf.type == '2') {
                            d.type = '<span style="color:green" class="meetnum f-color-black">√已关注</span>';
                        }
                        if (d.uf.type == '1') {
                            d.type = '<span style="color:red" data-id="' + d.u.id + '" class="meetnum follow_btn color-items">+加关注</span>';
                        }
                        d.v = d.u.level == 2 ? '<i></i>' : '';
                        d.follower_fans = d.u.fans;
                        return d;
                    });
                } else {
                    $('#follow').html('<div class="nocontent"><i class="iconfont">&#xe688;</i><span>你还没有任何粉丝</span></div>');
                }
            }
        });
    }

    function sysTap(em) {
        if ($(em).hasClass('active')) {
            return;
        } else {
            $(em).addClass('active');
            $('#newFollow').removeClass('active');
        }
        page = 2;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/get-sys-message/1",
            success: function (res) {
                if (res.status) {
                    $.util.dataToTpl('follow', 'sysTpl', res.data, function (d) {
                        d.jump_url = d.url ? d.url : '#this';
                        if (d.status) {
                            d.status_msg = '已读';
                            d.color = 'f-color-gray';
                        } else {
                            d.status_msg = '未读';
                            d.color = 'f-color-black';
                        }
                        return d;
                    });
                    $('.read').on('tap', function () {
                        var id = $(this).attr('msg_id');
                        var obj = $(this);
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: "/home/read_msg/" + id,
                            success: function (res) {
                                var num = $('#sysMes').children('i').html();
                                if (parseInt(num) - 1 == 0) {
                                    $('#sysMes').children('i').remove();
                                } else {
                                    $('#sysMes').children('i').html(parseInt(num) - 1);
                                }
                                obj.find('.msg_color').removeClass('f-color-black').addClass('f-color-gray');
                                $('span#msg_' + id).html('已读');
                                location.href = obj.attr('url');
                            }
                        });
                    });
                } else {
                    $('#follow').html('');
                    $.util.alert(res.msg);
                }
            }
        });
        
    }

    if (type == 1) {
        followTap($('#newFollow').get(0));
    } else {
        sysTap($('#sysMes').get(0));
    }

    $('.follow_btn').on('click', function () {
        //关注
        var user_id = $(this).data('id');
        var obj = $(this);
        $.util.ajax({
            url: '/user/follow',
            data: {id: user_id},
            func: function (res) {
                $.util.alert(res.msg);
                obj.text('√已关注')
                obj.attr('style', 'color:green');
            }
        });
    });

    $('#newFollow').on('tap', function () {
        $('#newFollow').find('i').remove();
        followTap(this);
    });

    $('#sysMes').on('tap', function () {
        $('#newFollow').find('i').remove();
        sysTap(this);
    });

    function scroll(){
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                if (page == 9999) {
                    $('#buttonLoading').html('亲，没有更多条目了，请看看其他的栏目吧');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "/home/get-sys-message/" + page,
                    success: function (res) {
                        $.util.hideLoading('buttonLoading');
                        window.holdLoad = false;  //打开加载锁  可以开始再次加载

                        if (!res.status) {  //拉不到数据了  到底了
                            page = 9999;
                            return;
                        }
                        if (res.status) {
                            var html = $.util.dataToTpl('', 'sysTpl', res.data, function (d) {
                                d.jump_url = d.url ? d.url : '#this';
                                if (d.status) {
                                    d.status_msg = '已读';
                                    d.color = 'f-color-gray';
                                } else {
                                    d.status_msg = '未读';
                                    d.color = 'f-color-black';
                                }
                                return d;
                            });
                            $('#follow').append(html);
                            if (res.data.length < 10) {
                                page = 9999;
                                $('#buttonLoading').html('亲，没有更多消息了');
                            } else {
                                page++;
                            }
                            $('.read').on('tap', function () {
                                var id = $(this).attr('msg_id');
                                var obj = $(this);
                                $.ajax({
                                    type: 'POST',
                                    dataType: 'json',
                                    url: "/home/read_msg/" + id,
                                    success: function (res) {
                                        var num = $('#sysMes').children('i').html();
                                        if (parseInt(num) - 1 == 0) {
                                            $('#sysMes').children('i').remove();
                                        } else {
                                            $('#sysMes').children('i').html(parseInt(num) - 1);
                                        }
                                        obj.find('.msg_color').removeClass('f-color-black').addClass('f-color-gray');
                                        $('span#msg_' + id).html('已读');
                                        location.href = obj.attr('url');
                                    }
                                });
                            });
                        } else {
                            $('#follow').html('');
                            $.util.alert(res.msg);
                        }
                    }
                });
            });
        });
    }
</script>
<?php $this->end('script'); ?>