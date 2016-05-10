<header class="m-to-more myhome">
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>个人中心</h1>

        <a href="#this" class='iconfont share h-regiser'>&#xe619;</a>
    </div>
    <div class="h-home-bottom">
        <div><span><img src="<?=$user->avatar?>"/></span><i class="iconfont">&#xe61e;</i></div>
        <h3><?=$user->truename?><span><?=$user->company?> <?=$user->position?></span></h3>
    </div>
</header>
<div class="wraper m-wraper">
    <ul class="h-home-menu">
        <li><a href="#this"><i class="iconfont">&#xe60f;</i>我的关注</a></li>
        <li><a href="#this"><i class="iconfont">&#xe610;</i>我的收藏</a></li>
        <li><a href="#this"><i class="iconfont">&#xe60b;</i>我的约见</a></li>
        <li><a href="#this"><i class="iconfont">&#xe601;</i>我的活动</a></li>
    </ul>
    <div class="h-home-menulist">
        <ul class="innercon">
            <li><a href="#this"><i class="iconfont">&#xe61a;</i>小秘书</a></li>
            <li><a href="#this"><i class="iconfont">&#xe61b;</i>钱包</a></li>
            <li><a href="#this"><i class="iconfont">&#xe61c;</i>专家主页</a></li>
            <li><a href="#this"><i class="iconfont">&#xe61d;</i>实名认证<i class="otherintroduce clearfix">未认证</i></a></li>
            <li><a href="#this"><i class="iconfont">&#xe61e;</i>专家认证<i class="otherintroduce clearfix">未认证</i></a></li>
            <li><a href="#this"><i class="iconfont">&#xe61f;</i>隐私策略</a></li>
            <li><a href="#this"><i class="iconfont">&#xe620;</i>消息通知<i class="otherintroduce clearfix">您有新消息</i></a></li>
            <li><a href="#this"><i class="iconfont">&#xe621;</i>邀请好友</a></li>
        </ul>
    </div>
</div>
<?= $this->element('footer') ?>