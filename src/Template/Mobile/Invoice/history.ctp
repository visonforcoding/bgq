<div class="wraper">
    <ul class="invoic_history" id="invoice">
    </ul>
</div>
<script type="text/html" id="tpl">
    <li>
        <a href="/invoice/detail/{#id#}" class="ablock">
            <div class="invoic_h_left">
                <div><span class="price"><i class="color-items">{#sum#}</i>元</span><span>{#type#}</span></div>
                <time>{#create_time#}</time>
            </div>
            <div class="invoic_h_right">
                <span>{#is_shipment#}</span><i class="iconfont">&#xe667;</i>
            </div>
        </a>
    </li>
</script>
<?php $this->start('script'); ?>
<script>
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "/invoice/get-invoice",
        success: function (res) {
            if(res.status){
                dealData(res.data);
            } else {
                $.util.alert(res.msg);
            }
        }
    });
    
    function dealData(data){
        $.util.dataToTpl('invoice', 'tpl', data, function(d){
            d.is_shipment = d.is_shipment == 1 ? '已开票' : '待开票';
            d.type = d.is_VAT == 1 ? '增值税发票' : '普通发票';
            return d;
        });
    }
</script>
<?php $this->end('script');
