<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($activity, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">行业标签</label>
        <div class="col-md-8">
            <?=$this->cell('Industry')?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">主办单位</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('company', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">活动名称</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('title', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">活动时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('time', ['label' => false, 'class' => 'form-control']);
            ?>
            <span class="notice">(例:2016-09-09 12:00-13:00)</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">地区</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('region_id', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">地点</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('address', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">规模</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('scale', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">是否众筹</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('is_crowdfunding', ['type' => 'select', 'options' => ['0' => '否','1' => '是'], 'label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">专家推荐</label>
        <div class="col-md-8">
            <?=$this->cell('Savant')?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">费用</label>
        <div class="col-md-8">
        <?php
            echo $this->Form->input('apply_fee', ['label' => false, 'class' => 'form-control']);
        ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">封面</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="封面图片" src=""/>
            </div>
            <input name="cover"  type="hidden"/>
            <div id="cover" class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">活动内容</label>
        <div class="col-md-8">
            <script name='body' id='content' rows='3' type="text/plain" class='form-control-editor'>
                <p>活动介绍：</p>
                <p><br/></p>
                <p><br/></p>
                <p>活动流程：</p>
                <p><br/></p>
                <p><br/></p>
                <p>参与嘉宾：</p>
                <p><br/></p>
                <p><br/></p>
                <p>联系方式：<br/></p>
            </script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">摘要</label>
        <div class="col-md-8">
            <script name='summary' id='summary' rows='3' type="text/plain" class='form-control-editor'><?= $activity->summary ?></script>
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
<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
<script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
<script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>
<script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
<script>
$(function () {
    initJqupload('cover', '/wpadmin/util/doUpload?dir=activitycover', 'jpg,png,gif,jpeg'); //初始化图片上传
    var ue = UE.getEditor('content'); //初始化富文本编辑器
    UE.getEditor('summary');
    $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
    $('#select-industry').select2({
        language: "zh-CN",
        placeholder: '选择一个标签'
    });
    $('#select-savant').select2({
        language: "zh-CN",
        placeholder: '选择一个标签'
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
                            window.location.href = '/admin/activity/index';
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
