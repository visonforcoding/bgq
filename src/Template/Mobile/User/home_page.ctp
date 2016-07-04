<div class="m-wraper m-fixed-bottom wraper">
<!--    <div class="m-info-card">
        <div class="m-info">
            <a href="javascript:void(0)" class="m-pic"><img src="<?= $user->avatar ?>"/></a>
            <div class="mt-info">
                <h3><?= $user->truename ?></h3>
                <span class="job"><?= $user->company ?> <?= $user->position ?> </span>
                <span class="mmark"><?php foreach($user->industries as $k=>$v): ?><?= $v['name'] ?> <?php endforeach; ?></span>
            </div>
            <div class="linkinfo">
                <p><span>手机号:<a href="tel"><?= $user->phone ?></a></span></p>
                <p><span>邮    箱:<i><?= $user->email ?></i></span></p>
                <p><span>地    区:<i><?= $user->city ?></i></span></p>
            </div>
        </div>
    </div>
    <div class="ul-list">
        <h3>个人标签：</h3>
        <div class="mmark">
            <a href="javascript:void(0)">研发</a><a href="javascript:void(0)">设计</a><a href="javascript:void(0)">产品</a>
        </div>
    </div>-->
    <div class="h-home-bottom">
        <a href="<?php if ($self): ?>/home/edit-userinfo<?php else: ?>javascript:void(0)<?php endif; ?>">
            <div>
                <span><img id="user_img" src="<?= empty($user->avatar) ? '/mobile/images/touxiang.png' : $user->avatar ?>"/></span>
            </div>
            <h3>
                <?= $user->truename ?><span><?= $user->company ?> <?= $user->position ?></span>
            </h3>
        </a>
        <h4>
            <?php if (!$self): ?>
                <?php if ($isFans): ?>
                    <a href="javascript:void(0);" id="follow_btn_disable" class="tofocus-m">
                        <span id="attention">√已关注</span>
                    <?php else: ?>
                        <a href="javascript:void(0);" id="follow_btn" data-id="<?= $user->id ?>" class="tofocus-m">
                            <span id="attention">+关注</span>
                        <?php endif; ?>
                    </a>
                    <a href="javascript:void(0);" class="tofocus-m">
                        <span id="giveCard">
                            <?php if ($isGive): ?>
                                √已递名片
                            <?php else: ?>
                                递名片
                            <?php endif; ?>
                        </span>
                    </a>
                <?php endif; ?>
        </h4>
    </div>
    <ul class="h-info-box">
        <?php if (!$self): ?>
            <?php if (isset($user->secret)): ?>
                <?php if ($user->secret->profile_set == '1'): ?>
                    <li>
                        <h3>个人标签：<em><?= implode('、', $industry_arr) ?></em></h3>
                    </li>
                    <li>
                        <h3>公司业务：<em><?= $user->gsyw ?></em></h3>
                    </li>
                    <li class="c-color">
                        教育经历：
                        <?php foreach ($user->educations as $education): ?>
                            <h3>
                                <em>
                                    <i><?= $education->school ?></i>
                                    <i><?= $education->start_date ?>-<?= $education->end_date ?>，<?= $education->education ?>，
                                        <?= $education->major ?></i>
                                </em>
                            </h3>
                        <?php endforeach; ?>
                    </li>
                    <li class="c-color">
                        工作经历：
                        <?php foreach ($user->careers as $career): ?>
                            <h3>
                                <em>
                                    <i><?= $career->company ?></i>
                                    <i><?= $career->start_date ?>-<?= $career->end_date ?>，<?= $career->position ?></i>
                                </em>
                            </h3>
                        <?php endforeach; ?>
                    </li>
                    <li  class="tr">
                        <h3>行业：<em><?= implode('、', $industry_arr) ?></em></h3>
                    </li> 
                <?php endif; ?>
                <?php if ($user->secret->phone_set == '1'): ?>
                    <li class="tr">
                        <h3>联系电话：<em><?= $user->phone ?></em></h3>
                    </li>
                <?php endif; ?>
                <?php if ($user->secret->email_set == '1'): ?>
                    <li class="tr">
                        <h3>邮箱：<em><?= $user->email ?></em></h3>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            <!--                <li>
                                <h3>个人标签：<em><?= implode('、', $industry_arr) ?></em></h3>
                            </li>-->
            <li>
                <h3>公司业务：<em><?= $user->gsyw ?></em></h3>
            </li>
            <li class="c-color">
                教育经历：
                <?php foreach ($user->educations as $education): ?>
                    <h3>
                        <em>
                            <i><?= $education->school ?></i>
                            <i><?= $education->start_date ?>-<?= $education->end_date ?>，<?= $educationType[$education->education] ?>，
                                <?= $education->major ?></i>
                        </em>
                    </h3>
                <?php endforeach; ?>
            </li>
            <li class="c-color">
                工作经历：
                <?php foreach ($user->careers as $career): ?>
                    <h3>
                        <em>
                            <i><?= $career->company ?></i>
                            <i><?= $career->start_date ?>-<?= $career->end_date ?>，<?= $career->position ?></i>
                        </em>
                    </h3>
                <?php endforeach; ?>
            </li>
            <li  class="tr">
                <h3>行业：<em><?= implode('、', $industry_arr) ?></em></h3>
            </li> 
            <li class="tr">
                <h3>联系电话：<em><?= $user->phone ?></em></h3>
            </li>
            <li class="tr">
                <h3>邮箱：<em><?= $user->email ?></em></h3>
            </li>
        <?php endif; ?>
        <li class="no-b-border tr">
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
    $(function () {
        $('#follow_btn').on('click', function () {
            //关注
            var user_id = $(this).data('id');
            $.util.ajax({
                url: '/user/follow',
                data: {id: user_id},
                func: function (res) {
                    $.util.alert(res.msg);
                    $('#attention').text('√已关注')
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
                            $('#giveCard').text('√已递名片');
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
