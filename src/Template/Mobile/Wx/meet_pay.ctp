<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            支付
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="h20 nobottom"></div>
    <div class="infobox a-pay">
        <ul>
            <li>标题名称：<span class='infocard'><input type="text" placeholder="<?= $order_detail->title ?>" readonly /></span></li>
            <li>费用：<span class='infocard reg-repass'><input type="text" value='<?= $order_detail->price ?>元' readonly="readonly"/></span></li>
        </ul>
    </div>
    <div class="h20 no-t-border"></div>
    <div class="infobox a-pay paytype bgff">
        <ul>
            <li class="pay"><b></b>微信支付：<span id="pay_weixin" data-pay="wx" class='infocard'><input value="wx" type="radio" name='pay' checked="checked" /><i class='active'></i></span></li>
            <?php if (!$isWx): ?>
                <li class="pay"><b></b>支付宝支付：<span id="pay_ali" data-pay="ali" class='infocard reg-repass'><input value="ali" type="radio" name='pay' /><i></i></span></li>
            <?php endif; ?>
        </ul>
    </div>
    <a id="submit"  class="nextstep"><?= $order_detail->price ?>元&nbsp;&nbsp;确认支付</a>
    <a id="submit"  class="nextstep">取消报名</a>
</div>

<?php $this->start('script') ?>
<script>
    if (<?= $order_detail['type'] ?> == 2) {
        window.apply = false;
        if (<?= $order_detail['apply_nums'] ?> < <?= $order_detail->scale ?>) {
            window.apply = true;
        }
    }
    
    window.course_id = '<?= $course_id ?>';
</script>
<script>
    var payMethod = 'wx';
    $('.pay').on('click', function () {
        payMethod = $(this).find('input[name="pay"]').val();
        $('input[name="pay"]').next('i').removeClass('active');
        $(this).find('input[name="pay"]').next('i').addClass('active');
    });

//    $('input[name="pay"]').on('click',function(){
//            payMethod = $(this).val();
//            $('input[name="pay"]').next('i').removeClass('active');
//            $(this).next('i').addClass('active');
//    });

    setTimeout(function () {
        $('body').on('tap', function (e) {
            var target = e.srcElement || e.target, em = target, i = 1;
            while (em && !em.id && i <= 3) {
                em = em.parentNode;
                i++;
            }
            if (!em || !em.id)
                return;
            switch (em.id) {
                case 'submit':
                    if (!window.apply) {
                        $.util.alert('报名人数已满');
                        return;
                    }
                    if (payMethod == 'wx') {
                        var wxConfig = '<?= json_encode($jsApiParameters) ?>';
                        if ($.util.isAPP) {
                            if (wxConfig) {
                                LEMON.pay.wx(<?= json_encode($jsApiParameters) ?>, function (res) {
                                    if (res == '0') {
                                        $.util.alert('支付成功');
                                        setTimeout(function () {
                                            if(window.course_id){
                                                $.util.ajax({
                                                    url: '/wx/buy',
                                                    data: {course_id: window.course_id},
                                                    func: function(res){
                                                        if(res.status){
                                                            location.href = '/wx/buy-success/'+res.data;
                                                        }
                                                    }
                                                });
                                            } else {
                                                window.location.href = '/wx/pay-success/<?= $order->id ?>';
                                            }
                                        }, 1000);
                                    } else {
                                        $.util.alert('支付未成功');
                                    }
                                });
                            } else {
                                LEMON.event.getWXCode(function (code) {
                                    $.util.ajax({//获取open id,比对是否存在,登录或是注册  生成token
                                        data: {code: code},
                                        url: '/wx/paywx/<?= $order->id ?>',
                                        func: function (res) {
                                            LEMON.pay.wx(res.jsApiParameters, function (res) {
                                                if (res == '0') {
                                                    $.util.alert('支付成功');
                                                    setTimeout(function () {
                                                        if(window.course_id){
                                                            $.util.ajax({
                                                                url: '/wx/buy',
                                                                data: {course_id: window.course_id},
                                                                func: function(res){
                                                                    if(res.status){
                                                                        location.href = '/wx/buy-success/'+res.data;
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            window.location.href = '/wx/pay-success/<?= $order->id ?>';
                                                        }
                                                    }, 1000);
                                                } else {
                                                    $.util.alert('支付未成功');
                                                }
                                            });
                                        }
                                    });
                                });
                            }
                            return false;
                        }
                        callpay();
                    }
                    if (payMethod == 'ali') {
                        if ($.util.isAPP) {
                            LEMON.pay.ali('<?= $aliPayParameters ?>', function (res) {
                                if (res == '9000') {
                                    $.util.alert('支付成功');
                                    setTimeout(function () {
                                        if(window.course_id){
                                            $.util.ajax({
                                                url: '/wx/buy',
                                                data: {course_id: window.course_id},
                                                func: function(res){
                                                    if(res.status){
                                                        location.href = '/wx/buy-success/'+res.data;
                                                    }
                                                }
                                            });
                                        } else {
                                            window.location.href = '/wx/pay-success/<?= $order->id ?>';
                                        }
                                    }, 1000);
                                } else {
                                    $.util.alert('支付未成功');
                                }
                            });
                        }
                    }
                    break;
                case 'goTop':
                    window.scroll(0, 0);
                    e.preventDefault();
                    break;
            }
        });
    }, 0);
    //调用微信JS api 支付
    function jsApiCall()
    {
        WeixinJSBridge.invoke(
                'getBrandWCPayRequest',
<?= json_encode($jsApiParameters) ?>,
                function (res) {
                    if (res.err_msg == "get_brand_wcpay_request：ok") {
                        $.util.alert('支付成功');
                        setTimeout(function () {
                            if(window.course_id){
                                $.util.ajax({
                                    url: '/wx/buy',
                                    data: {course_id: window.course_id},
                                    func: function(res){
                                        if(res.status){
                                            location.href = '/wx/buy-success/'+res.data;
                                        }
                                    }
                                });
                            } else {
                                window.location.href = '/wx/pay-success/<?= $order->id ?>';
                            }
                        }, 1000);
                    }else{
                        $.util.alert('未成功支付');
                    }
//                    $.each(res, function (i, n) {
//                        alert(i + ':' + n);
//                    });
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