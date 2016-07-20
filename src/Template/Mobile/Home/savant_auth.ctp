<header class="myhome">
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            专家认证
        </h1>
    </div>
</header>

<div class="wraper">

    <ul class="h-info-box e-info-box">

        <form method="post" action="">
            <li class="no-right-ico changeflex">
                <b>项目经验</b>
                <div >
                    <textarea name="xmjy" <?php if($user->savant_status==2 || $user->savant_status==3): ?>disabled style="background: gainsboro;"<?php endif; ?> placeholder="" ><?=isset($user->savant) ? $user->savant->xmjy : ''?>
                    </textarea>
                </div>
            </li>
            <li class="nobottom no-right-ico changeflex">
                <b>擅长话题</b>
                <div >
                    <textarea name="zyys" <?php if($user->savant_status==2 || $user->savant_status==3): ?>disabled style="background: gainsboro;"<?php endif; ?> placeholder="" ><?= isset($user->savant)?$user->savant->zyys:''?>
                    </textarea>
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
    <div style="color:red; text-align: center">我们的秘书会在两个工作日内联系您</div>
</div>
<?php $this->start('script') ?>
<script>
    $(function () {
        $('#submit').on('click', function () {
            $form = $('form');
            $.ajax({
                type: 'post',
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: 'json',
                success: function (msg) {
                    if (typeof msg === 'object') {
                        $.util.alert(msg.msg);
                        window.location.href = '/home/index';
                    }
                }
            });
            return false;
        });
    });
</script>
<?php $this->end('script'); ?>
