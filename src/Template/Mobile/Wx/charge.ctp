<div class="wraper fullwraper bgff">
    <div class="charge-container">
        <div class="title">充值金额</div>
        <div class="input-disabled input-block">
            <input type="text" name="recharge_money" placeholder="请输入充值金额" />
        </div>
        <div class="discount-charge inner" id="charge">
            <div class="discount-title">优惠套餐 <span class="really-count color-items" id="gift_money" hidden>送<i id="gift">10.00</i>元</span></div>
            <ul class="list-line clearfix">
                <?php foreach ($gift as $k=>$v): ?>
                <li gift="<?= $v->gift ?>">
                    <div class="items flex flex_center">
                        ￥<span><?= $v->recharge_money ?></span>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<div class="charge-tips">
    <p>如有充值问题，请联系客服。</p>
</div>
<div class="f-bottom" id="submit">
    立即充值
</div>
<?php $this->start('script'); ?>
<script type="text/javascript">
    $('#charge li').on('tap', function () {
        $('#gift_money').show();
        $(this).addClass('active').siblings().removeClass('active');
        $('#gift').html($(this).attr('gift'));
        $('input[name="recharge_money"]').val($(this).find('span').html());
    });
    
    $('input[name="recharge_money"]').on('input prototypechange', function(){
        for(var i=0;i<$('#charge li').length;i++){
            if($(this).val() >= parseInt($('#charge li').eq(i).find('span').html())){
                $('#charge li').eq(i).addClass('active').siblings().removeClass('active');
            } else {
                $('#charge li').eq(i).removeClass('active');
            }
        }
    });
    
    $('#submit').on('tap', function (){
        var input = $('input[name="recharge_money"]').val();
        location.href = '/wx/pay/'+input;
    });
</script>
<?php $this->end('script');