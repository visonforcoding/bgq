<header class="myhome">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>提现</h1>
    </div>
</header>
<div class="wraper m-fixed-bottom">
    <ul class="h-info-box e-info-box">
        <li class="no-right-ico">
            <span>姓名：</span>
            <div>
                <input type="text"  value="<?=$userInfo->truename?>" />
            </div>
        </li>
        <li>
            <span>银行：</span>
            <div>
                <input type="text" name="bank"  />
            </div>
        </li>
        <li class="no-right-ico">
            <span>卡号：</span>
            <div>
                <input type="text" name="cardno"  />
            </div>
        </li>
        <li class="no-right-ico nobottom">
            <span>提现金额：</span>
            <div>
                <input type="text" name="amount"   />
            </div>
        </li>

    </ul>
    <p class="inner ft26">钱包余额：¥<?=$userInfo->money?>，<i class="color-items">全部提现</i></p>
    <a href="javascript:void(0);" id="submit" class="nextstep topull">确认提现</a>
    <p class="inner tocard">3个工作日到账</p>
</div>
<div class='reg-shadow' hidden="true"></div>
<!--提现-->
<div class="totips" style="display: none;">
    <h3>提现确认</h3>
    <span>提现<i id="amount"><?=$userInfo->money?></i>元到尾号<i id="cardno">0499</i>的卡号</span>
    <a href="javascript:void(0);" id="withdraw" class="nextstep topush">确认</a>
    <span id="closed" class='closed'>
        &times;
    </span>   
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    setTimeout(function(){
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('praise_') !==-1) {
        }
        var amount = $('input[name="amount"]').val();
        var cardno = $('input[name="cardno"]').val();
        var bank = $('input[name="bank"]').val();
        var total = <?=$userInfo->money?>;
        switch (em.id) {
            case 'submit':
                //弹出确认框
                if(!bank){
                    $.util.alert('请输入提现银行');
                    return;
                }
                if(!amount){
                    $.util.alert('请输入提现金额');
                    return;
                }
                if(!cardno){
                    $.util.alert('请输入提现卡号');
                    return;
                }
                if(amount>total){
                    $.util.alert('提现金额不能大于'+total);
                    return;
                }
                $('#amount').html(amount);
                $('#cardno').html(cardno.substr(cardno.length-4));
                $('.reg-shadow,.totips').show('slow');
                break;
            case 'withdraw':
                $.util.ajax({
                    data:{amount:amount,cardno:cardno,bank:bank},
                    func:function(res){
                        if(res.status){
                            document.location.href = '/home/withdraw-success';
                        }
                    }
                });
                break;
            case 'closed':
                $('.reg-shadow,.totips').hide();
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
    },0);
</script>
<?php $this->end('script'); ?>