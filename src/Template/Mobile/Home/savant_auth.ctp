<div class="wraper">

    <ul class="h-info-box e-info-box nomargin">

        <form method="post" action="">
            <li class="no-right-ico changeflex nopr">
                <b>项目经验<a href="javascript:void(0);" class="r-example" id="xmjyTap">样例</a></b>
                <div >
                    <textarea name="xmjy" <?php if($user->savant_status==2 || $user->savant_status==3): ?>disabled style="background: gainsboro;"<?php endif; ?> placeholder="" ><?=isset($user->savant) ? $user->savant->xmjy : ''?></textarea>
                </div>
            </li>
            <li class="nobottom no-right-ico changeflex nopr">
                <b>擅长话题<a href="javascript:void(0);" class="r-example" id="schtTap">样例</a></b>
                <div >
                    <textarea name="zyys" <?php if($user->savant_status==2 || $user->savant_status==3): ?>disabled style="background: gainsboro;"<?php endif; ?> placeholder="" ><?= isset($user->savant)?$user->savant->zyys:''?></textarea>
                </div>
            </li>
        </form>
    </ul>
<!--    <div>
    <?php if($user->savant_status==1): ?>
        <a id="submit" class="nextstep">申请认证</a>
    <?php endif; ?>
    <?php if($user->savant_status==3): ?>
        <a  class="nextstep">已认证</a>
    <?php endif; ?>
    <?php if($user->savant_status==2): ?>
        <a  class="nextstep">审核中</a>
    <?php endif; ?>
    <?php if($user->savant_status==0): ?>
        <a id="submit" class="nextstep">重新申请认证</a>
    <?php endif; ?>
    <?php if($user->savant_status!=3): ?>
    <div class="line"><span class="mistips">我们会在三个工作日内处理您的申请</span></div>
    <?php endif; ?>
    </div>-->
    <?php if($user->savant_status!=3): ?>
        <div class="line"><span class="mistips">暂时停止开放会员认证</span></div>
    <?php endif; ?>
</div>
<div class="reg-shadow" id="shadow" hidden></div>
<div class="tips" hidden id="xmjy" style="z-index: 999">
    <p>
        1、**公司私有化，并拆除红筹架构回归国内A股上市 的方案设计，融资方案等。<br>
        2、**公司收购德国**，担任买方顾问，包括谈判、交易结构设计、支付方式、融资安排等。
    </p>
</div>
<div class="tips" hidden id="scht" style="z-index: 999">
    <p>
        医疗健康领域的投资与并购；海外并购与中概股私有化
    </p>
</div>
<div class="totips" hidden id="checkBtn">
    <h3 id="msg">请先去完善个人资料</h3>
    <span style="display:none;"></span>
    <a href="javascript:void(0)" class="tipsbtn bggray" id="no">取消</a><a href="/home/edit-userinfo" class="tipsbtn bgred" id="yes">去完善</a>
</div>
<?php $this->start('script') ?>
<script>
    window.onBackView = function(){
        $.util.checkUserinfoStatus();
    };
    window.onBackView();
    
    $(function () {
        $('#submit').on('click', function () {
            if($('textarea[name="xmjy"]').val() == ''){
                $.util.alert('请填写项目经验');
                return;
            }
            if($('textarea[name="zyys"]').val() == ''){
                $.util.alert('请填写擅长话题');
                return;
            }
            $form = $('form');
            $.ajax({
                type: 'post',
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: 'json',
                success: function (msg) {
                    if (typeof msg === 'object') {
                        if(msg.status){
                            $.util.alert(msg.msg);
                            setTimeout(function(){
                                window.location.href = '/home/index';
                            }, 2000);
                        } else {
                            if (msg.msg.indexOf('请先去完善个人资料') != -1) {
                                $('#msg').html(msg.msg);
                                $('#shadow').show();
                                $('#checkBtn').show();
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                }
            });
            return false;
        });
    });
    
    $('#xmjyTap').on('tap', function(){
        setTimeout(function(){
            $('#xmjy').show();
            $('#shadow').show();
        },400);
    });
    $('#schtTap').on('tap', function(){
        setTimeout(function(){
            $('#scht').show();
            $('#shadow').show();
        },400);
    });
    $('#shadow').on('tap', function(){
        setTimeout(function(){
            $('#scht').hide();
            $('#xmjy').hide();
            $('#shadow').hide();
        },400);
    });
</script>
<?php $this->end('script'); ?>
