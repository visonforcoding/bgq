<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($projrong, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">发布人</label>
        <div class="col-md-8">
              <?= $this->cell('User') ?>
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
        <label class="col-md-2 control-label">项目名称</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('title', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">融资阶段</label>
        <div class="col-md-8">
            <?= $this->cell('Stage') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">融资规模</label>
        <div class="col-md-8">
            <?= $this->cell('Scale') ?>
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
        <label class="col-md-2 control-label">股份</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('stock', ['label' => false, 'class' => 'form-control']);
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
            <?php
            echo $this->Form->input('body', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">项目简介</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('summary', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">公司简介</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('comp_desc', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">核心团队</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('team', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">资料地址</label>
        <div class="col-md-8">
            <input name="attach" type="hidden" value=""/>
            <div id="attach" class="jqupload"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">行业标签</label>
        <div class="col-md-8">
            <?= $this->cell('Industry::news') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">跟进人</label>
        <div class="col-md-8">
            <input class="form-control" name="follower"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">进度描述</label>
        <div class="col-md-8">
            <textarea class="form-control" rows="2" name="stage_remark"></textarea>
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

<script>
    $(function () {
        initJqupload('cover', '/wpadmin/util/doUpload?dir=proj/cover', 'jpg,png,gif,jpeg'); //初始化图片上传
        initJquploadAttach('attach', '/wpadmin/util/doUpload?dir=proj/attach', 'jpg,png,gif,jpeg,ppt,pptx,doc,xls,xlsx,zip,rar'); //初始化附件上传
        $('#select-industry').select2({
            language: "zh-CN",
            placeholder: '选择一个标签'
        });
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个标签'
        });
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
                            layer.confirm(res.msg, {
                                btn: ['确认', '继续添加'] //按钮
                            }, function () {
                                window.location.href = '/admin/projrong/index';
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
