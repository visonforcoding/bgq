<div class="wraper">
    <form action="" method="post">
        <!-- <div class="h20"></div> -->
<!--        <div class="infoboxlist a-pay paytype">
            <ul class='ulinfo'>
                <li id="pay">是否为众筹项目：<span class='infocard'><input type="checkbox" name='pay' checked="true" id="pay_input"/><i class='active' id="pay_i"></i></span></li>
            </ul>
        </div>-->
<!--        <div class="tojudge innercon tochoose" id="tochoose">
            选择行业标签
            <span></span>
        </div>-->
<!--        <div class="items">
            <div class="orgmark">
                <?php if ($industries): ?>
                    <?php foreach ($industries as $k => $v): ?>
                        <a href="#this" value="<?= $v['id']; ?>" class="industries"><?= $v['name']; ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>-->
        <div class="h2"></div>
        <div class="crowdfunding innercon border">
            <span>您想要发起的活动主题是</span><input type="text" name="title" <?php if($activity): ?>value="<?= $activity->title ?>" readonly<?php endif; ?> />
            <span>请描述您的大概需求</span><textarea name="body" rows="" cols=""<?php if($activity): ?> readonly<?php endif; ?>><?php if($activity): ?><?= $activity->body ?><?php endif; ?></textarea>
        </div>
        <div class="h2"></div>
        <?php if(!$activity): ?>
        <a href="javascript:void(0)" class='nextstep' id="submit">提交</a>
        <div class="line">
            <span class="mistips">我们会在三个工作日内处理您的申请</span>
        </div>
        <div class="line">
            <span class="mistips" style="width:auto;left:33%;">m.chinamatop.com/w/index/index 可以填写更详细的内容</span>
        </div>
        <?php endif; ?>
    </form>
    <div class='reg-shadow' hidden></div>
    <div class="totips" style="display:none;">
        <h3>活动需求已提交，秘书会尽快联系您</h3>
        <span></span>
        <a href="/activity/index" class="nextstep" id="comfirm">确认</a>
<!--        <span class='closed'>
            &times;
        </span>-->
    </div>
</div>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<!--<script src="/mobile/js/activity_release.js"></script>-->
<script type="text/javascript">
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        switch (em.id) {
            case 'submit':
                var form = $('form');
                var formData = {};
                var agency = [];
                if ($('input[name="title"]').val() == '') {
                    $.util.alert('主题不能为空');
                } else if ($('textarea[name="body"]').val() == '') {
                    $.util.alert('请填写需求');
                } else {
                    for (i = 0; i < $('.industries').length; i++)
                    {
                        agency.push($('.industries').eq(i).attr('value'));
                    }
                    formData.pay = $('input[name="pay"]').attr('checked'); // 是否众筹
                    formData.title = $('input[name="title"]').val(); // 标题
                    formData.body = $('textarea[name="body"]').val(); // 内容
                    formData['industries[_ids]'] = agency;
                    $.util.ajax({
                        url: form.attr('action'),
                        data: formData,
                        func: function (msg) {
                            if (typeof msg === 'object') {
                                if (msg.status === true) {
                                    setTimeout(function(){
                                        $('.reg-shadow').show();
                                        $('.totips').show();
                                    }, 400);
                                    LEMON.sys.hideKeyboard();
                                } else {
                                    $.util.alert(msg.msg);
                                }
                            }
                        }
                    });
                }
                break;
            case 'tochoose':
                location.href = "/activity/industries";
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
</script>
<?php
$this->end('script');
