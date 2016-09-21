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
            <?= $this->cell('User') ?>
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
        <label class="col-md-2 control-label">发布时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('publish_time', ['label' => false, 'type' => 'text', 'value' => date('Y-m-d H:i:s'), 'class' => 'form-control datetimepicker']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">资讯标签</label>
        <div class="col-md-8">
            <?= $this->cell('Newstag') ?>
            <span class="notice">(*最多只能选4个)</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">缩略图</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传160*160大小的缩略图" src=""/>
            </div>
            <div style="color:red">请上传160*160大小的缩略图</div>
            <input name="thumb"  type="hidden"/>
            <div id="thumb" w="160" h="160" class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">封面</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传宽为690，高小于388的封面图" src=""/>
            </div>
            <div style="color:red">请上传宽为690，高小于388的封面图</div>
            <input name="cover"  type="hidden"/>
            <div id="cover" w="690" h="388" class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">摘要</label>
        <div class="col-md-8">
            <textarea rows="3" name="summary" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">内容</label>
        <div class="col-md-8">
            <script name='body' id='content' rows='3' type="text/plain" class='form-control-editor'></script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">多媒体</label>
        <div class="col-md-8">
            <?=
            $this->form->radio('is_media', [
                ['value' => '0', 'text' => '无', 'checked' => 'true'],
                ['value' => '1', 'text' => '视频'],
                ['value' => '2', 'text' => '音频'],
            ])
            ?>
        </div>
    </div>
    <div class="form-group media video hide">
        <label class="col-md-2 control-label">视频</label>
        <div class="col-md-8">
            <input name="video" type="text" readonly class="form-control" />
            <div id="video" class="jqupload"></div>
            <span class="notice">(*文件大小在100M以内,支持格式为mp4、m4v)</span>
            <div class="row">
                <div  class="img-thumbnail input-img"  single>
                    <img  alt="这里上传视频的封面" src=""/>
                </div>
                <div style="color:red">这里上传视频的封面</div>
                <input name="video_cover"  type="hidden"/>
                <div id="video_cover" class="jqupload">上传</div>
            </div>
        </div>
    </div>
    <div class="form-group media audio hide">
        <label class="col-md-2 control-label">音频</label>
        <div class="col-md-8">
            <input name="mp3" type="text" readonly class="form-control" />
            <div id="mp3"  class="jqupload"></div>
            <span class="notice" style=" display: block">(*文件大小在30M以内,支持格式为mp3)</span>
            <div class="col-md-8 form-group mt10">
                <label style=" display: inline-block;">音频标题</label>
                <input name="mp3_title" type="text"  placeholder="音频标题" class="inner-input" />
            </div>
        </div>
    </div>
    <div class="form-group media pos hide">
        <label class="col-md-2 control-label">多媒体位置</label>
        <div class="col-md-8">
            <?=
            $this->form->radio('media_pos', [
                ['value' => '1', 'text' => '顶部', 'checked' => true],
                ['value' => '2', 'text' => '底部'],
            ])
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">行业标签</label>
        <div class="col-md-8">
            <?= $this->cell('Industry') ?>
            <span class="notice">(用于会员推荐)</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">会员推荐</label>
        <div class="col-md-8">
            <?= $this->cell('Savant') ?>
            <span class="notice">(*最多只能选4个)</span>
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
<script src="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>
<script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
<script src="/wpadmin/lib/select2/js/i18n/zh-CN.js" ></script>
<script>
    $(function () {
        initJqupload('cover', '/wpadmin/util/doUpload?dir=newscover', 'jpg,png,gif,jpeg'); //初始化图片上传
        initJqupload('thumb', '/wpadmin/util/doUpload?dir=newsthumb', 'jpg,png,gif,jpeg'); //初始化图片上传
        initJqupload('video_cover', '/wpadmin/util/doUpload?dir=news/videocover', 'jpg,png,gif,jpeg'); //初始化图片上传
        initJquploadAttach('mp3', '/wpadmin/util/doUpload?dir=news/mp3', 'mp3'); //初始化附件上传
        initJquploadAttach('video', '/wpadmin/util/doUpload?dir=news/video', 'mp4,m4v'); //初始化附件上传
        var ue = UE.getEditor('content'); //初始化富文本编辑器
        $('#title').keyup(function () {
            var len = $(this).val().length;
            $(this).next('span').find('i').text(len);
        });
        $('input[name="is_media"]').on('change', function () {
            $('div.form-group.media').addClass('hide');
            var is_media = $(this).val();
            if (is_media == 1) {
                $('div.form-group.media.video,div.form-group.media.pos').removeClass('hide');
            }
            if (is_media == 2) {
                $('div.form-group.media.audio,div.form-group.media.pos').removeClass('hide');
            }
        });
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-industry').select2({
            language: "zh-CN",
            placeholder: '选择一个标签',
        });
        $('#select-newstag').select2({
            language: "zh-CN",
            placeholder: '选择一个资讯标签',
            maximumSelectionLength: 4
        });
        $('#select-industry').on('change', function (evt) {
            var selOption = $('#select-industry').val();
            var changIds = [];
            $.get('/admin/savant/get-random-savants', {'tags': selOption}, function (res) {
                changIds = res.ids;
                savantSelect2.val(changIds).trigger('change'); //set the value
            }, 'json');
        });
        var savantSelect2 = $('#select-savant').select2({
            language: "zh-CN",
            placeholder: '选择一个会员',
            maximumSelectionLength: 4
        });
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个用户'
        });
        $('form').submit(function () {
            var user_id = $('#select-user').val();
            var source = $('#source').val();
            if (user_id >0 && source) {
                layer.alert('作者和来源只能填一个', {icon: 5});
                return false;
            }
            if (!user_id && !source) {
                layer.alert('作者和来源必须填一个', {icon: 5});
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
                                window.location.href = '/admin/news/index';
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
