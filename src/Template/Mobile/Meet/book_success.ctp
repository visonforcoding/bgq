<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            支付成功
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="uploadbox reg-sucess paysucess">
        <a href='javascript:void(0);'></a>
        <p>您的预约已经生效,请等待会员确认</p>
    </div>
    <a href="/meet/chat-list" class="nextstep paybtn">查看预约</a>
    <a href="/user/home-page/<?=$id?>" class="nextstep paybtn">返回主页</a>
</div>

<script>
    LEMON.sys.back('/user/home-page/<?=$id?>');
</script>