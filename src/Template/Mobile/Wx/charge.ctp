<div class="wraper fullwraper bgff">
    <div class="charge-container">
        <div class="title">充值金额</div>
        <div class="input-disabled input-block">
            <input type="text" name="recharge_money" placeholder="请输入充值金额" />
        </div>
        <div class="discount-charge inner" id="charge">
            <div class="discount-title">优惠套餐</div>
            <ul class="list-line clearfix">
                <?php foreach ($gift as $k=>$v): ?>
                <li>
                    <div class="items flex flex_center">
                        <div class="aligncenter">
                            <h3>￥<span class="money"><?= $v->recharge_money ?></span></h3>
                            <span class="really-count">送<i><?= $v->gift ?></i>元</span>
                        </div>
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
<script>
   window.course_id = '<?= $course_id ?>';
</script>
<script type="text/javascript">
    $('#charge li').on('tap', function () {
        $('#gift_money').show();
        $(this).addClass('active').siblings().removeClass('active');
        $('input[name="recharge_money"]').val($(this).find('.money').html());
    });
    
    $('input[name="recharge_money"]').on('input prototypechange', function(){
        for(var i=0;i<$('#charge li').length;i++){
            if($(this).val() >= parseInt($('#charge li').eq(i).find('.money').html())){
                $('#charge li').eq(i).addClass('active').siblings().removeClass('active');
            } else {
                $('#charge li').eq(i).removeClass('active');
            }
        }
    });
    
    $('#submit').on('tap', function (){
        var input = $('input[name="recharge_money"]').val();
        $.util.ajax({
            url: '/course/charge-order/'+input,
            func: function(res){
                if(res.status){
                    if(window.course_id){
                        location.href = '/wx/meet-pay/'+res.data+'?course_id='+window.course_id;
                    } else {
                        location.href = '/wx/meet-pay/'+res.data;
                    }
                }
            }
        });
    });
</script>
<?php $this->end('script');