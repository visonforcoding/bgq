<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($flow, ['class' => 'form-horizontal']) ?>
             <div class="form-group">
            <label class="col-md-2 control-label">用户</label>
                <div class="col-md-8">
                <?php echo $this->Form->input('user_id', ['label' => false,'options' => $users,'class'=>'form-control']);?>
                      </div>
         </div>
            <div class="form-group">
        <label class="col-md-2 control-label">关联id</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('relate_id', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
        <div class="form-group">
        <label class="col-md-2 control-label">交易类型</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('type', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
        <div class="form-group">
        <label class="col-md-2 control-label">类型名称</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('type_msg', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
        <div class="form-group">
        <label class="col-md-2 control-label">是否收入1:收入2:支出</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('income', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
        <div class="form-group">
        <label class="col-md-2 control-label">交易金额</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('amount', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
        <div class="form-group">
        <label class="col-md-2 control-label">交易前金额</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('pre_amount', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
        <div class="form-group">
        <label class="col-md-2 control-label">交易后金额</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('after_amount', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
        <div class="form-group">
        <label class="col-md-2 control-label">交易状态</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('status', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
        <div class="form-group">
        <label class="col-md-2 control-label">备注</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('remark', ['label' => false, 'class' => 'form-control']);
            ?>
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
        <label class="col-md-2 control-label">修改时间</label>
        <div class="col-md-8">
                        <?php
            echo $this->Form->input('update_time', ['label' => false, 'class' => 'form-control']);
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
<!--<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
<script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
<script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>    -->
<script>
    $(function () {
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
                                window.location.href = '/admin/flow/index';
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
