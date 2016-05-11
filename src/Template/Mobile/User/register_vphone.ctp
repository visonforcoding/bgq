<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            第一步--验证手机号
        </h1>
    </div>
</header>
<div class="wraper">
    <div id="user-login" class='login-area'>
        <form action="" method="post">
            <div class="loginbox">
                <div class='username'><span></span><input type='text' name="phone"    placeholder="请输入手机号"></div>
                <div class='password'><span></span><input name="vcode" type='text' placeholder="在此输入验证码" >
                    <button class="clearfix" type="button"  id="getVcode" href='javascript:void(0);'>获取验证码</button>
                </div>
            </div>
            <a href="javascript:void(0);"  id="submit" class="submit" >下一步</a>
        </form>

    </div>
</div>
<?php $this->start('script') ?>
<script>
    var t1 = null;
    $('input[name="phone"]').focusout(function () {
        var phone = $(this).val();
        checkPhone(phone);
    });
    $('#getVcode').on('click', function () {
        var $obj = $(this);
        var phone = $('input[name="phone"]').val();
        if (is_mobile(phone)) {
            $.post('/user/sendVcode', {phone: phone}, function (res) {
                if (res.status === true) {
                    //$obj.attr('disabled ','true');
                    var text = '<i id="timer">' + 30 + '</i>s后重新发送';
                    $obj.html(text);
                    t1 = setInterval(function () {
                        var timer = $('#timer').text();
                        timer--;
                        if (timer < 1) {
                            //$obj.removeAttr('disabled');
                            $obj.html('获取验证码');
                            clearInterval(t1);
                        } else {
                            $('#timer').text(timer);
                        }
                    }, 1000);
                }
            }, 'json');
        }
    });
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
                        window.location.href = '/user/register';
                    } else {
                        alert(msg.msg);
                    }
                }
            }
        });
        return false;
    });
    function checkPhone(phone) {
        if (phone !== '') {
            if (is_mobile(phone)) {
                $.post('/user/ckUserPhoneExist', {phone: phone}, function (res) {
                    if (res.status === true) {
                         $.util.alert('该手机号已注册');
                    }
                }, 'json');
            } else {
                alert('手机号不合法！');
            }
        }
    }
</script>
<?php
$this->end('script');
