<header class="myhome no-bottom">
    <div class='inner'>
        <h1>个人中心</h1>
    </div>
</header>

<div class="wraper newswraper">
    <div class="h-home-bottom" id="user" >
        <div class='inner h-home-top'></div>
        <div class="t-home-top">
            <span>
                <a href="/user/login?redirect_url=/home/index">
                    <img src="/mobile/images/touxiang.png">
                </a>
            </span>
        </div>
        <div class="todo" style="height:1.48rem;padding:0.25rem;visibility: hidden" id="loginBtn"><a href="/user/login?redirect_url=/home/index">登录 / 注册</a></div>
    </div>
    <div class="h-home-menu topnav">
        <ul class="clearfix">
            <li><a href="/home/my-xiaomi" class="clickbtn"><i></i>小秘书</a></li>
            <li><a href="javascript:location.href = ('/home/edit-userinfo?ref='+encodeURI(location.href))" class="clickbtn"><i></i>个人资料</a></li>
            <li><a href="/home/cardcase" class="clickbtn"><i></i>名片夹</a></li>
        </ul>
    </div>
    <ul class="h-home-menu navlist clearfix">
        <li><a href="/home/my-following" class="clickbtn"><i class="iconfont">&#xe614;</i>我的关注</a></li>
        <li><a href="/home/my-activity-submit" class="clickbtn mtips"><i class="iconfont">&#xe617;</i>我的活动<span id='activityMsg'></span></a></li>
        <li><a href="/home/my-collect-activity" class="clickbtn"><i class="iconfont">&#xe615;</i>我的收藏</a></li>
        <li><a href="/home/my-book" class="clickbtn mtips"><i class="iconfont">&#xe616;</i>我的约见<span id="meetMsg"></span></a></li>
    </ul>
    <!--分类一-->

    <div id="res"></div>


    <!-- 微信分享 -->
    <div class="reg-shadow" style="display: none;" id="shadow"></div>
    <div class="wxshare" id="wxshare" hidden>
        <span></span>
        <p></p>
    </div>
</div>
<script type="text/html" id="icoTpl">
    <div class="h-home-menu">
        <ul class="clearfix">
            <li><a href="/home/my-secret"><i class="iconfont">&#xe624;</i>隐私策略</a></li>
            <li><a id="shareTo" href="javascript:shareFriends();"><i class="iconfont">&#xe635;</i>邀请好友</a></li>
        </ul>
    </div>
