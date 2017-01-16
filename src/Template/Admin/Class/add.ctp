<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($clas, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">导师</label>
        <div class="col-md-8">
            <?php
            echo $this->cell('Mentor');
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">课程标题</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('title', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">课程介绍</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('abstract', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">排序</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('sort', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group media audio">
        <label class="col-md-2 control-label">音频</label>
        <div class="col-md-8">
            <input name="audio" type="text" readonly class="form-control" value=""/>
            <div id="audio"  class="jqupload"></div>
            <span class="notice" style=" display: block">(*文件大小在10M以内)</span>
<!--            <div class="col-md-8 form-group mt10">
                <label style=" display: inline-block;">音频标题</label>
                <input name="audio_title" type="text"  placeholder="音频标题" class="inner-input"  value=""/>
            </div>-->
        </div>
    </div>
    <div class="form-group media audio">
        <label class="col-md-2 control-label">课件</label>
        <div class="col-md-8">
            <input name="zip" type="text" readonly class="form-control" value=""/>
            <div id="zip"  class="jqupload"></div>
            <span class="notice" style=" display: block">(*文件仅支持格式为zip,直接改后缀会导致解压缩失败;压缩包里面的图片请直接使用PPT导出jpeg,导出后不要修改任何图片或图片名,压缩时不要带有一层文件夹)</span>
<!--            <div class="col-md-8 form-group mt10">
                <label style=" display: inline-block;">音频标题</label>
                <input name="audio_title" type="text"  placeholder="音频标题" class="inner-input"  value=""/>
            </div>-->
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
        initJquploadAttach('audio', '/wpadmin/util/doUpload?dir=class/audio', '*', 10485760);
        initJquploadAttach('zip', '/wpadmin/util/doUpload?dir=class/courseware', 'zip');
//         initJqupload('cover', '/wpadmin/util/doUpload?dir=', 'jpg,png,gif,jpeg'); //初始化图片上传
        //var ue = UE.getEditor('content'); //初始化富文本编辑器
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-mentor').select2({
            language: 'zh-CN',
            placeholder: '请选择一位导师'
        });
        $('form').submit(function () {
            if(!$('#select-mentor').val()){
                layer.msg('请选择一位导师');
                return false;
            }
            if($('input[name="audio"]').val() == '' && $('input[name="pdf"]').val() == ''){
                layer.msg('音频和课件必须上传一个');
                return false;
            }
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
                                window.location.href = '/admin/class/index/<?= $course_id ?>';
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
