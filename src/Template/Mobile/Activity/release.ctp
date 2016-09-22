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
<!--        <div class="line">
            <span class="mistips" style="width:auto;left:33%;">m.chinamatop.com/w/index/index 可以填写更详细的内容</span>
        </div>-->
        <?php endif; ?>
    </form>
    <div class='reg-shadow' id="shadow" hidden></div>
    <div class="totips" style="display:none;" id="success">
        <h3>提交成功</h3>
        <span>您可到"我-我的活动-活动需求"中查看已提交的需求</span>
        <a href="/activity/index" class="tipsbtn bgred hide_tips">返回主页</a><a href="/home/my-activity-submit/2" class="tipsbtn bg_blue hide_tips">查看需求</a>
<!--        <span class='closed'>
            &times;
        </span>-->
    </div>
    <div class="totips" hidden id="checkBtn">
        <h3 id="msg">请先去完善个人资料</h3>
        <span style="display:none;"></span>
        <a href="javascript:void(0)" class="tipsbtn bggray" id="no">取消</a><a href="javascript:location.href = ('/home/edit-userinfo?ref='+encodeURI(location.href))" class="tipsbtn bgred" id="yes">去完善</a>
    </div>
</div>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<!--<script src="/mobile/js/activity_release.js"></script>-->
<script type="text/javascript">
    window.onBackView = function(){
        $.util.checkUserinfoStatus();
    };
    window.onBackView();
    
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
                if($('#submit').hasClass('noTap')){
                    return false;
                }
                $('#submit').addClass('noTap');
                var form = $('form');
                var formData = {};
                var agency = [];
                if ($('input[name="title"]').val() == '') {
                    $.util.alert('主题不能为空');
                    $('#submit').removeClass('noTap');
                } else if ($('textarea[name="body"]').val() == '') {
                    $.util.alert('请填写需求');
                    $('#submit').removeClass('noTap');
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
                                        $('#shadow').show();
                                        $('#success').show();
                                        $('#submit').removeClass('noTap');
                                    }, 400);
                                    LEMON.sys.hideKeyboard();
                                } else {
                                    if(msg.msg.indexOf('请先去完善个人资料') != -1){
                                        setTimeout(function(){
                                            $('#shadow').show();
                                            $('#checkBtn').show();
                                            $('#submit').removeClass('noTap');
                                        }, 301);
                                    } else {
                                        $.util.alert(msg.msg);
                                        $('#submit').removeClass('noTap');
                                    }
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
    
    $('.hide_tips').on('tap', function(){
        $('#shadow').hide();
        $('#success').hide();
    });
</script>
<?php
$this->end('script');
