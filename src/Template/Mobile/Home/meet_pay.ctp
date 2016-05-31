<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            支付
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="h20"></div>
    <div class="infobox a-pay">
        <ul>
            <li>话题名称：<span class='infocard'><input type="text" placeholder="<?=$book->subject->title?>" /></span></li>
            <li>费用：<span class='infocard reg-repass'><input type="text" value='<?=$book->subject->price?>元' readonly="readonly"/></span></li>
        </ul>
    </div>
    <div class="h20"></div>
    <div class="infobox a-pay paytype">
        <ul>
            <li><b></b>微信支付：<span id="pay_weixin" data-pay="wx" class='infocard'><input type="radio" name='pay' checked="checked" /><i class='active'></i></span></li>
            <li><b></b>支付宝支付：<span id="pay_ali" data-pay="ali" class='infocard reg-repass'><input type="radio" name='pay' /><i></i></span></li>
        </ul>
    </div>
    <a href="#this" id="submit"  class="nextstep">400元&nbsp;&nbsp;确认支付</a>
</div>

<?php $this->start('script') ?>
<script>
    var payMethod = 'wx';
    setTimeout(function(){
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('pay_') !==-1) {
            //回复评论
            $('.infocard').find('i').removeClass('active');
            $(em).find('i').toggleClass('active');
            payMethod = $(em).data('pay');
        }
        switch (em.id) {
            case 'submit':
                if(payMethod =='wx'){
                    callpay();
                }
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
    },0);
        //调用微信JS api 支付
            function jsApiCall()
            {
                WeixinJSBridge.invoke(
                        'getBrandWCPayRequest',
                         <?=json_encode($jsApiParameters)?>,
                        function (res) {
                            WeixinJSBridge.log(res.err_msg);
                                 if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                                   alert('支付成功!');
                                   window.location.href = '{{url}}';
                                 } 
                            }
                );
            }

            function callpay()
            {
                console.log('微信支付被唤起');
                if (typeof WeixinJSBridge == "undefined") {
                    if (document.addEventListener) {
                        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                    } else if (document.attachEvent) {
                        document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                    }
                } else {
                    jsApiCall();
                }
            }
</script>
<?php $this->end('script'); ?>