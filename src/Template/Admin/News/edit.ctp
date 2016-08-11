<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($news, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">作者</label>
        <div class="col-md-8">
            <?= $this->cell('User', [[$news->user_id]]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">标题</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('title', ['label' => false, 'class' => 'form-control']);
            ?>
            <span class="notice">已输入<i><?= mb_strlen($news->title, 'utf8') ?></i>个字</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">关键字</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('keywords', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">来源</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('source', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">行业标签</label>
        <div class="col-md-8">
            <?= $this->cell('Industry::news', [$selIndustryIds]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">专家推荐</label>
        <div class="col-md-8">
            <?= $this->cell('Savant', [$selSavantIds]) ?>
            <span class="notice">(*最多选择4个)</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">资讯标签</label>
        <div class="col-md-8">
            <?= $this->cell('Newstag',[$selNewstagsIds]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">缩略图</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传160*160大小的缩略图" src="<?= $news->thumb; ?>"/>
            </div>
            <div style="color:red">请上传160*160大小的缩略图</div>
            <input name="thumb" value="<?= $news->thumb; ?>"  type="hidden"/>
            <div id="thumb"   class="jqupload">上传</div>
            <span class="notice">图片格式为jpg,png,gif,jpeg</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">封面</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传宽为690，高小于388的封面图" src="<?= $news->cover; ?>"/>
            </div>
            <div style="color:red">请上传宽为690，高小于388的封面图</div>
            <input name="cover" value="<?= $news->cover; ?>"  type="hidden"/>
            <div id="cover"   class="jqupload">上传</div>
            <span class="notice">图片格式为jpg,png,gif,jpeg</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">摘要</label>
        <div class="col-md-8">
            <textarea rows="3" name="summary" class="form-control"><?= $news->summary ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">内容</label>
        <div class="col-md-8">
            <script name='body' id='content' rows='3' type="text/plain" class='form-control-editor'><?= $news->body ?></script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">分享描述</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('share_desc', ['label' => false, 'class' => 'form-control']);
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
<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
<script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
<script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>
<script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
<script src="/wpadmin/lib/select2/js/i18n/zh-CN.js" ></script>
<script>
    $(function () {
        initJqupload('cover', '/wpadmin/util/doUpload?dir=newscover', 'jpg,png,gif,jpeg'); //初始化图片上传
        initJqupload('thumb', '/wpadmin/util/doUpload?dir=newsthumb', 'jpg,png,gif,jpeg'); //初始化图片上传
        var ue = UE.getEditor('content'); //初始化富文本编辑器
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个用户'
        });
        $('#select-industry').select2({
            language: "zh-CN",
            placeholder: '选择一个标签'
        });
        $('#select-newstag').select2({
            language: "zh-CN",
            placeholder: '选择一个资讯标签',
        });
        $('#select-savant').select2({
            language: "zh-CN",
            placeholder: '选择一个标签',
            maximumSelectionLength: 4
        });
        $('#title').keyup(function () {
            var len = $(this).val().length;
            $(this).next('span').find('i').text(len);
        });
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
                                window.location.href = '/admin/news/index';
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
