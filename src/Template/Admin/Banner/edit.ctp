<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($banner, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">类型</label>
        <div class="col-md-8">
            <select name="type" class="form-control">
                <?php foreach ($types as $key => $type): ?>
                    <option value="<?= $key ?>" <?php if ($banner->type == $key): ?>selected<?php endif; ?>><?= $type ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">图片</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传750*380大小的图片" src="<?= $banner->img; ?>"/>
            </div>
            <div style="color:red">请上传750*380大小的图片</div>
            <input name="img" value="<?= $banner->img; ?>"  type="hidden"/>
            <div id="cover" w="750" h="380" class="jqupload">上传</div>
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
        initJqupload('cover', '/admin/banner/doUpload?dir=banner', 'jpg,png,gif,jpeg'); //初始化图片上传
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
                                window.location.href = '/admin/banner/index';
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
