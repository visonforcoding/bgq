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
                <div class='username'><span></span><input type='text' v-model="user.phone" v-on:blur="ckPhone"  placeholder="请输入手机号"></div>
                <div class='password'><span></span><input type='password' v-model="password"><a href='javascript:void(0);'>获取验证码</a></div>
            </div>
            <a href="javascript:void(0);" class="submit" >确定</a>
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
<script>
    var user ={};
    new Vue({
        el: '#user-login',
        data: {
            user:{
                phone:'183'
            }
        },
        methods:{
            ckPhone:function(event){
                console.log(user.phone);
            },
            watch:function(newV,oldV){
                console.log(newV);
            }
        }
    });  
</script>
<?php
$this->end('script');
