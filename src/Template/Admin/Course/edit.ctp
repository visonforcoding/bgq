<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($course, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">培训标题</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('title', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">封面</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传192*184大小的图片" src="<?= $course->cover ?>"/>
            </div>
            <div style="color:red">请上传192*184大小的图片</div>
            <input name="cover" value="<?= $course->cover ?>"  type="hidden"/>
            <div id="cover" w="192" h="184" class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">封面</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传750*295大小的图片" src="<?= $course->pic ?>"/>
            </div>
            <div style="color:red">请上传750*295大小的图片</div>
            <input name="pic" value="<?= $course->pid ?>"  type="hidden"/>
            <div id="pic" w="750" h="295" class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">内容介绍</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('abstract', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">培训费用</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('fee', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
<!--    <div class="form-group">
        <label class="col-md-2 control-label">优惠费用</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('bonus_fee', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">优惠开始时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('bonus_start_time', ['label' => false, 'type' => 'text', 'value' => $course->bonus_start_time?$course->bonus_start_time->format('Y-m-d H:m:s'):'', 'class' => 'datetimepicker form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">优惠结束时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('bonus_end_time', ['label' => false, 'type' => 'text', 'value' => $course->bonus_end_time?$course->bonus_end_time->format('Y-m-d H:m:s'):'', 'class' => 'datetimepicker form-control']);
            ?>
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
<!--<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
<script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
<script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>    -->
<script>
    $(function () {
        initJqupload('cover', '/wpadmin/util/doUpload?dir=/course/cover', 'jpg,png,gif,jpeg'); //初始化图片上传
         initJqupload('pic', '/wpadmin/util/doUpload?dir=/course/pic', 'jpg,png,gif,jpeg'); //初始化图片上传
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
                                window.location.href = '/admin/course/index';
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
