<header class="myhome no-bottom">
    <div class='inner'>
        <h1>个人中心</h1>
    </div>
</header>
<div class="wraper">
    <div class="h-home-bottom">
        <a href="/user/home-page">
            <div><span>
                    <img src="<?= empty($user->avatar) ? '/mobile/images/touxiang.jpg' : $user->avatar ?>"/></span><i class="iconfont">&#xe61e;</i>
            </div>
            <h3><?= $user->truename ?><span><?= $user->company ?> <?= $user->position ?></span></h3>
        </a>
    </div>
    <ul class="h-home-menu navlist clearfix">
        <li><a href="/home/my-following"><i class="iconfont">&#xe60f;</i>我的关注</a></li>
        <li><a href="/home/my-collect-activity"><i class="iconfont">&#xe610;</i>我的收藏</a></li>
        <li><a href="/home/my-book"><i class="iconfont">&#xe60b;</i>我的约见</a></li>
        <li><a href="/home/my_activity_submit"><i class="iconfont">&#xe601;</i>我的活动</a></li>
    </ul>
    <!--分类一-->

    <div class="h-home-menu">
        <ul class="clearfix">
            <li><a href="/home/cardcase"><i class="iconfont">&#xe609;</i>名片夹</a></li>
            <li><a href="/user/home-page"><i class="iconfont">&#xe61c;</i>个人主页</a></li>
            <li><a href="/home/my-purse"><i class="iconfont">&#xe61b;</i>钱包</a></li>
            <li><a href="javascript:QRCode();"><i class="sao-bg"></i>扫一扫</a></li>
        </ul>
    </div>
    <!--分类二-->
    <div class="h-home-menu">
        <ul class="clearfix">
            <li><a href="/meet/view/<?= $user->id ?>"><i class="iconfont">&#xe61d;</i>专家主页</a></li>
            <li>  <a href="/home/savant-auth"><i class="iconfont">&#xe61e;</i>专家认证</a></li>
        </ul>
    </div>
    <div class="h-home-menu">
        <ul class="clearfix">
            <li><a href="/home/my-secret"><i class="iconfont">&#xe61f;</i>隐私策略</a></li>
            <li><a id="shareTo" href="#this"><i class="iconfont">&#xe621;</i>邀请好友</a></li>
            <li><a href="/home/my-message-fans"><i class="iconfont">&#xe620;</i>消息通知</a></li>
            <li><a href="/home/my-install"><i class="iconfont">&#xe619;</i>设置</a></li>
        </ul>
    </div>
</div>
<div class="submitbtn">
    <a href="/home/my_xiaomi"><img src="/mobile/images/ms.png"/></a>
</div>
<?= $this->element('footer') ?>
<?php $this->start('script') ?>
<script>
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
</script>
<?php $this->end('script'); ?>