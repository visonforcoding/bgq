<link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
<script src="/wpadmin/js/jquery.js"></script>
<script src="/wpadmin/lib/layer/layer.js"></script>
<script src="/wpadmin/lib/layer/extend/layer.ext.js"></script>
<div class="invoice view large-9 medium-8 columns content">
    <form action="" method="post">
        <table class="vertical-table table table-hover table-bordered">
            <tr>
                <th>用户</th>
                <td><?= h($invoice->user->truename) ?></td>
            </tr>
            <tr>
                <th>公司名称</th>
                <td><?= h($invoice->company) ?></td>
            </tr>
            <tr>
                <th>总金额</th>
                <td><?= h($invoice->sum) ?></td>
            </tr>
            <tr>
                <th>收件人</th>
                <td><?= h($invoice->recipient) ?></td>
            </tr>
            <tr>
                <th>收件人电话</th>
                <td><?= h($invoice->recipient_phone) ?></td>
            </tr>
            <tr>
                <th>收件人地址</th>
                <td><?= h($invoice->recipient_address) ?></td>
            </tr>
            <tr>
                <th>快递</th>
                <td><input name="shipment_express" type="text" class="form-control" required="required" maxlength="50" value="" ></td>
            </tr>
            <tr>
                <th>快递单号</th>
                <td><input name="shipment_number" type="text" class="form-control" required="required" maxlength="50" value="" ></td>
            </tr>
        </table>
    </form>
</div>
<div class="form-group">
    <div class="col-md-offset-2 col-md-10">
        <a href="javascript:void(0)" class='btn btn-primary' data-loading='稍候...' id="submit" >保存</a> 
    </div>
</div>
<script>
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    $('#submit').on('click', function () {
        if ($('input[name="shipment_express"]').val() == '') {
            layer.alert('请填写快递');
            return false;
        }
        if ($('input[name="shipment_number"]').val() == '') {
            layer.alert('请填写快递单号');
            return false;
        }
        var form = $('form').serialize();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: form,
            url: "/admin/invoice/shipment/<?= $invoice->id ?>",
            success: function (res) {
                parent.layer.alert(res.msg);
                if (res.status) {
                    parent.$('#list').trigger('reloadGrid');
                    parent.layer.close(index);
                }
            }
        });
    });
</script>

