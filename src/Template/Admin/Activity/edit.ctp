<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($activity, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">活动名称</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('title', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">系列标签</label>
        <div class="col-md-8">
            <?= $this->cell('Series', [$activity->series_id]) ?>
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
    <?php if (is_array($orgs)&&$orgs): ?>
        <?php foreach ($orgs as $org): ?>
            <div class="form-group xb">
                <label class="col-md-2 control-label">协办</label>
                <div class="input-group col-md-6">
                    <span class="input-group-addon">单位</span>
                    <input type="text" name="org_key[]" value="<?= $org['org_key'] ?>" class="form-control" />
                    <span  class="input-group-addon">名称</span>
                    <input type="text" name="org_val[]" value="<?= $org['org_val'] ?>" class="form-control">
                    <span title="删除" class="input-group-addon del"><i style="color:blue" class="icon icon-trash"></i></span>
                    <span title="添加" class="input-group-addon add"><i style="color:blue" class="icon icon-plus-sign"></i></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
    <div class="form-group xb">
        <label class="col-md-2 control-label">协办</label>
        <div class="input-group col-md-6">
            <span class="input-group-addon">单位</span>
            <input type="text" name="org_key[]"  class="form-control" />
            <span  class="input-group-addon">名称</span>
            <input type="text" name="org_val[]" class="form-control">
            <span title="删除" class="input-group-addon del"><i style="color:blue" class="icon icon-trash"></i></span>
            <span title="添加" class="input-group-addon add"><i style="color:blue" class="icon icon-plus-sign"></i></span>
        </div>
    </div>
    <?php endif;?>
    <div class="form-group">
        <label class="col-md-2 control-label">活动时间</label>
        <div class="col-md-3">
            <?php
            echo $this->Form->input('activity_time', ['label' => false, 'type' => 'text','class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">过期时间</label>
        <div class="col-md-8">
            <input type="text" class="form-control datepicker" value="<?= $activity->time->format('Y-m-d') ?>" name="time" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">报名时间</label>
        <div class="input-group col-md-6">
            <span class="input-group-addon">开始时间</span>
            <input type="text" class="form-control" value="<?= date('Y-m-d H:i', $activity->apply_start_time) ?>" name="apply_start_time" />
            <span  class="input-group-addon">结束时间</span>
            <input type="text" class="form-control" value="<?= date('Y-m-d H:i', $activity->apply_end_time) ?>" name="apply_end_time" />
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
        <label class="col-md-2 control-label">是否需要报名审核</label>
        <div class="col-md-8">
            <label class="radio-inline"> <input name="must_check" value="0" <?php if ($activity->must_check == 0): ?> checked="checked"<?php endif; ?>  type="radio"> 不需要</label>
            <label class="radio-inline"> <input name="must_check" value="1" <?php if ($activity->must_check == 1): ?> checked="checked"<?php endif; ?>  type="radio"> 需要 </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">是否显示报名人</label>
        <div class="col-md-8">
            <label class="radio-inline"> <input name="is_show_apply" value="0" <?php if ($activity->is_show_apply == 0): ?> checked="checked"<?php endif; ?>  type="radio"> 否</label>
            <label class="radio-inline"> <input name="is_show_apply" value="1" <?php if ($activity->is_show_apply == 1): ?> checked="checked"<?php endif; ?>  type="radio"> 是 </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">是否可以开发票</label>
        <div class="col-md-8">
            <label class="radio-inline"> <input name="is_invoice" value="0" <?php if ($activity->is_invoice == 0): ?> checked="checked"<?php endif; ?>  type="radio"> 否</label>
            <label class="radio-inline"> <input name="is_invoice" value="1" <?php if ($activity->is_invoice == 1): ?> checked="checked"<?php endif; ?>  type="radio"> 是 </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">活动推荐</label>
        <div class="col-md-8">
            <?= $this->cell('ActivityRecommend', [$selActivityIds]); ?>
        </div>
    </div>
<!--    <div class="form-group">
        <label class="col-md-2 control-label">单人费用</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('apply_fee', ['label' => false, 'class' => 'form-control']);
            ?>
            <span style="color:red">（请注意：从免费改为付费会导致已报名的人去付款时会报错；三人行有费用时，单人费用不可为0）</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">多人费用</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('triple_fee', ['label' => false, 'class' => 'form-control']);
            ?>
            <span style="color:red">（请注意：从免费改为付费会导致已报名的人去付款时会报错；不填或填0，则该活动无三人行报名方式）</span>
        </div>
    </div>-->
    <div class="form-group">
        <label class="col-md-2 control-label">单人</label>
        <div class="input-group col-md-6">
            <span class="input-group-addon">费用</span>
            <?php
            echo $this->Form->input('apply_fee', ['label' => false, 'class' => 'form-control']);
            ?>
            <span class="input-group-addon">优惠费用</span>
            <?php
            echo $this->Form->input('bonus_fee', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">多人数量</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('multi_nums', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group multi hide">
        <label class="col-md-2 control-label">多人</label>
        <div class="input-group col-md-6">
            <span class="input-group-addon">费用</span>
            <?php
            echo $this->Form->input('triple_fee', ['label' => false, 'class' => 'form-control']);
            ?>
            <span  class="input-group-addon">优惠费用</span>
            <?php
            echo $this->Form->input('bonus_triple_fee', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">优惠时间</label>
        <div class="input-group col-md-6">
            <span class="input-group-addon">开始时间</span>
            <input type="text" name="bonus_start_time" class="form-control" value="<?= $activity->bonus_start_time ? $activity->bonus_start_time->format('Y-m-d H:i') : '' ?>" />
            <span  class="input-group-addon">结束时间</span>
            <input type="text" name="bonus_end_time" class="form-control" value="<?= $activity->bonus_end_time ? $activity->bonus_end_time->format('Y-m-d H:i') : '' ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">首页列表图</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传宽为380大小的首页列表图" src="<?= $activity->thumb; ?>"/>
            </div>
            <div style="color:red">请上传宽为380大小的首页列表图</div>
            <input name="thumb" value="<?= $activity->thumb; ?>"  type="hidden"/>
            <div id="thumb" w="380"   class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">封面</label>
        <div class="col-md-8">
            <div  class="img-thumbnail input-img"  single>
                <img  alt="请上传宽为690，高小于388的封面图" src="<?= $activity->cover; ?>"/>
            </div>
            <div style="color:red">请上传宽为690，高小于388的封面图</div>
            <input name="cover" value="<?= $activity->cover; ?>"  type="hidden"/>
            <div id="cover" w="690" h="388"   class="jqupload">上传</div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">摘要(活动介绍)</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('summary', ['label' => false, 'type' => 'textarea', 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">流程介绍</label>
        <div class="col-md-8">
            <script name='body' id='content' rows='2' type="text/plain" class='form-control-editor'><?= $activity->body ?></script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">联系方式</label>
        <div class="col-md-8">
            <script name='contact' id='contact' rows='2' type="text/plain" class='form-control-editor'><?= $activity->contact ?></script>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">参与嘉宾</label>
        <div class="col-md-8">
            <script name='guest' id='guest' rows='2' type="text/plain" class='form-control-editor'><?= $activity->guest ?></script>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">行业标签</label>
        <div class="col-md-8">
            <?= $this->cell('Industry', [$selIndustryIds]) ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">会员推荐</label>
        <div class="col-md-8">
            <?= $this->cell('Savant', [$selSavantIds]); ?>
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
//        var toolbars = [[
//                'source', '|', 'undo', 'redo', '|',
//                'bold', 'italic', 'underline', 'fontborder', 'strikethrough',
//                'pasteplain', '|', 'forecolor', 'backcolor',
//                'selectall', 'cleardoc', '|', 'rowspacingtop', //段前距
//                'rowspacingbottom', //段后距
//                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
//                'indent', '|',
//                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
//                'simpleupload', 'insertimage', 'emotion', 'background', '|', 'inserttable', //插入表格
//                'horizontal', 'spechars', 'wordimage',
//            ]];
        initJqupload('cover', '/wpadmin/util/doUpload?dir=activitycover', 'jpg,png,gif,jpeg'); //初始化图片上传
        initJqupload('thumb', '/wpadmin/util/doUpload?dir=activitythumb', 'jpg,png,gif,jpeg'); //初始化图片上传
        var ue = UE.getEditor('content'); //初始化富文本编辑器
        var contact = UE.getEditor('contact'); //初始化富文本编辑器
        var guest_UE = UE.getEditor('guest'); //初始化富文本编辑器
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-series').select2({
            language: "zh-CN",
            placeholder: '选择一个标签',
        });
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个用户'
        });
        $('#select-industry').select2({
            language: "zh-CN",
            placeholder: '选择一个标签'
        });
        $('.xb .add').click(function () {
            var obj = $(this).parents('div.xb').clone(true);
            $(obj).find('input').val('');
            $(this).parents('div.xb').after(obj);
        });
        $('.xb .del').click(function () {
            if($('div.xb').length <= 1){
                return;
            }
            $(this).parents('div.xb').remove();
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
            placeholder: '选择一位会员'
        });
        $('#select-activity').select2({
            language: "zh-CN",
            placeholder: '选择一个活动'
        });
        
        if($('input[name="multi_nums"]').val()){
            $('.multi').removeClass('hide');
        }
        $('input[name="multi_nums"]').on('input prototypechange', function(){
            if(parseInt($(this).val()) <= 1 || $(this).val() == 0){
                $('.multi').addClass('hide');
            } else {
                $('.multi').removeClass('hide');
            }
        });
        
        $('input[name="apply_start_time"]').datetimepicker({
            format: 'Y-m-d H:i',
//            onShow: function (ct) {
//                this.setOptions({
//                    maxDate: $('input[name="apply_end_time"]').val() ? $('input[name="apply_end_time"]').val() : false
//                });
//            },
            timepicker: true,
            lang:'zh'
        });
        $('input[name="apply_end_time"]').datetimepicker({
            format: 'Y-m-d H:i',
//            onShow: function (ct) {
//                this.setOptions({
//                   minDate: $('input[name="apply_start_time"]').val() ? $('input[name="apply_start_time"]').val() : false
//                });
//            },
            timepicker: true,
            lang:'zh'
        });
        $('input[name="bonus_start_time"]').datetimepicker({
            format: 'Y-m-d H:i',
//            onShow: function (ct) {
//                this.setOptions({
//                    maxDate: $('input[name="bonus_end_time"]').val() ? $('input[name="bonus_end_time"]').val() : false
//                });
//            },
            timepicker: true,
            lang:'zh'
        });
        $('input[name="bonus_end_time"]').datetimepicker({
            format: 'Y-m-d H:i',
//            onShow: function (ct) {
//                this.setOptions({
//                   minDate: $('input[name="bonus_start_time"]').val() ? $('input[name="bonus_start_time"]').val() : false
//                });
//            },
            timepicker: true,
            lang:'zh'
        });
        
        $('form').submit(function () {
            if(parseInt($('input[name="apply_fee"]').val()) < parseInt($('input[name="bonus_fee"]').val())){
                layer.alert('单人优惠价格高于平时价格');
                return false;
            }
            if(parseInt($('input[name="triple_fee"]').val()) < parseInt($('input[name="bonus_triple_fee"]').val())){
                layer.alert('多人优惠价格高于平时价格');
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
