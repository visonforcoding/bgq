<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($beauty, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">用户</label>
        <div class="col-md-8">
            <?= $this->cell('User', [[$beauty->user_id]]); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">票数</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('vote_nums', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">星座</label>
        <div class="col-md-8">
            <?php
                echo $this->Form->input('constellation', ['type'=>'select', 'options'=>[
                    '白羊座'=>'白羊座',
                    '金牛座'=>'金牛座',
                    '双子座'=>'双子座',
                    '巨蟹座'=>'巨蟹座',
                    '狮子座'=>'狮子座',
                    '处女座'=>'处女座',
                    '天秤座'=>'天秤座',
                    '天蝎座'=>'天蝎座',
                    '射手座'=>'射手座',
                    '摩羯座'=>'摩羯座',
                    '水瓶座'=>'水瓶座',
                    '双鱼座'=>'双鱼座',
                ], 'label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-md-2 control-label">参赛宣言</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('declaration', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">兴趣爱好</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('hobby', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">个人简介</label>
        <div class="col-md-8">
            <?php
                echo $this->Form->input('brief', ['type'=>'textarea', 'label' => false, 'class' => 'form-control']);
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
<script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
<!--<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
<script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
<script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>    -->
<script>
    $(function () {
        // initJqupload('cover', '/wpadmin/util/doUpload', 'jpg,png,gif,jpeg'); //初始化图片上传
        //var ue = UE.getEditor('content'); //初始化富文本编辑器
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个用户'
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
                            layer.alert(res.msg, function () {
                                window.location.href = '/admin/beauty/index';
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
