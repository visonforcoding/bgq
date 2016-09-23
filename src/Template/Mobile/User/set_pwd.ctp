<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>

            修改手机号码
        </h1>

    </div>
</header>
<div class="wraper">
    <div class="h20"></div>
    <ul class="h-info-box no-t-border">
        <li class="l-input"><input type="password"  name="pwd1" placeholder="输入密码" /></li>
        <li class="l-input"><input type="password" name="pwd2" placeholder="确认密码" /></li>
    </ul>
    <a href="javascript:void(0);" class="nextstep redshadow">下一步</a>
</div>
<?php $this->start('script') ?>
<script>
     $('.nextstep').on('click', function () {
         var pwd1 = $('input[name="pwd1"]').val();
         var pwd2 = $('input[name="pwd2"]').val();
         if(!pwd1||!pwd2){
             $.util.alert('输入不可为空');
             return;
         }
         if(pwd1 != pwd2){
             $.util.alert('两次密码输入不一样');
             return;
         }
         if(pwd1.length <6){
             $.util.alert('密码长度不得少于6位');
             return;
         }
        $.ajax({
            type: 'post',
            url:'',
            data: {pwd1:pwd1,pwd2:pwd2},
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        window.location.href = '/user/register';
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        return false;
    });
</script>
<?php $this->end('script')?>
