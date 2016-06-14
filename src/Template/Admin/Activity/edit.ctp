<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($activity, ['class' => 'form-horizontal']) ?>
    <?php if($activity->is_check == 2): ?>
    	<div class="form-group">
            <label class="col-md-2 control-label">未通过审核理由</label>
            <div class="col-md-8">
                <?php
                echo $this->Form->input('reason', ['label' => false, 'class' => 'form-control']);
                ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label class="col-md-2 control-label">作者id</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('admin_id', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">行业标签</label>
        <div class="col-md-8">
            <?= $this->cell('Industry',[$selIndustryIds]) ?>
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
        <label class="col-md-2 control-label">活动时间（3.2~4.1）</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('time', ['label' => false, 'class' => 'form-control']);
            ?>
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
        <label class="col-md-2 control-label">阅读数</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('read_nums', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">点赞数</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('praise_nums', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">评论数</label>
        <div class="col-md-8">
        <?php
            echo $this->Form->input('comment_nums', ['label' => false, 'class' => 'form-control']);
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
            <?= $this->cell('Savant',[$selSavantIds]); ?>
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
                <img  alt="封面图片" src="<?= $activity->cover; ?>"/>
            </div>
            <input name="cover" value="<?= $activity->cover; ?>"  type="hidden"/>
            <div id="cover"   class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">内容</label>
        <div class="col-md-8">
            <script name='body' id='body' rows='3' type="text/plain" class='form-control-editor'><?= $activity->body ?></script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">摘要</label>
        <div class="col-md-8">
            <script name='summary' id='summary' rows='3' type="text/plain" class='form-control-editor'><?= $activity->summary ?></script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">参与嘉宾</label>
        <div class="col-md-8">
            <script name='guest' id='guest' rows='3' type="text/plain" class='form-control-editor'><?= $activity->guest ?></script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">创建时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('create_time', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">更新时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('update_time', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <input type='submit' id='submit' class='btn btn-primary' value='保存' data-loading='稍候...' />
            <a href="/admin/activitycom/index/<?= $activity->id; ?>" id='' class='btn btn-primary' data-loading='稍候...'>评论详情</a>
            <a href="/admin/likeLogs/index/<?= $activity->id; ?>" id='' class='btn btn-primary' data-loading='稍候...'>点赞日志</a>
            <a href="/admin/collectLogs/index/<?= $activity->id; ?>" id='' class='btn btn-primary' data-loading='稍候...'>收藏日志</a>
            <a href="/admin/activityapply/index/<?= $activity->id; ?>" id='' class='btn btn-primary' data-loading='稍候...'>报名用户</a>
            <a href="/admin/sponsor/index/<?= $activity->id; ?>" id='' class='btn btn-primary' data-loading='稍候...'>赞助详情</a>
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
    	initJqupload('cover', '/wpadmin/util/doUpload?dir=newscover', 'jpg,png,gif,jpeg'); //初始化图片上传
        var ue = UE.getEditor('body'); //初始化富文本编辑器
        UE.getEditor('summary');
        UE.getEditor('guest');
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
                            layer.alert(res.msg, function () {
                                window.location.href = '/admin/activity/index';
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
