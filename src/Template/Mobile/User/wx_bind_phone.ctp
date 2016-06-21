<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            绑定手机号
        </h1>
        <a href="/user/register" class='h-regiser'>注册</a>
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
            <a href="javascript:void(0);"  id="submit" class="submit" >确定</a>
        </form>

    </div>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/function.js"></script>
<script>
    var t1 = null;
    $('input[name="phone"]').focusout(function () {
        var phone = $(this).val();
       // checkPhone(phone);
    });
    $('#getVcode').on('tap', function () {
        var $obj = $(this);
        var phone = $('input[name="phone"]').val();
        if (!is_mobile(phone)) {
            $.util.alert('手机号不正确');
            return;
        }
        if($obj.attr('lock')){
            return;
        }
        $obj.attr('lock','lock');
        $.post('/user/sendVcode', {phone: phone}, function (res) {
            if (res.status === true) {
                //$obj.attr('disabled ','true');
                var text = '<i id="timer">' + 30 + '</i>秒后重新发送';
                $obj.html(text);
                t1 = setInterval(function () {
                    var timer = $('#timer').text();
                    timer--;
                    if (timer < 1) {
                        //$obj.removeAttr('disabled');
                        $obj.html('获取验证码');
                        clearInterval(t1);
                        $obj.removeAttr('lock');
                    } else {
                        $('#timer').text(timer);
                    }
                }, 1000);
            }
        }, 'json');
    });
    $('#submit').on('tap', function () {
        var phone = $('input[name="phone"]').val();
         if (!is_mobile(phone)) {
            $.util.alert('手机号不正确');
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
                    if (msg.status === true) {
                        window.location.href = msg.url;
                    } else {
                        $.util.alert(msg.msg);
//                        window.location.href = '/';
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
                    if (res.status === false) {
                         $.util.alert('您还没有平台账号请先完善信息');
                         window.location.href = '/user/register?type=wx_bind';
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
