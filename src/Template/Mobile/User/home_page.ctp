<div class="wraper">
    <div class="m-info-card">
        <div class="m-info">
            <a href="/home/edit-userinfo" class="m-pic"><img src="<?= $user->avatar ? $user->avatar : '/mobile/images/touxiang.png' ?>"/></a>
            <div class="mt-info">
                <h3><?= $user->truename ?></h3>
                <span class="job"><?= $user->company ?> <?= $user->position ?> </span>
                <span class="mmark"><?php foreach($user->industries as $k=>$v): ?><?= $v['name'] ?> <?php endforeach; ?></span>
            </div>
            <div class="linkinfo">
                <?php if(!$self): ?>
                    <?php if (isset($user->secret)): ?>
                        <?php if ($user->secret->phone_set == '1'): ?>
                            <p><span>手机号:<a href="tel"><?= $user->phone ?></a></span></p>
                        <?php endif; ?>
                        <?php if ($user->secret->email_set == '1'): ?>
                            <p><span>邮   &nbsp;&nbsp;箱:<i><?= $user->email ?></i></span></p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p><span>手机号:<a href="tel"><?= $user->phone ?></a></span></p>
                        <p><span>邮   &nbsp;&nbsp;箱:<i><?= $user->email ?></i></span></p>
                    <?php endif; ?>
                <?php else: ?>
                    <p><span>手机号:<a href="tel"><?= $user->phone ?></a></span></p>
                    <p><span>邮   &nbsp;&nbsp;箱:<i><?= $user->email ?></i></span></p>
                <?php endif; ?>
                <p><span>地   &nbsp;&nbsp;区:<i><?= $user->city ?></i></span></p>
            </div>
        </div>
    </div>
    <?php if(!$self): ?>
        <?php if (isset($user->secret)): ?>
            <?php if ($user->secret->profile_set == '1'): ?>
                <?php if(is_array(unserialize($user->grbq))): ?>
                    <div class="ul-list">
                        <h3>个人标签：</h3>
                        <div class="mmark">
                            <span class="m-con">
                                <?php foreach(unserialize($user->grbq) as $v): ?>
                                    <?= $v ?> 
                                <?php endforeach; ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>
                <ul class="ul-list">
                    <?php if($user->educations): ?>
                    <li>
                        <h3>教育经历：</h3>
                        <div class="mmark">
                            <?php foreach($user->educations as $education): ?>
                            <p>
                                <span><?= $education->school ?></span>
                                <em><?= $education->start_date ?>-<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></em>
                            </p>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <?php endif; ?>
                    <?php if($user->careers): ?>
                    <li>
                        <h3>工作经历：</h3>
                        <div class="mmark">
                            <?php foreach($user->careers as $career): ?>
                            <p>
                                <span><?= $career->company ?></span>
                                <em><?= $career->start_date ?>-<?= $career->end_date ?>，<?= $career->position ?></em>
                            </p>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        <?php else: ?>
            <div class="ul-list">
                <h3>个人标签：</h3>
                <div class="mmark">
                    <span class="m-con">
                        <?php if(is_array(unserialize($user->grbq))): ?>
                            <?php foreach(unserialize($user->grbq) as $v): ?>
                                <?= $v ?> 
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <ul class="ul-list">
                <li>
                    <h3>教育经历：</h3>
                    <div class="mmark">
                        <?php foreach ($user->educations as $education): ?>
                            <p>
                                <span><?= $education->school ?></span>
                                <em><?= $education->start_date ?>-<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></em>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li>
                    <h3>工作经历：</h3>
                    <div class="mmark">
                        <?php foreach ($user->careers as $career): ?>
                            <p>
                                <span><?= $career->company ?></span>
                                <em><?= $career->start_date ?>-<?= $career->end_date ?>，<?= $career->position ?></em>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>
        <?php endif; ?>
    <?php else: ?>
        <div class="ul-list">
            <h3>个人标签：</h3>
            <div class="mmark">
                <span class="m-con">
                    <?php if(is_array(unserialize($user->grbq))): ?>
                        <?php foreach(unserialize($user->grbq) as $v): ?>
                            <?= $v ?> 
                        <?php endforeach; ?>
                    <?php endif; ?>
                </span>
            </div>
        </div>
        <ul class="ul-list">
            <li>
                <h3>教育经历：</h3>
                <div class="mmark">
                    <?php foreach ($user->educations as $education): ?>
                        <p>
                            <span><?= $education->school ?></span>
                            <em><?= $education->start_date ?>-<?= $education->end_date ?>，<?= $education->major ?>，<?= $educationType[$education->education] ?></em>
                        </p>
                    <?php endforeach; ?>
                </div>
            </li>
            <li>
                <h3>工作经历：</h3>
                <div class="mmark">
                    <?php foreach ($user->careers as $career): ?>
                        <p>
                            <span><?= $career->company ?></span>
                            <em><?= $career->start_date ?>-<?= $career->end_date ?>，<?= $career->position ?></em>
                        </p>
                    <?php endforeach; ?>
                </div>
            </li>
        </ul>
    <?php endif; ?>
    <?php if($user->goodat): ?>
    <div class="ul-list">
        <h3>擅长业务：</h3>
        <div class="mmark">
            <span class="m-con"><?= $user->goodat ?></span>
        </div>
    </div>
    <?php endif; ?>
    <?php if($user->gsyw): ?>
    <div class="ul-list">
        <h3>公司业务：</h3>
        <div class="mmark">
            <span class="m-con"><?= $user->gsyw ?></span>
        </div>
    </div>
    <?php endif; ?>
    <?php if($user->level == 2): ?>
    <ul class="h-info-box">
        <li class="no-b-border">
            <a href="/meet/view/<?= $user->id ?>">专家主页</a>
        </li>
    </ul>
    <?php endif; ?>
    <?php if ($self): ?>
        <ul class="h-info-box">
            <li class="no-b-border">
                <a href="/home/edit-userinfo" class='no-ico'>编辑</a>
            </li>
        </ul>
    <?php endif; ?>
</div>
    <!--<div style="height:1rem"></div>-->
    <?php if (!$self): ?>
        <div class="f-bottom">
            <a href="javascript:void(0);" class="bgred" id="follow_btn">
                <?php if($isFans): ?>
                已关注
                <?php else: ?>
                关注
                <?php endif; ?>
            </a>
            <a href="javascript:void(0);" class="bggray" id="giveCard">
                <?php if($isGive): ?>
                已递名片
                <?php else: ?>
                递名片
                <?php endif; ?>
            </a>
        </div>
    <?php endif; ?>
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
            $.util.ajax({
                url: '/user/follow',
                data: {id: <?= $user->id ?>},
                func: function (res) {
                    $.util.alert(res.msg);
                    $('#follow_btn').text('已关注');
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
