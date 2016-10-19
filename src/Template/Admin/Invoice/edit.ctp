<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($invoice, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">用户</label>
        <div class="col-md-8">
            <input type="text" class="form-control" required="required" maxlength="50" value="<?= $invoice->user->truename ?>" >
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">公司名称</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('company', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">总金额</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('sum', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">收件人</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('recipient', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">收件人电话</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('recipient_phone', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">收件人地址</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('recipient_address', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <?php if($invoice->is_VAT == 1): ?>
    <div class="form-group">
        <label class="col-md-2 control-label">纳税人识别号</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('registration_num', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">公司地址</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('company_address', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">公司电话</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('company_phone', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">开户行</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('bank', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">开户账号</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('bank_account', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="form-group">
        <label class="col-md-2 control-label">发货情况</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('is_shipment', ['type'=>'select', 'options'=>['0'=>'待发货', '1'=>'已发货'], 'label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <?php if($invoice->is_shipment): ?>
    <div class="form-group">
        <label class="col-md-2 control-label">快递</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('shipment_express', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">快递单号</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('shipment_number', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <?php endif; ?>
<!--    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type='submit' id='submit' class='btn btn-primary' value='保存' data-loading='稍候...' /> 
        </div>
    </div>-->
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <a href="javascript:history.back();" class='btn btn-primary' data-loading='稍候...' >返回</a> 
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

<?php $this->start('script'); ?>
<script type="text/javascript" src="/wpadmin/lib/jqform/jquery.form.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqupload/jquery.uploadfile.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqvalidation/js/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqvalidation/js/jquery.validationEngine.js"></script>
<!--<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
<script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
<script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>    -->
<script>
    $(function () {
        // initJqupload('cover', '/wpadmin/util/doUpload', 'jpg,png,gif,jpeg'); //初始化图片上传
        //var ue = UE.getEditor('content'); //初始化富文本编辑器
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('form').submit(function () {
            var form = $(this);
            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (typeof res === 'object') {
                        if (res.status) {
                            layer.alert(res.msg, function () {
                                window.location.href = '/admin/invoice/index';
                            });
                        } else {
                            layer.alert(res.msg, {icon: 5});
                        }
                    }
                }
            });
            return false;
        });
    });
</script>
<?php
$this->end();
