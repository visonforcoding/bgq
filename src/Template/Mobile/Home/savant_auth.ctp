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

        <li class="no-right-ico">
            <span>姓名：</span>
            <div>
                <input type="text" value="<?= $user->truename ?>" placeholder="杨涛" />
            </div>
        </li>
        <li>
            <span>性别：</span>
            <div>
                <span>男</span>
            </div>
        </li>
        <li class="no-right-ico">
            <span>手机：</span>
            <div>
                <input type="text" value="<?= $user->phone ?>" placeholder="13854612879" />
            </div>
        </li>
        <li class="no-right-ico">
            <span>邮箱：</span>
            <div>
                <input type="text" value="<?= $user->email ?>" placeholder="IDG@foxmail.com" />
            </div>
        </li>
        <li class="no-right-ico">
            <span>公司：</span>
            <div>
                <input type="text" value="<?= $user->company ?>" placeholder="IDG资本" />
            </div>
        </li>
        <li class="no-right-ico">
            <span>职务：</span>
            <div >
                <input type="text" value="<?= $user->position ?>" placeholder="董事长" />
            </div>
        </li>
        <form method="post" action="">
            <li class="no-right-ico changeflex">
                <b>项目经验</b>
                <div >
                    <textarea name="xmjy"><?=isset($user->savant)?$user->savant->xmjy:''?></textarea>
                </div>
            </li>
            <li class="nobottom no-right-ico changeflex">
                <b>资源优势</b>
                <div >
                    <textarea name="zyys"><?=  isset($user->savant)?$user->savant->zyys:''?></textarea>
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
                        if (msg.status === true) {
                            $.util.alert(msg.msg);
                            window.location.reload();
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
            return false;
        });
    });
</script>
<?php $this->end('script'); ?>
