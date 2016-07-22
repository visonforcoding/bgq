<header class="myhome no-bottom">
    <div class='inner'>
        <h1>个人中心</h1>
    </div>
</header>

<div class="wraper newswraper">
    <div class="h-home-bottom" id="user" >
        <div class='inner h-home-top'>
                    <a href='/home/my-message-fans' class='iconfont share' >&#xe625;</a>
                      <!--<h1>个人中心</h1>-->
                    <?php if(!$isWx): ?><a href="/home/my-install" class='iconfont share'>&#xe61e;</a><?php endif;?>
                </div>
        <a href="javascript:void(0)">
            <div class="t-home-top">
                <span>
                    <img src='/mobile/images/touxiang.png'/>
                </span>
            </div>
            <h3 id="username">张三
                    <i class="v"></i>
            </h3>
            <div class="info-desc"><span><i class="iconfont">&#xe62a;</i>并购菁英有限公司</span><span><i class="iconfont">&#xe612;</i>技术主管</span></div>
        </a>
    </div>
    <div class="h-home-menu topnav">
        <ul class="clearfix">
            <li><a href="/home/my_xiaomi"><i></i>小秘书</a></li>
            <li><a href="/home/edit-userinfo"><i></i>个人资料</a></li>
            <li><a href="/home/cardcase"><i></i>名片夹</a></li>
        </ul>
    </div>
    <ul class="h-home-menu navlist clearfix">
        <li><a href="/home/my-following"><i class="iconfont">&#xe614;</i>我的关注</a></li>
        <li><a href="/home/my_activity_submit"><i class="iconfont">&#xe617;</i>我的活动</a></li>
        <li><a href="/home/my-collect-activity"><i class="iconfont">&#xe615;</i>我的收藏</a></li>
        <li><a href="/home/my-book"><i class="iconfont">&#xe616;</i>我的约见</a></li>
    </ul>
    <!--分类一-->
    
    <div id="res"></div>
    
    
    <!-- 微信分享 -->
<div class="reg-shadow" style="display: none;" id="shadow"></div>
<div class="wxshare" id="wxshare" hidden>
    <span></span>
    <p></p>
 </div>
<div class="reg-shadow" style="display: none;" id="loginShadow"></div>
<div class="totips" style="display: none;">
    <h3>您还没有登录</h3>
    <span></span>
    <a href="/user/login?redirect_url=/home/index" class="nextstep">去登录</a>
    <!--<span class='closed'>
            &times;
    </span>-->
</div>
</div>
<script type="text/html" id="icoTpl">
    <div class="h-home-menu">
        <ul class="clearfix">
            <li><a href="/home/my-secret"><i class="iconfont">&#xe624;</i>隐私策略</a></li>
            <li><a id="shareTo" href="javascript:shareFriends();"><i class="iconfont">&#xe626;</i>邀请好友</a></li>
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
        <a href='/home/my-message-fans' class='iconfont share' style="display: block;width: 20px;height:30px;">&#xe625;
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
    <div class="info-desc"><span><i></i>{#company#}</span><span><i></i>{#position#}</span></div>
    
</script>
<?= $this->element('footer') ?>
<?php $this->start('script') ?>
<script>
    var savant = '';
    $.ajax({
        type: 'POST',
        url: '/home/get-userinfo',
        dataType: 'json',
        success: function (res) {
            if(res.status){
                var html = $('#savantTpl').text();
                var user = $('#userTpl').text();
                if(res.data.user.level == 2) {
                    savant = '<li><a href="/home/my-purse"><i class="iconfont">&#xe620;</i>钱包</a></li>';
                    html += '<div class="h-home-menu"><ul class="clearfix"><li><a href="/meet/view/' + res.data.user.id + '"><i class="iconfont">&#xe621;</i>专家主页</a></li><li><a href="/home/savant-auth"><i class="iconfont">&#xe623;</i>专家认证</a></li></ul></div>';
                    user = user.replace('{#v#}','<i class="v"></i>');
                } else {
                    savant = '<li><a href="/home/savant-auth"><i class="iconfont">&#xe623;</i>专家认证</a></li>';
                    user = user.replace('{#v#}','');
                }
                html = html.replace('{#savant#}', savant);
                $('#res').html(html+$('#icoTpl').text());
                if(res.data.hasMsg){
                    user = user.replace('{#hasMsg#}','<span class="opci"></span>');
                } else {
                    user = user.replace('{#hasMsg#}','');
                }
                if(!res.data.isWx){
                    user = user.replace('{#setUp#}','<a href="/home/my-install" class="iconfont share" style="display: block;width: 20px;height:30px;">&#xe61e;</a>');
                } else {
                    user = user.replace('{#setUp#}','');
                }
                user = user.replace('{#user_id#}',res.data.user.id);
                user = user.replace('{#truename#}',res.data.user.truename);
                user = user.replace('{#company#}',res.data.user.company);
                user = user.replace('{#position#}',res.data.user.position);
                if(res.data.user.avatar){
                    user = user.replace('{#avatar#}', res.data.user.avatar);
                } else {
                    user = user.replace('{#avatar#}', '/mobile/images/touxiang/png');
                }
                $('#user').html(user);
            } else {
                $('#loginShadow').show();
                $('.totips').show();
            }
       }
    });
    
    function QRCode() {
        if ($.util.isAPP) {
            LEMON.sys.QRcode();

        }
        else if ($.util.isWX) {
            wx.scanQRCode({
                needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    //var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                }
            });
        }
        else {
            $.util.alert('请在APP或是微信使用扫一扫功能');
        }
    }
    
    function shareFriends(){
        // 分享设置
        window.shareConfig.link = 'http://m.chinamatop.com/';
        window.shareConfig.title = '并购帮';
        if($.util.isAPP){
            LEMON.share.banner();
        } else if ($.util.isWX){
            $('#wxshare').show();
            $('#shadow').show();
        }
    }
    
    $('#wxshare').on('tap', function(){
        setTimeout(function(){
            $('#wxshare').hide();
            $('#shadow').hide();
        },400);
    });
    
    $('#shadow').on('tap', function(){
        setTimeout(function(){
            $('#wxshare').hide();
            $('#shadow').hide();
        },400);
    });
    if ($.util.isAPP) {
        $('.h-home-bottom').css({'padding-top':'0.8rem'});
    }
</script>
<?php $this->end('script'); ?>