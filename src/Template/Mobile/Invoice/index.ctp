<div class="wraper">
    <div class="invoic_moth_items" id='allinvoic'>
        <div class='invoic_month clearfix'>
            <h3 class="innerwaper"><span class="fl"></span><a href="/invoice/history" class='fr'>开票历史</a></h3>
        </div>
        <div class="invoic_moth_con">
            <div class="innerwaper">
                <form action="" method="post">
                    <ul id="order">

                    </ul>
                </form>
            </div>
        </div>
        <div style="height:1.4rem"></div>
        <div class="invoic_total_fixed">
            <div class="innerwaper">
                <div class="fl">
                    <span class="all_invoic" id="allchoose" data-type='0'><i class="iconfont">&#xe6a8;</i>全选</span>
                    <div class="invo_total_pice"><i class="color-items">0</i>个项目共<i class="color-items">0</i>元</div>
                </div>
                <div class="fr">
                    <a href="javascript:void(0)" class="invoic_next" id="next_move">下一步</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/html" id="tpl">
    <li class="bd1" data-type=0>
        <input type="hidden" name="order_id[_ids][]" value="" order_id="{#id#}" >
        <span class="invoic_left_btn"><i class="iconfont">&#xe6a8;</i></span>
        <div class="invoic_right_con clearfix">
            <div class="invoic_con_left fl">
                <time>{#create_time#}</time>
                <p class="invoic_active line2"><span>活动：</span>{#activity_title#}</p>
            </div>
            <div class="fr">
                <span class="invoic_right_price"><i id="money">{#fee#}</i>元</span>
            </div>
        </div>
    </li>
</script>
<script type="text/javascript">

</script>
<?php $this->start('script'); ?>
<script>
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/invoice/get-order",
        success: function (res) {
            if (res.status) {
                dealData(res.data);
            }
        }
    });
    
    $('#next_move').on('tap', function(){
        var j = 0;
        $('#allinvoic li').each(function (){
            if($(this).attr('data-type') == 1){
                j++;
            }
        });
        if(j == 0){
            $.util.alert('请选择一个条目');
            return false;
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: $('form').serialize(),
            url: '',
            success: function (res) {
                if(res.status){
                    window.location.href = '/invoice/complete-info';
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    });

    function dealData(data) {
        var html = $.util.dataToTpl('order', 'tpl', data, function (d) {
            d.activity_title = d.activityapply.activity.title;
            return d;
        });
        operate();
    }

    function operate() {
        var num = $('#allinvoic li[data-type]').length;
        var allchoose = $('#allchoose');//全选
        $('.invoic_moth_con li').on('tap', function () {
            var dataType = $(this).attr('data-type');
            if (dataType == '0') {
                $(this).children('.invoic_left_btn').html('<i class="iconfont color-items">&#xe6a9;</i>');
                $(this).attr('data-type', 1);
                $(this).find('input').val($(this).find('input').attr('order_id'));
            } else {
                $(this).children('.invoic_left_btn').html('<i class="iconfont">&#xe6a8;</i>');
                $(this).attr('data-type', 0);
                $(this).find('input').val('');
            }
            if ($('#allinvoic li[data-type ="1"]').length == num) {
                allchoose.attr('data-type', 1);
                allchoose.html('<i class="iconfont color-items">&#xe6a9;</i>全选');
            } else {
                allchoose.attr('data-type', 0);
                allchoose.html('<i class="iconfont">&#xe6a8;</i>全选');
            }
            $('.invo_total_pice').find('i').eq(0).html($('#allinvoic li[data-type ="1"]').length);
            var total_price = 0;
            for (var i = 0; i < $('#allinvoic li[data-type ="1"]').length; i++) {
                total_price += parseInt($('#allinvoic li[data-type ="1"]').eq(i).find('#money').html() * 100);
            }
            total_price /= 100;
            $('.invo_total_pice').find('i').eq(1).html(total_price);
        });
        allchoose.on('tap', function () {
            var dataType = $(this).attr('data-type');
            if (dataType == '0') {
                $(this).html('<i class="iconfont color-items">&#xe6a9;</i>全选');
                $(this).attr('data-type', 1);
                $('#allinvoic li[data-type = "0"]').children('.invoic_left_btn').html('<i class="iconfont color-items">&#xe6a9;</i>');
                $('#allinvoic li[data-type = "0"]').attr('data-type', 1);
                $('#allinvoic li[data-type = "1"]').find('input').each(function (){
                    $(this).val($(this).attr('order_id'));
                });
            } else {
                $(this).html('<i class="iconfont">&#xe6a8;</i>全选');
                $(this).attr('data-type', 0);
                $('#allinvoic li[data-type = "1"]').children('.invoic_left_btn').html('<i class="iconfont">&#xe6a8;</i>');
                $('#allinvoic li[data-type = "1"]').attr('data-type', 0);
                $('#allinvoic li[data-type = "0"]').find('input').each(function (){
                    $(this).val('');
                });
            }
            $('.invo_total_pice').find('i').eq(0).html($('#allinvoic li[data-type ="1"]').length);
            var total_price = 0;
            for (var i = 0; i < $('#allinvoic li[data-type ="1"]').length; i++) {
                total_price += parseInt($('#allinvoic li[data-type ="1"]').eq(i).find('#money').html() * 100);
            }
            total_price /= 100;
            $('.invo_total_pice').find('i').eq(1).html(total_price);
        });
    }
</script>
<?php
$this->end('script');
