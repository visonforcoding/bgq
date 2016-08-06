<?php $this->start('static') ?>
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($activity, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">系列标签</label>
        <div class="col-md-8">
            <?= $this->cell('Series') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">行业标签</label>
        <div class="col-md-8">
            <?= $this->cell('Industry') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">作者</label>
        <div class="col-md-8">
            <?= $this->cell('User', [[$activity->user_id]]) ?>
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
        <div class="col-md-3">
            <?php
            echo $this->Form->input('time', ['label' => false,'type'=>'text', 'class' => 'datetimepicker form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">报名截止时间</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('apply_end_time', ['label' => false,'type'=>'text', 'class' => 'form-control datetimepicker']);
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
            echo $this->Form->input('scale', ['label' => false,'type'=>'text', 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">是否需要报名审核</label>
        <div class="col-md-8">
            <label class="radio-inline"> <input name="must_check" value="0"  checked="checked" type="radio"> 不需要</label>
            <label class="radio-inline"> <input name="must_check" value="1"   type="radio"> 需要 </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">专家推荐</label>
        <div class="col-md-8">
            <?= $this->cell('Savant') ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">活动推荐</label>
        <div class="col-md-8">
            <?=$this->cell('ActivityRecommend')?>
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
        <label class="col-md-2 control-label">首页列表图</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传宽为380大小的首页列表图" src=""/>
            </div>
            <div style="color:red">请上传宽为380大小的首页列表图</div>
            <input name="thumb"  type="hidden"/>
            <div id="thumb" class="jqupload">上传</div>
            <span class="notice">支持格式jpg,png,gif,jpeg</span>
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
            <div id="cover" class="jqupload">上传</div>
            <span class="notice">支持格式jpg,png,gif,jpeg</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">活动内容</label>
        <div class="col-md-8">
            <script name='body' id='content' rows='3' type="text/plain" class='form-control-editor'>
                <p>流程介绍：</p>
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
<script>
    $(function () {
        initJqupload('cover', '/wpadmin/util/doUpload?dir=activitycover', 'jpg,png,gif,jpeg'); //初始化图片上传
        initJqupload('thumb', '/wpadmin/util/doUpload?dir=activitythumb', 'jpg,png,gif,jpeg'); //初始化图片上传
        var ue = UE.getEditor('content'); //初始化富文本编辑器
        UE.getEditor('summary');
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个发起人'
        });
        $('#select-series').select2({
            language: "zh-CN",
            placeholder: '选择一个标签'
        });
        var industrySelect2 = $('#select-industry').select2({
            language: "zh-CN",
            placeholder: '选择一个标签'
        });
        var industrySelect2 = $('#select-activity').select2({
            language: "zh-CN",
            placeholder: '选择一个活动'
        });
        var savantSelect2 = $('#select-savant').select2({
            language: "zh-CN",
            placeholder: '选择一位专家'
        });
        $('#select-industry').on('change', function (evt) {
            var selOption = industrySelect2.val();
            var changIds = [];
            $.get('/admin/savant/get-random-savants', {'tags': selOption}, function (res) {
                console.log(res);
                changIds = res.ids;
                savantSelect2.val(changIds).trigger('change'); //set the value
            }, 'json');
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
