<div class="wraper">
    <div class="h20 nobottom"></div>
    <div class="infobox a-pay">
        <ul>
            <li>标题名称：<span class='infocard'><input type="text" placeholder="<?= $apply->activity->title ?>" readonly /></span></li>
            <li>费用：<span class='infocard reg-repass'><input type="text" value='<?= $apply->apply_fee ?>元' readonly="readonly"/></span></li>
        </ul>
    </div>
    <div class="h20 no-t-border"></div>
    <a id="submit"  class="nextstep"><?= $apply->apply_fee ?>元&nbsp;&nbsp;确认支付</a>
    <!--<a id="submit"  class="nextstep">取消报名</a>-->
</div>
<div class="reg-shadow" style="display: none;" id="shadow"></div>
<div class="charge-box charge-box-hide" id="buy">
    <div class="title">
        <h3 class="nav-title  innerwaper"><?= $apply->activity->title ?></h3>
        <div class="iconfont closed" id="closed">&#xe6b4;</div>
    </div>
    <ul class="outerblock">
        <li>
            <div class="items flex flex_jusitify">
                <div class="left-info">支付总额：</div>
                <div class="color-items">￥<?= $apply->apply_fee ?></div>
            </div>
            <div class="items flex flex_jusitify">
                <div class="left-info">我的钱包：</div>
                <div class="color-items" id="my_wallet">--</div>
            </div>
        </li>
        <li id="need_charge">
            <div class="items flex flex_jusitify">
                <div class="left-info">还需充值：</div>
                <div class="color-items">--</div>
            </div>
        </li>
    </ul>
    <div class="innerwaper mt60">
        <div class="btn-pay" id="buy_btn">
            立即充值
        </div>
    </div>
</div>
<?php $this->start('script') ?>
<script>
    window.apply_fee = '<?= $apply->apply_fee ?>';
    window.apply_id = '<?= $apply->id ?>';
</script>
<script>
    var pay = function(o){
        this.opt = {};
        $.extend(this, this.opt, o);
    };
    $.extend(pay.prototype, {
        init: function (){
            this.bodyTap();
        },
        
        bodyTap: function(){
            var obj = this;
            $.util.tap($('body'), function(e){
                var target = e.srcElement || e.target, em = target, i = 1;
                while (em && !em.id && i <= 3) {
                    em = em.parentNode;
                    i++;
                }
                if (!em || !em.id)
                    return;
                switch(em.id){
                    case 'submit':
                        if(!$.util.isLogin()){
                            $.util.alert('请先登录');
                            setTimeout(function(){location.href = '/user/login?redirect_url='+document.URL;}, 500);
                            return;
                        }
                        $.util.ajax({
                            url: '/user/get-wallet',
                            func: function(res){
                                if(res.status){
                                    $('#my_wallet').html('￥'+res.data);
                                    if(res.data < window.apply_fee){
                                        $('#need_charge').show();
                                        $('#need_charge').find('.color-items').html('￥'+(parseFloat(window.apply_fee)*100-parseFloat(res.data)*100)/100);
                                        $('#buy_btn').html('立即充值');
                                        window.is_money_enough = 0;
                                    } else {
                                        $('#need_charge').hide();
                                        $('#buy_btn').html('立即购买');
                                        window.is_money_enough = 1;
                                    }
                                    $('#shadow').show();
                                    $('#buy').toggleClass('charge-box-hide');
                                } else {
                                    $.util.alert(res.msg);
                                }
                            }
                        });
                        break;
                    case 'shadow': case 'closed':
                        $('#buy').toggleClass('charge-box-hide');
                        setTimeout(function(){$('#shadow').hide();}, 100);//和动画一致
                        break;
                    case 'buy_btn':
                        if(window.is_money_enough){
                            $.util.ajax({
                                url: '/wx/apply',
                                data: {apply_id: window.apply_id},
                                func: function(res){
                                    if(res.status){
                                        location.href = '/wx/pay-success/';
                                    } else {
                                        $.util.alert(res.msg);
                                    }
                                }
                            });
                        } else {
                            location.href = '/wx/charge/' + window.apply_id + '/2';
                        }
                        break;
                }
                return false;
            });
        },
    });
    
    var payobj = new pay();
    payobj.init();
</script>
<?php $this->end('script');