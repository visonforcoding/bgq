<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($user, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">手机号</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('phone', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">负责人</label>
        <div class="col-md-8">
            <?= $this->cell('Admin') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">姓名</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('truename', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <!--    <div class="form-group">
            <label class="col-md-2 control-label">等级</label>
            <div class="col-md-8">
                <label class="radio-inline"> <input name="level" value="1" checked="checked"  type="radio"> 普通</label>
                <label class="radio-inline"> <input name="level" value="2"  type="radio"> 专家 </label>
            </div>
        </div>-->
    <div class="form-group">
        <label class="col-md-2 control-label">身份证</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('idcard', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">公司</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('company', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">职位</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('position', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">邮箱</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('email', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">性别</label>
        <div class="col-md-8">
            <label class="radio-inline"> <input name="gender" value="1" checked="checked"  type="radio"> 男</label>
            <label class="radio-inline"> <input name="gender" value="2"  type="radio"> 女 </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">机构标签</label>
        <div class="col-md-8">
            <?= $this->cell('Agency') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">上传名片</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="封面图片" src=""/>
            </div>
            <input name="card_path"  type="hidden"/>
            <div id="card_path" class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">常驻城市</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('city', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">擅长业务</label>
        <div class="col-md-8">
            <textarea name="goodat" class="form-control" rows="2"></textarea>
        </div>
    </div>
<!--    <div class="form-group">
        <label class="col-md-2 control-label">项目经验</label>
        <div class="col-md-8">
            <textarea name="ymjy" class="form-control" rows="2"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">业务能力</label>
        <div class="col-md-8">
            <textarea class="form-control" name="ywnl" rows="2"></textarea>
        </div>
    </div>-->
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
<script>
    $(function () {
        initJqupload('card_path', '/wpadmin/util/doUpload?dir=/user/mp', 'jpg,png,gif,jpeg'); //初始化图片上传
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-agency').select2({
            language: "zh-CN",
            placeholder: '选择一个标签'
        });
        $('#select-admin').select2({
            language: "zh-CN",
            placeholder: '选择一个管理员'
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
                                window.location.href = '/admin/senior/index';
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
