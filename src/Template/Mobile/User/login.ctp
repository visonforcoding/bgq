<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            登录
        </h1>
        <!-- <a href="/user/register-vphone" class='h-regiser'>注册</a> -->
    </div>
</header>
<div class="wraper">
    <div id="user-login" class='login-area'>
        <form action="" method="post">
            <div class="loginbox">
                <div class='username'><label class="label"><span class='iconfont'>&#xe630;</span></label><input type='text' name="phone" placeholder="请输入手机号"></div>
                <div class='password'><label class="label"><span class='iconfont'>&#xe631;</span></label><input name="vcode" type='text' placeholder="在此输入验证码" >
                    <button class="clearfix" type="button"  id="getVcode" href='javascript:void(0);'>获取验证码</button>
                </div>
            </div>
            <a href="javascript:void(0);"  id="submit" class="submit redshadow" >登录</a>
             <a href="/user/register-vphone" class='historyinfo colore01'>注册</a>
        </form>

    </div>
</div>
<div class="wxlogin">
    <h1>使用其他方式登录</h1>
    <div class="othertype">
        <a id="wxlogin" href="javascript:void(0);">
            <img src="/mobile/images/weixin.png" />
        </a>
    </div>
</div>
<?php $this->start('script') ?>
<script>
    if(location.href.indexOf('loginout=1')>0){
        $.util.setCookie('token_uin','');
        LEMON.db.set('token_uin','');
        //$.util.setCookie('login_url','/home/index',99999);
    }
    var t1 = null;
    $('input[name="phone"]').focusout(function () {
        var phone = $(this).val();
        //checkPhone(phone);
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
            $.post('/user/sendLoginCode', {phone: phone}, function (res) {
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
        $form = $('form');
        $.util.ajax({
            url: $form.attr('action'),
            data: $form.serialize(),
            func: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        if($.util.isAPP){
                            $.util.setCookie('token_uin',msg.token_uin,10*365*24*60);
                            LEMON.db.set('token_uin',msg.token_uin);
                        }
                        document.location.href = msg.redirect_url;
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        return false;
    });
    $('#wxlogin').on('click', function () {
        if ($.util.isAPP) {
            LEMON.login.wx(function (code) {
            $.util.ajax({   //获取open id,比对是否存在,登录或是注册  生成token
                data:{code:code},
                url: '/wx/appLogin',
                func:function(res){
                    //res = JSON.parse(res);
                    $.util.alert(res.msg);
                    if(res.status){
                        $.util.setCookie('token_uin',res.token_uin,10*365*24*60);
                        $.util.setCookie('login_status', 'yes', 20*60);
                        LEMON.db.set('token_uin',res.token_uin);
                        document.location.href = res.redirect_url;
                    }
                }
            });
          });
        } else {
            document.location.href = '/wx/get-user-jump';
        }
    });
    function checkPhone(phone) {
        if (phone !== '') {
            if ($.util.isMobile(phone)) {
                $.post('/user/ckUserPhoneExist', {phone: phone}, function (res) {
                    if (res.status === false) {
                        $.util.alert(res.msg);
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
