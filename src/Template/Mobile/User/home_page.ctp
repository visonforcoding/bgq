<header class="myhome no-bottom">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>个人主页</h1>
        <!--<a href="#this" class='iconfont share h-regiser'>&#xe619;</a>-->
    </div>
</header>
<div class="m-wraper m-fixed-bottom wraper">
    <div class="h-home-bottom">
        <div>
            <a href="<?php if($self): ?>/home/edit-userinfo<?php else:?>javascript:void(0)<?php endif;?>">
                <span><img src="<?= empty($user->avatar) ? '/mobile/images/touxiang.png' : $user->avatar ?>"/></span>
                <i class="iconfont">&#xe61e;</i></div>
            </a>
        <h3>
            <?= $user->truename ?><span><?= $user->company ?> <?= $user->position ?></span>
        </h3>
        <h4>
            <?php if(!$self):?>
            <?php if ($isFans): ?>
                <a href="javascript:void(0);" id="follow_btn_disable" class="tofocus-m">
                    <span>√已关注</span>
                <?php else: ?>
                    <a href="javascript:void(0);" id="follow_btn" data-id="<?= $user->id ?>" class="tofocus-m">
                        <span>+关注</span>
                    <?php endif; ?>
                </a>
                <a href="javascript:void(0);" class="tofocus-m"><span>递名片</span></a>
            <?php endif;?>
        </h4>
    </div>
    <ul class="h-info-box">
        <li>
            <h3>个人标签：<em><?= implode('、', $industry_arr) ?></em></h3>
        </li>
        <li>
            <h3>公司业务：<em>互联网资讯、企业并购、投融资管理</em></h3>
        </li>
        <li class="c-color">
            教育经历：
            <h3><em><i>北京大学</i><i>2000-2004，工商管理，本科</i></em></h3>
        </li>
        <li class="c-color">
            工作经历：<h3><em><i>IDG资本</i><i>2005-2014，投资经理</i></em></h3>
        </li>
        <li class="tr">
            <h3>联系电话：<em><?= $user->phone ?></em></h3>
        </li>
        <li class="tr">
            <h3>邮箱：<em><?= $user->email ?></em></h3>
        </li>
        <li>
            <h3>行业：<em>互联网</em></h3>
        </li>
        <li class="no-b-border">
            <h3>所在地：<em>深圳</em></h3>
        </li>
    </ul>
    <?php if ($user->level == '2'): ?>
        <ul class="h-info-box">
            <li class="no-b-border">
                <a href="/meet/view/<?= $user->id ?>">专家主页</a>
            </li>
        </ul>
    <?php endif; ?>
    <?php if ($self): ?>
        <ul class="h-info-box">
            <li class="no-b-border">
                <a href="/home/edit-userinfo">编辑</a>
            </li>
        </ul>
    <?php endif; ?>
</div>
<?php $this->start('script') ?>
<script>
    $(function () {
        $('#follow_btn').on('click', function () {
            //关注
            var user_id = $(this).data('id');
            $.util.ajax({
                url: '/user/follow',
                data: {id: user_id},
                func: function (res) {
                    $.util.alert(res.msg);
                }
            });
        });
    });
</script>
<?php
$this->end('script');
