<?php $this->start('static') ?>   
<link href="/admin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/admin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($group, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">群组名称</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('name', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">备注</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('remark', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">创建时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('ctime', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">修改时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('utime', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">修改时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('menu._ids', ['options' => $menu, 'label' => false,
                'class' => 'form-control']);
            ?>
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
<script type="text/javascript" src="/admin/lib/jqform/jquery.form.js"></script>
<script type="text/javascript" src="/admin/lib/jqupload/jquery.uploadfile.js"></script>
<script type="text/javascript" src="/admin/lib/jqvalidation/js/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/admin/lib/jqvalidation/js/jquery.validationEngine.js"></script>
<script>
    $(function () {
        // initJqupload('cover', '/admin/util/doUpload', 'jpg,png,gif,jpeg'); //初始化图片上传
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('form').ajaxForm({
            dataType: 'json',
            beforeSubmit: function (formData, jqForm, options) {
            },
            success: function (data) {
                console.log(data);
                if (data.status) {
                    layer.alert(data.msg, function () {
                        window.location.href = '/admin/group/index';
                    });
                } else {
                    layer.alert(data.msg, {icon: 5});
                }
            }
        });
    });
</script>
<?php
$this->end();
