<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($admin, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">用户名</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('username', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">头像</label>
        <div class="col-md-8">
            <div style="width:60px;height:60px;padding:0px;"  class="img-thumbnail input-img img-circle"  single>
                <img style="width:60px;height:60px" class="img-circle"  alt="" src="<?=$admin->avatar?>"/>
            </div>
            <div style="color:red">可不设置头像</div>
            <input name="avatar" value="<?=$admin->avatar?>"  type="hidden"/>
            <div id="avatar" class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">真实姓名</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('truename', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">密码</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('password', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">手机号</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('phone', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">账号状态</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->radio('enabled', [
                ['value' => '1', 'text' => '启用'],
                ['value' => '0', 'text' => '禁用']
            ]);
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
<!--<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
<script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
<script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>    -->
<script>
    $(function () {
         initJqupload('avatar', '/wpadmin/util/doUpload?dir=admin/avatar&zip=1', 'jpg,png,gif,jpeg'); //初始化图片上传
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
                                window.location.href = '/admin/admin/index';
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
