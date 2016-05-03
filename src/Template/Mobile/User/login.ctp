<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            登录
        </h1>
        <a href="regiser.html" class='h-regiser'>注册</a>
    </div>
</header>
<div class="wraper">
    <div id="user-login" class='login-area'>
        <form action="" method="post">
            <div class="loginbox">
                <div class='username'><span></span><input type='text' name="phone"    placeholder="请输入手机号"></div>
                <div class='password'><span></span><input type='text' placeholder="在此输入验证码" >
                    <a  id="getVcode" href='javascript:void(0);'>获取验证码</a></div>
            </div>
            <a href="javascript:void(0);"  class="submit" >确定</a>
        </form>

    </div>
</div>
<footer>
    <h1>使用其他方式登录</h1>
    <div class="othertype">
        <a href="#this">
            <img src="/mobile/images/weixin.png" />
        </a>
    </div>
</footer>
<?php $this->start('script') ?>
<script src="/mobile/js/function.js"></script>
<script>
    var t1 = null;
        $('input[name="phone"]').focusout(function(){
            var phone = $(this).val();
            checkPhone(phone);
        });
        $('#getVcode').on('click',function(){
            var $obj = $(this);
            var phone = $('input[name="phone"]').val();
            if(is_mobile(phone)){
                $.post('/mobile/user/sendVcode',{phone:phone},function(res){
                    if(res.status===true){
                        //$obj.attr('disabled ','true');
                        var text = '<span id="timer">'+30+'</span>s后重新发送';
                        $obj.html(text);
                        t1 = setInterval(function(){
                           var timer = $('#timer').text();
                           timer--;
                           if(timer<1){
                               //$obj.removeAttr('disabled');
                               $obj.html('获取验证码');
                               clearInterval(t1);
                           }else{
                               $('#timer').text(timer);
                           }
                        },1000);
                    }
                },'json');
            }
        });
    function checkPhone(phone){
        if(phone !==''){
            if(is_mobile(phone)){
                $.post('/mobile/user/ckUserPhoneExist',{phone:phone},function(res){
                   if(res.status===false){
                       alert(res.msg);
                   } 
                },'json');
            }else{
                alert('手机号不合法！');
            }
        }
    }
</script>
<?php
$this->end('script');
