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
            <?= $this->cell('User', [[$projrong->user_id]]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">发布人</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('publisher', ['label' => false, 'class' => 'form-control']);
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
            <?= $this->cell('Stage', [[$projrong->stage_id]]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">融资规模</label>
        <div class="col-md-8">
            <?= $this->cell('Scale', [[$projrong->scale_id]]) ?>
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
                <img  alt="封面图片" src="<?= $projrong->cover ?>"/>
            </div>
            <input name="cover" value="<?= $projrong->cover ?>"  type="hidden"/>
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
            <input name="attach" type="hidden" value="<?= $projrong->attach ?>"/>
            <div id="attach" class="jqupload"></div>
             <span class="notice">(*文件大小在30M以内)</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">行业标签</label>
        <div class="col-md-8">
            <?= $this->cell('Industry::news', [$selIndustryIds]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">跟进人</label>
        <div class="col-md-8">
            <input class="form-control" name="follower" value="<?= $projrong->follower ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">进度描述</label>
        <div class="col-md-8">
            <textarea class="form-control" rows="2" name="stage_remark"><?= $projrong->stage_remark ?></textarea>
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
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-industry').select2({
            language: "zh-CN",
            placeholder: '选择一个标签'
        });
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个发布人'
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
                                window.location.href = '/admin/projrong/index';
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
