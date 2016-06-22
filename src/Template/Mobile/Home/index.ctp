<header class="myhome no-bottom">
    <div class='inner'>
        <h1>个人中心</h1>
    </div>
</header>
<div class="wraper newswraper">
    <div class="h-home-bottom">
        <div><span><a href="/home/edit-userinfo"><img src="<?= $user->avatar ?>"/></a></span><i class="iconfont">&#xe61e;</i></div>
        <h3><?= $user->truename ?><span><?= $user->company ?> <?= $user->position ?></span></h3>
    </div>
    <ul class="h-home-menu clearfix">
        <li><a href="/home/my-following"><i class="iconfont">&#xe60f;</i>我的关注</a></li>
        <li><a href="/home/my-collect-activity"><i class="iconfont">&#xe610;</i>我的收藏</a></li>
        <li><a href="/home/my-book"><i class="iconfont">&#xe60b;</i>我的约见</a></li>
        <li><a href="/home/my-activity-submit"><i class="iconfont">&#xe601;</i>我的活动</a></li>
    </ul>
    <!--分类一-->
    <div class="h-home-menulist">
        <ul class="innercon">
            <li><a href="#this"><i class="iconfont">&#xe609;</i>名片夹</a></li>
            <li><a href="/home/my-purse"><i class="iconfont">&#xe61b;</i>钱包</a></li>
            <li><a href="/meet/view/<?= $user->id ?>"><i class="iconfont">&#xe61c;</i>专家主页</a></li>
        </ul>
    </div>
    <!--分类二-->
    <div class="h-home-menulist">
        <ul class="innercon">
            <li>
                <a href="/home/realname-auth"><i class="iconfont">&#xe61d;</i>实名认证<i class="otherintroduce clearfix">
                        <?php if ($user->status == '1'): ?>未认证<?php endif; ?>
                        <?php if ($user->status == '2'): ?>已认证<?php endif; ?>
                        <?php if ($user->status == '0'): ?>不通过<?php endif; ?>
                    </i>
                </a>
            </li>
            <li>
                <a href="/home/savant-auth"><i class="iconfont">&#xe61e;</i>
                    专家认证<i class="otherintroduce clearfix">
                        <?php if ($user->savant_status == '1'): ?>未认证<?php endif; ?>
                        <?php if ($user->savant_status == '2'): ?>待审核<?php endif; ?>
                        <?php if ($user->savant_status == '3'): ?>已认证<?php endif; ?>
                        <?php if ($user->savant_status == '0'): ?>不通过<?php endif; ?>
                    </i>
                </a>
            </li>
        </ul>
    </div>
    <!--分类三-->
    <div class="h-home-menulist">
        <ul class="innercon">
            <li><a href="/home/my-secret"><i class="iconfont">&#xe61f;</i>隐私策略</a></li>
            <li><a href="/home/my-message-fans"><i class="iconfont">&#xe620;</i>消息通知<i class="otherintroduce clearfix">您有新消息</i></a></li>
            <li><a id="shareTo" href="#this"><i class="iconfont">&#xe621;</i>邀请好友</a></li>
        </ul>
    </div>
    <!--分类四-->
    <div class="h-home-menulist">
        <ul class="innercon">
            <li><a href="/home/my-install"><i class="iconfont">&#xe619;</i>设置</a></li>
        </ul>
    </div>
    <!--分类五-->
    <div class="h-home-menulist">
        <ul class="innercon">
            <li><a href="my-install.html"><i class="sao-bg"></i>扫一扫</a></li>
        </ul>
    </div>
    
</div>
<div class="submitbtn">
    <a href="release-activity.html"><img src="/mobile/images/ms.png"/></a>
</div>
<?= $this->element('footer') ?>
<?php $this->start('script') ?>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config(<?= json_encode($wxConfig) ?>);
    wx.ready(function () {
        wx.onMenuShareAppMessage({
            title: '并购精英惠', // 分享标题
            desc: '这里是描述', // 分享描述
            link: 'http://bgq.smartlemon.cn', // 分享链接
            imgUrl: 'http://wx.qlogo.cn/mmopen/ajNVdqHZLLCOibYvNGzNtJmgyOEpAyhkd45A3gbGgt2mbDYUdMeBVbbe9SmxwJiceNGd4ibZCeKTHSDq1kJDkVibXQ/0', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        wx.onMenuShareTimeline({
            title: '', // 分享标题
            link: '', // 分享链接
            imgUrl: '', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
    });

    $(function () {
        $('#shareTo').click(function () {
            $('.reg-shadow,.shadow-info').removeAttr('hidden');
        });
        $('.reg-shadow').bind('click', function (e) {
            $('.reg-shadow,.shadow-info').attr('hidden', true);
        });
        $('#shareToWxPYQ').click(function () {

        });
        $('#shareToWxFriend').click(function () {

        });
    });
</script>
<?php $this->end('script'); ?>