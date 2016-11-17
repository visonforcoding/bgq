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
                <div class='username'><label class='label'><span class='iconfont'>&#xe630;</span></label><input type='text' name="phone"    placeholder="请输入手机号"></div>
                <div class='password'><label class='label'><span class='iconfont'>&#xe631;</span></label><input name="vcode" type='text' placeholder="在此输入验证码" >
                    <button class="clearfix" type="button"  id="getVcode" href='javascript:void(0);'>获取验证码</button>
                </div>
            </div>
            <a href="javascript:void(0);"  id="submit" class="submit" >下一步</a>
            <a href="/user/foreign-register" class="historyinfo colore01">国外手机号码请点这里</a>
        </form>

    </div>
</div>
<?php $this->start('script') ?>
<script>
    function getQueryString(name)
    {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if(r!=null)return  unescape(r[2]); return null;
    }

    if(getQueryString('rephone')){
        $('input[name="phone"]').val(getQueryString('rephone'));
    }

    var t1 = null;
    $('input[name="phone"]').bind('input propertychange', function () {
        if ($(this).val().length >= 11) {
            var phone = $(this).val();
            checkPhone(phone);
        }
    });
    $('#getVcode').on('click', function () {
        var phone = $('input[name="phone"]').val();
        if(phone == ''){
            $.util.alert('请填写手机号码');
            return false;
        }
        var $obj = $(this);
        if($obj.hasClass('noTap')){
            return false;
        }
        $obj.addClass('noTap');
        if ($.util.isMobile(phone)) {
            $.post('/user/sendVCode', {phone: phone}, function (res) {
                if (res.status === true) {
                    $.util.alert(res.msg);
                    var text = '<i id="timer">' + 30 + '</i>秒后重新发送';
                    $obj.html(text);
                    t1 = setInterval(function () {
                        var timer = $('#timer').text();
                        timer--;
                        if (timer < 1) {
                            $obj.html('获取验证码');
                            $obj.removeClass('noTap');
                            clearInterval(t1);
                        } else {
                            $('#timer').text(timer);
                        }
                    }, 1000);
                }else{
                    if(res.status===false&&res.errCode===1){
                        if(window.confirm(res.msg)){
                            location.href = '/user/register-vphone?rephone='+phone;
                        };
                    } else {
                        $obj.removeClass('noTap');
                    }
                }
            }, 'json');
        } else {
            $.util.alert('请填写合法的手机号码');
            $obj.removeClass('noTap');
            return false;
        }
    });
    $('#submit').on('click', function () {
        if($('input[name="vcode"]').val() == ''){
            $.util.alert('请填写验证码');
            return false;
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
                        window.location.href = '/user/set-pwd';
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        return false;
    });
    
    function checkPhone(phone) {
        if (phone !== '') {
            if ($.util.isMobile(phone)) {
                $.post('/user/ckUserPhoneExist', {phone: phone}, function (res) {
                    if (res.status === true) {
                         $.util.alert('该手机号已注册');
                         $('#getVcode').addClass('noTap');
                    } else {
                        $('#getVcode').removeClass('noTap');
                    }
                }, 'json');
            } else {
                $.util.alert('手机号不合法！');
            }
        }
    }
</script>
<?php
$this->end('script');
