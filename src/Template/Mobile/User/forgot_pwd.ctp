<div class="wraper">
    <div class="h2"></div>
    <ul class="h-info-box">
        <form action="" method="post">
            <li class="l-input"><input type="text" name="phone" placeholder="请输入您手机号码"></li>
            <li class="l-input"><input type="text" name="vcode" placeholder="验证码"><i class="color-items getnum" id="getVcode">获取验证码</i></li>
        </form>
    </ul>
    <a href="javascript:void(0);" class="nextstep redshadow" id="submit">下一步</a>
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
    $('input[name="phone"]').focusout(function () {
        var phone = $(this).val();
        checkPhone(phone);
    });
    $('#getVcode').on('click', function () {
        var phone = $('input[name="phone"]').val();
        if(phone == ''){
            $.util.alert('请输入您的手机号码');
            return;
        }
        var $obj = $(this);
        if($obj.hasClass('noTap')){
            return;
        }
        $obj.addClass('noTap');
        if ($.util.isMobile(phone)) {
            $.post('/user/sendLoginCode', {phone: phone}, function (res) {
                $.util.alert(res.msg);
                if (res.status === true) {
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
                } else {
                    $obj.removeClass('noTap');
                }
            }, 'json');
        }
    });
    $('#submit').on('click', function () {
        if($('input[name="phone"]').val() == ''){
            $.util.alert('请填写手机');
            return;
        }
        if($('input[name="vcode"]').val() == ''){
            $.util.alert('请填写验证码');
            return;
        }
        $form = $('form');
        $.ajax({
            type: 'post',
            url: '',
            data: $form.serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        setTimeout(function(){
                            window.location.href = '/user/reset-pwd';
                        },2000);
                    }else{
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
                    if (res.status === false) {
                         $.util.alert('该手机未注册');
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
