<header class="myhome">
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            实名认证
        </h1>
    </div>
</header>
<div class="wraper">
    <form action="" method="post">
        <ul class="h-info-box e-info-box">
            <li class="no-right-ico">
                <span>姓名：</span>
                <div>
                    <input name="truename" type="text" value="<?= $user->truename ?>" readonly="readonly" />
                </div>
            </li>
            <li>
                <span>性别：</span>
                <div>
                    <?php if ($user->gender == 1): ?>
                        <span>男</span>
                    <?php else: ?>
                        <span>女</span>
                    <?php endif; ?>
                </div>
            </li>
            <li class="no-right-ico">
                
                <span>手机：</span>
                <div>
                    <input  type="text" value="<?= $user->phone ?>" readonly="true" />
                </div>
            </li>
            <li class="no-right-ico">
                <span>邮箱：</span>
                <div>
                    <input name="email" type="text" value="<?= $user->email ?>"  />
                </div>
            </li>
            <li class="no-right-ico">
                <span>公司：</span>
                <div>
                    <input name="company" type="text" value="<?= $user->company ?>" />
                </div>
            </li>
            <li class="no-right-ico">
                <span>职务：</span>
                <div >
                    <input name="position" type="text" value="<?= $user->position ?>"  />
                </div>
            </li>
            <li>
                <span>行业：</span>
                <div>
                    <input  type="text" value="金融"  />
                </div>
            </li>
            <li class="nobottom">
                <span>我的名片：</span>
                <div class="upload-user-img">
                    <span><input type="file" /></span>
                </div>
            </li>
        </ul>
    </form>
    <?php if ($user->status == '1'): ?>
        <a href="#this" class="nextstep colorbg">审核中</a>
    <?php endif; ?>
    <?php if ($user->status == '2'): ?>
        <a id="submit" class="nextstep">申请认证</a>
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