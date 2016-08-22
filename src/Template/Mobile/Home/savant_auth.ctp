<header class="myhome">
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            专家认证
        </h1>
    </div>
</header>

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
</div>
<div class="reg-shadow" id="shadow" hidden></div>
<div class="tips" hidden id="xmjy" style="z-index: 999">
    <p>项目经验样例</p>
</div>
<div class="tips" hidden id="scht" style="z-index: 999">
    <p>擅长话题样例</p>
</div>
<?php $this->start('script') ?>
<script>
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/home/get-userinfo-status",
        success: function (res) {
            if(res.status){
                
            } else {
                $.util.alert(res.msg);
            }
        }
    });
    
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
                        $.util.alert(msg.msg);
                        if(msg.status){
                            setTimeout(function(){
                                window.location.href = '/home/index';
                            }, 2000);
                        }
                    }
                }
            });
            return false;
        });
    });
    
    $('#xmjyTap').on('tap', function(){
        $('#xmjy').show();
        $('#shadow').show();
    });
    $('#schtTap').on('tap', function(){
        $('#scht').show();
        $('#shadow').show();
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
