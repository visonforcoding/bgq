<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($invoice, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">用户</label>
        <div class="col-md-8">
            <?= $this->cell('User') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">发票类型</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('is_VAT', ['type' => 'select', 'options' => ['2' => '普通发票', '1' => '增值税发票'], 'label' => false, 'class' => 'form-control']);
            ?>
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
    <div hidden id="VAT">
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
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type='submit' id='submit' class='btn btn-primary' value='保存' data-loading='稍候...' /> 
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

<?php $this->start('script'); ?>
<script type="text/javascript" src="/wpadmin/lib/jqform/jquery.form.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqupload/jquery.uploadfile.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqvalidation/js/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqvalidation/js/jquery.validationEngine.js"></script>
<script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
<!--<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
    <script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
    <script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>-->
<script>
    $(function () {
        // initJqupload('cover', '/wpadmin/util/doUpload', 'jpg,png,gif,jpeg'); //初始化图片上传
        //var ue = UE.getEditor('content'); //初始化富文本编辑器
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个用户'
        });
            $('select[name="is_VAT"]').on('change', function () {
                if ($(this).val() == 1) {
                    $('#VAT').show();
                } else {
                    $('#VAT').hide();
                }
            });

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
                            layer.confirm(res.msg, {
                                btn: ['确认', '继续添加'] //按钮
                            }, function () {
                                window.location.href = '/admin/invoice/index';
                            }, function () {
                                window.location.reload();
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
