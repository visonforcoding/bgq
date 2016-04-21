<?php

$this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($banner, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">类型</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('type', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <input type="hidden" name="img" class="form-control" required="required" maxlength="250" id="img" >
    <div class="form-group">
        <label class="col-md-2 control-label">点击选择图片</label>
        <div class="col-md-4">
            <div id="attachuploader">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">链接地址</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('url', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">备注说明</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('remark', ['label' => false, 'class' => 'form-control']);
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
<script type="text/javascript" src="/wpadmin/lib/jqform/jquery.form.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqupload/jquery.uploadfile.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqvalidation/js/languages/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="/wpadmin/lib/jqvalidation/js/jquery.validationEngine.js"></script>
<script>
    $(function () {
        // initJqupload('cover', '/admin/util/doUpload', 'jpg,png,gif,jpeg'); //初始化图片上传
        var up = $("#attachuploader").uploadFile({
            url: "/admin/banner/uploadImg",
            fileName: "file",
            uploadStr: "上传",
            doneStr: "上传完成",
            maxFileCount: 1,
            dragDropStr: "<span><b>试试拖动文件上传</b></span>",
            onSuccess: function (files, data, xhr, pd) {
                console.log(data);
                if (data.status) {
                    $("#img").val(data.record_path);
                    layer.msg(data.msg);
                    $("#attachuploader").parent('div').append('<input type="hidden" name="resume_url" value="' + data.path + '"/>')
                } else {
                    layer.alert(data.msg);
                }
            },
            onSelect: function (files) {
                up.reset();  //单个图片上传的 委曲求全的办法
            },
        });
        $('form').ajaxForm({
            dataType: 'json',
            beforeSubmit: function (formData, jqForm, options) {
            },
            success: function (data) {
                console.log(data);                
                if (data.status) {                    
                    layer.alert(data.msg, {icon: 6});
                } else {
                    layer.alert(data.msg, {icon: 5});
                }
            }
        });
    });
</script>
<?php
$this->end();
