<header class="m-to-more myhome">
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>个人中心</h1>

        <a href="#this" class='iconfont share h-regiser'>&#xe619;</a>
    </div>
    <div class="h-home-bottom">
        <div><span><img src="<?= $user->avatar ?>"/></span><i class="iconfont">&#xe61e;</i></div>
        <h3><?= $user->truename ?><span><?= $user->company ?> <?= $user->position ?></span></h3>
    </div>
</header>
<div class="wraper m-wraper">
    <ul class="h-home-menu">
        <li><a href="/home/my-following"><i class="iconfont">&#xe60f;</i>我的关注</a></li>
        <li><a href="#this"><i class="iconfont">&#xe610;</i>我的收藏</a></li>
        <li><a href="#this"><i class="iconfont">&#xe60b;</i>我的约见</a></li>
        <li><a href="/home/my-activity-submit"><i class="iconfont">&#xe601;</i>我的活动</a></li>
    </ul>
    <div class="h-home-menulist">
        <ul class="innercon">
            <li><a href="/home/my-xiaomi"><i class="iconfont">&#xe61a;</i>小秘书</a></li>
            <li><a href="#this"><i class="iconfont">&#xe61b;</i>钱包</a></li>
            <li><a href="/meet/view/<?= $user->id ?>"><i class="iconfont">&#xe61c;</i>专家主页</a></li>
            <li><a href="/home/realname-auth"><i class="iconfont">&#xe61d;</i>实名认证<i class="otherintroduce clearfix">
                        <?php if ($user->status == '1'): ?>未认证<?php endif; ?>
                        <?php if ($user->status == '2'): ?>已认证<?php endif; ?>
                        <?php if ($user->status == '0'): ?>不通过<?php endif; ?>
                    </i>
                </a>
            </li>
            <li><a href="/home/savant-auth"><i class="iconfont">&#xe61e;</i>
                    专家认证<i class="otherintroduce clearfix">
                        <?php if ($user->savant_status == '1'): ?>未认证<?php endif; ?>
                        <?php if ($user->savant_status == '2'): ?>待审核<?php endif; ?>
                        <?php if ($user->savant_status == '3'): ?>已认证<?php endif; ?>
                        <?php if ($user->savant_status == '0'): ?>不通过<?php endif; ?>
                    </i>
                </a>
            </li>
            <li><a href="#this"><i class="iconfont">&#xe61f;</i>隐私策略</a></li>
            <li><a href="/home/my-message-fans"><i class="iconfont">&#xe620;</i>消息通知<i class="otherintroduce clearfix">您有新消息</i></a></li>
            <li><a id="shareTo" href="#this"><i class="iconfont">&#xe621;</i>邀请好友</a></li>
        </ul>
    </div>
</div>
<div class="reg-shadow" hidden>

</div>
<div class="shadow-info a-shadow a-forword" hidden>
    <div>
        <h3>通过以下渠道邀请</h3>
        <div class="forword">
            <a href="#this"><span></span>微信好友</a>
            <a href="#this"><span></span>微信朋友圈</a>
        </div>
    </div>
</div>
<?= $this->element('footer') ?>
<?php $this->start('script') ?>
<script>
    $(function(){
       $('#shareTo').click(function(){
            $('.reg-shadow,.shadow-info').removeAttr('hidden');
       });
       $('.reg-shadow').bind('click',function(e){
           $('.reg-shadow,.shadow-info').attr('hidden',true);
       });
    });
</script>
<?php $this->end('script'); ?>