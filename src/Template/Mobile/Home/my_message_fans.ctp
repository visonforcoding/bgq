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
        <a href="/home/my-message-fans" class="active">新的关注<?php if ($unReadFollowCount): ?><i><?= $unReadFollowCount ?></i><?php endif; ?></a>
        <a href="/home/my-message-sys">系统消息<?php if ($unReadSysCount): ?><i><?= $unReadSysCount ?></i><?php endif; ?></a>
    </div>
    <div id='follow'></div>
</div>
<script type="text/html" id="listTpl">
    <section class="internet-v-info no-margin-top">
        <div class="innercon">
            <a href="/user/home-page/{#follower_id#}">
                <span class="head-img"><img src="{#follower_avatar#}"/><i></i></span>
            </a>
            <div class="vipinfo my-meet-info">
                <h3>{#follower_truename#}{#type#}</h3>
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
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    if ($.util.isAPP) {
        LEMON.sys.back('/home/index');
    }
    $.util.dataToTpl('follow', 'listTpl',<?= json_encode($fans) ?>, function (d) {
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
        d.follower_fans = d.u.fans;
        return d;
    });
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
                obj.attr('style','color:green');
            }
        });
    });
</script>
<?php $this->end('script'); ?>