</script>
<script type="text/html" id="savantTpl">
    <div class="h-home-menu">
        <ul class="clearfix">
            {#savant#}
            <li><a href="javascript:QRCode();"><i class="iconfont">&#xe60a;</i>扫一扫</a></li>
        </ul>
    </div>

</script>
<script type="text/html" id="userTpl">
    <div class='inner h-home-top'>
        <a href='/home/my-message-fans'><div class="iconfont share" style='width:.4rem;'>&#xe625;</div>
            {#hasMsg#}
        </a>
        <!--<h1>个人中心</h1>-->
        {#setUp#}
    </div>

    <div class="t-home-top">
        <a href="/user/home-page/{#user_id#}">
            <span>
                <img src="{#avatar#}"/>
            </span>
        </a>
    </div>
    <h3>{#truename#}
        {#v#}
    </h3>
    <div class="info-desc"><span><i class='iconfont'>&#xe62a;</i>{#company#}</span><span><i class='iconfont'>&#xe612;</i>{#position#}</span></div>
</script>
<script type="text/html" id='defaultTpl'>
    <div class='inner h-home-top'>
        <a href='/home/my-message-fans' class='iconfont share'><div class="iconfont share">&#xe625;</div></a>
        <!--<h1>个人中心</h1>-->
        <?php if (!$isWx): ?><a href="/home/my-install" class='iconfont share'>&#xe61e;</a><?php endif; ?>
    </div>
    <a href="javascript:void(0)">
        <div class="t-home-top">
            <span>
                <img src='/mobile/images/touxiang.png'/>
            </span>
        </div>
    </a>
</script>
<?= $this->element('footer') ?>
<?php $this->start('script') ?>
<script>
    window.onBackView = function () {
        var savant = '';
        $.ajax({
            type: 'POST',
            url: '/home/get-userinfo',
            dataType: 'json',
            success: function (res) {
                if (res.status) {
//                if(LEMON.isAPP){
//                    (LEMON.db.set('aaaaa', 123456));
//                    (LEMON.db.set('bbbbb', JSON.stringify({"abc":123})));
//                    alert('aaaaa'+LEMON.db.get('aaaaa'));
//                    alert('bbbbb'+LEMON.db.get('bbbbb'));
//                    
//                    alert(JSON.stringify(res.data));
//                    alert(LEMON.db.set('user_data', JSON.stringify(res.data)));
//                    alert(LEMON.db.get('user_data'));
//                    if(LEMON.db.get('user_data') == JSON.stringify(res.data)){
//                        res.data = JSON.parse(LEMON.db.get('user_data'));
//                    } else {
//                        LEMON.db.set('user_data', JSON.stringify(res.data));
//                    }
//                }
                    var html = $('#savantTpl').text();
                    var user = $('#userTpl').text();
                    var ico = $('#icoTpl').text();
                    savant = '<li><a href="/home/savant-auth"><i class="iconfont">&#xe623;</i>会员认证</a></li>';
                    if (res.data.user.level == 2) {
//                    savant = '<li><a href="/home/my-purse"><i class="iconfont">&#xe620;</i>钱包</a></li>';
                        user = user.replace('{#v#}', '<i class="v"></i>');
                    } else {

                        user = user.replace('{#v#}', '');
                    }
                    html = html.replace('{#savant#}', savant);
                    $('#res').html(html + ico);
                    if (res.data.hasMsg) {
                        user = user.replace('{#hasMsg#}', '<span class="opci"></span>');
                    } else {
                        user = user.replace('{#hasMsg#}', '');
                    }
                    if (!res.data.isWx) {
                        user = user.replace('{#setUp#}', '<a href="/home/my-install" class="iconfont share" >&#xe61e;</a>');
                    } else {
                        user = user.replace('{#setUp#}', '');
                    }
                    user = user.replace('{#user_id#}', res.data.user.id);
                    user = user.replace('{#truename#}', res.data.user.truename);
                    user = user.replace('{#company#}', res.data.user.company);
                    user = user.replace('{#position#}', res.data.user.position);
                    if (res.data.user.avatar) {
                        user = user.replace('{#avatar#}', res.data.user.avatar.replace('thumb_', ''));
                    } else {
                        user = user.replace('{#avatar#}', '/mobile/images/touxiang.png');
                    }
                    $('#user').html(user);
                    if (res.data.activityMsg) {
                        $('#activityMsg').addClass('opci');
                    }
                    if (res.data.meetMsg) {
                        $('#meetMsg').addClass('opci');
                    }
                } else {
                    $('#loginBtn').css("visibility","visible");
                    $('.clickbtn').on('click', function () {
                        $.util.alert('请先登录');
                        return false;
                    });
                }
            }
        });
    };
    window.onBackView();
    window.onActiveView = window.onBackView();

    function QRCode() {
        if ($.util.isAPP) {
            LEMON.sys.QRcode();
        } else if ($.util.isWX) {
            wx.scanQRCode({
                needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    //var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                }
            });
        } else {
            $.util.alert('请在APP或是微信使用扫一扫功能');
        }
    }

    function shareFriends() {
        // 分享设置
        LEMON.event.invite('向你推荐并购帮APP，里面有大量的并购资讯，并购活动，和很多并购大咖http://t.cn/RtSw8QS');
    }

    $('#wxshare').on('tap', function () {
        setTimeout(function () {
            $('#wxshare').hide();
            $('#shadow').hide();
        }, 400);
    });

    $('#shadow').on('tap', function () {
        setTimeout(function () {
            $('#wxshare').hide();
            $('#shadow').hide();
        }, 400);
    });
    if ($.util.isAPP) {
        $('.h-home-bottom').css({'padding-top': '0.8rem'});
    }
</script>
<?php $this->end('script'); ?>