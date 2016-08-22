<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            预约成功
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="uploadbox reg-sucess paysucess">
        <a href='javascript:void(0);'></a>
        <p>支付成功</p>
    </div>
    <?php if($order->type==1): ?>
    <a href="/home/my-book" class="nextstep paybtn">查看预约</a>
    <?php else:?>
    <a href="/home/my_activity_submit" class="nextstep paybtn">查看我的活动</a>
    <?php endif;?>
    <a href="/home/index" class="nextstep paybtn">返回主页</a>
</div>