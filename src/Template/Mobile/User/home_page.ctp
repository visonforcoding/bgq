<div class="wraper bg-ff">
    <div class="head-info">
        <a href="/home/edit-userinfo" class="m-pic"><img src="<?= $user->avatar ? $user->avatar : '/mobile/images/touxiang.png' ?>"/></a>
    </div>
    <div class="h-user">
        <h3><?= $user->truename ?></h3>
        <div class="u-s-name"><span><?= $user->company ?> </span> / <span><?= $user->position ?></span></div>
        <div class="u-btn">
            <?php if(!$self): ?>
            <a href="javascript:void(0);" id="follow_btn" class="focusbtn <?php if($isFans): ?>focusgray<?php endif; ?>"><?php if($isFans): ?>取消关注<?php else: ?>关注<?php endif; ?></a>
            <a href="javascript:void(0);" id="giveCard" class="cardbtn <?php if($isGive): ?>cardgray<?php endif; ?>"><?php if($isGive): ?>已递名片<?php else: ?>递名片<?php endif; ?></a>
            <?php endif; ?>
        </div>
        <ul class="basicinfo border">
            <li><span><?= $user->city ? $user->city : '暂未填写' ?></span><i>地区</i></li>
            <?php if(!$self): ?>
                <?php if ($user->secret->phone_set == '1'): ?>
                    <li><a href="tel:<?= $user->phone ?>" onclick="if($.util.isAPP){LEMON.event.tel(<?= $user->phone ?>);}"><span><?= $user->phone ?></span><i>电话</i></a></li>
                <?php else: ?>
                    <li><span>未公开</span><i>电话</i></li>
                <?php endif; ?>
                <?php if ($user->secret->email_set == '1'): ?>
                    <li><span><?= $user->email ?></span><i>邮箱</i></li>
                <?php else: ?>
                    <li><span>未公开</span><i>邮箱</i></li>
                <?php endif; ?>
            <?php else: ?>
                <li><span><?= $user->phone ?></span><i>电话</i></li>
                <li><span><?= $user->email ? $user->email : '暂未填写' ?></span><i>邮箱</i></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="infotab">
        <ul class="h-tab bbottom clearfix">
            <li class="iconfont active">&#xe650;</li>
            <li class="iconfont">&#xe651;</li>
            <li class="iconfont">&#xe652;</li>
        </ul>
        <div class="tabcon bbottom">
            <ul class="cur inner basicon">
                <li class="b-hy">
                    <span><i class="iconfont">&#xe654;</i>所在行业</span>
                    <div>
                        <?php foreach ($user->industries as $k=>$v): ?>
                            <em><?= $v['name'] ?></em>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li class="b-bq">
                    <span><i class="iconfont">&#xe653;</i>个人标签</span>
                    <div>
                        <?php if(is_array(unserialize($user->grbq))): ?>
                            <?php foreach (unserialize($user->grbq) as $k=>$v): ?>
                                <em><?= $v ?></em>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="b-yw"><span><i class="iconfont">&#xe655;</i>擅长业务</span>
                    <div>
                        <em><?= $user->goodat ? $user->goodat : '暂未填写' ?></em>
                    </div>
                </li>
                <li class="b-gs nobottom"><span><i class="iconfont">&#xe656;</i>公司业务</span>
                    <div>
                        <em><?= $user->gsyw ? $user->gsyw : '暂未填写' ?></em>
                    </div>
                </li>
            </ul>
            <ul class="basicon worktab">
                <?php if($user->careers): ?>
                    <?php foreach($user->careers as $career): ?>
                    <a class="bbottom">
                        <li class="inner"><span><?= $career->company ?></span></li>
                        <span class="worktime"><?= $career->start_date ?>～<?= $career->end_date ?>，<?= $career->position ?></span>
                    </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <a class="bbottom">
                        <li class="inner"><span>暂未填写</span></li>
                        <span class="worktime">暂未填写</span>
                    </a>
                <?php endif; ?>
            </ul>
            <ul class="basicon worktab">
                <?php if($user->educations): ?>
                    <?php foreach($user->educations as $education): ?>
                    <a class="bbottom">
                        <li class="inner"><span><?= $education->school ?></span></li>
                        <span class="worktime"><?= $education->start_date ?>～<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></span>
                    </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <a class="bbottom">
                        <li class="inner"><span>暂未填写</span></li>
                        <span class="worktime">暂未填写</span>
                    </a>
                <?php endif; ?>
            </ul>
        </div>
        <div class="h2">

        </div>
        <ul class="h-info-box">
            <li class="no-b-border">
                <a href="/meet/view/<?= $user->id ?>">专家主页</a>
            </li>
        </ul>
        <?php if ($self): ?>
        <ul class="h-info-box">
            <li class="no-b-border">
                <a href="/home/edit-userinfo">编辑</a>
            </li>
        </ul>
        <?php endif; ?>
    </div>
</div>
<?php $this->start('script') ?>
<script>
    (function () {
        var imgUrl = '<?= $user->avatar ?>';
        if(imgUrl) window.shareConfig.imgUrl = location.origin +  imgUrl;
        window.shareConfig.link = location.href;
        window.shareConfig.title = '并购帮会员';
        window.shareConfig.desc = '<?= $user->company ?>  <?= $user->truename ?>';
        LEMON.show.shareIco();
    })();

</script>
<script>
    $('.h-tab>li').on('tap',function(){
        var index =$(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.tabcon>ul').eq(index).addClass('cur').siblings().removeClass('cur');
    });
    
    $(function () {
        $('#follow_btn').on('click', function () {
            //关注
            $.util.ajax({
                url: '/user/follow',
                data: {id: <?= $user->id ?>},
                func: function (res) {
                    $.util.alert(res.msg);
                    if(res.status){
                        if(res.msg.indexOf('取消关注') != ''){
                            $('#follow_btn').text('取消关注');
                            $('#follow_btn').addClass('focusgray');
                        } else {
                            $('#follow_btn').text('关注');
                            $('#follow_btn').removeClass('focusgray');
                        }
                    }
                    
                }
            });
        });
    });

    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('common_')) {
            console.log($(em));
        }
        switch (em.id) {
            case 'giveCard':
                $.util.ajax({
                    url: '/user/giveCard/<?= $user->id ?>',
                    func: function (msg) {
                        if (typeof msg == 'object')
                        {
                            $.util.alert(msg.msg);
                            $('#giveCard').text('已递名片');
                            $('#giveCard').addClass('cardgray');
                        }
                    }
                });
                break;
            case 'goTop':
                window.scrollTo(0, 0);
                e.preventDefault();
                break;
        }
    });
</script>
<?php
$this->end('script');
