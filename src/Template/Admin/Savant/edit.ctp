<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($savant, ['class' => 'form-horizontal']) ?>
    <?php if ($savant->savant_status == 0): ?>
        <div class="form-group">
            <label class="col-md-2 control-label">未通过审核理由</label>
            <div class="col-md-8">
                <?php
                echo $this->Form->input('user.reason', ['label' => false, 'class' => 'form-control']);
                ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label class="col-md-2 control-label">用户</label>
        <div class="col-md-8">
            <?= $this->cell('User', [[$savant->id]]); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">封面</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="封面图片" src="<?= $savant->savant->cover ?>"/>
            </div>
            <input name="savant[cover]"  type="hidden"/>
            <div id="cover" class="jqupload">上传</div>
             <span class="notice">类型为jpg,png,gif,jpeg</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">项目经验</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('savant.xmjy', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">资源优势</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('savant.zyys', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">简介</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('savant.summary', ['label' => false, 'type' => 'textarea', 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <?php if ($savant->subjects): ?>
        <?php foreach ($savant->subjects as $k => $v): ?>
            <div class="form-group">
                <label class="col-md-2 control-label">话题<?= $k + 1 ?></label>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">标题</label>
                <div class="col-md-8">
                    <input type="text" name="title" class="form-control" id="title" disabled value="<?= $v['title'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">话题简介</label>
                <div class="col-md-8">
                    <textarea name="title" class="form-control" id="title" disabled ><?= $v['summary'] ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">类型</label>
                <div class="col-md-8">
                    <input type="text" name="title" class="form-control" id="title" disabled value="<?php
                    switch ($v['type']) {
                        case 1: echo '一对一';
                            break;
                        case 2: echo '一对多';
                            break;
                    }
                    ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">约见时间</label>
                <div class="col-md-8">
                    <input type="text" name="title" class="form-control" id="title" disabled value="<?= $v['invite_time'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">价格</label>
                <div class="col-md-8">
                    <input type="text" name="title" class="form-control" id="title" disabled value="<?= $v['price'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">地址</label>
                <div class="col-md-8">
                    <input type="text" name="title" class="form-control" id="title" disabled value="<?= $v['address'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">持续时间</label>
                <div class="col-md-8">
                    <input type="text" name="title" class="form-control" id="title" disabled value="<?= $v['last_time'] ?>小时">
                </div>
            </div>
    <?php endforeach; ?>
<?php endif; ?>
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
        initJqupload('cover', '/wpadmin/util/doUpload?dir=savant/cover', 'jpg,png,gif,jpeg'); //初始化图片上传
        //var ue = UE.getEditor('content'); //初始化富文本编辑器
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一位用户'
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
                                window.location.href = '/admin/savant/index';
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
