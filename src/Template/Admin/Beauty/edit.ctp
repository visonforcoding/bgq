<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/wpadmin/lib/lightbox/css/lightbox-rotate.css">
<?php $this->end() ?> 
<div class="work-copy">
    <?= $this->Form->create($beauty, ['class' => 'form-horizontal']) ?>
    <div class="form-group">
        <label class="col-md-2 control-label">用户</label>
        <div class="col-md-8">
            <?= $this->cell('User', [[$beauty->user_id]]); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">票数</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('vote_nums', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">星座</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('constellation', ['type' => 'select', 'options' => [
                    '白羊座' => '白羊座',
                    '金牛座' => '金牛座',
                    '双子座' => '双子座',
                    '巨蟹座' => '巨蟹座',
                    '狮子座' => '狮子座',
                    '处女座' => '处女座',
                    '天秤座' => '天秤座',
                    '天蝎座' => '天蝎座',
                    '射手座' => '射手座',
                    '摩羯座' => '摩羯座',
                    '水瓶座' => '水瓶座',
                    '双鱼座' => '双鱼座',
                ], 'label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 control-label">类型</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('type_id', ['type'=>'select', 'options'=>$votingType, 'label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">参赛宣言</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('declaration', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">兴趣爱好</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('hobby', ['label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">个人简介</label>
        <div class="col-md-8">
            <?php
            echo $this->Form->input('brief', ['type' => 'textarea', 'label' => false, 'class' => 'form-control']);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">项目经验</label>
        <div class="col-md-8">
            <textarea name="xmjy" class="form-control" maxlength="150" id="xmjy" rows="5"><?= $savant->xmjy ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">照片</label>
        <div class="col-md-8 cards cards-borderless">
            <?php foreach ($beauty->beauty_pics as $k => $v): ?>
                <div style="width:200px;height:200px;" class="pic col-md-3 col-sm-6 col-lg-3">
                    <a class="card" href="<?= str_replace('small_', '', $v['pic_url']) ?>" data-lightbox="roadtrip">
                        <img src="<?= $v['pic_url'] ?>" alt="">
                        <div data-id="<?= $v->id ?>"  class="del-pic card-heading"><strong><i class="icon icon-trash"></i>删除</strong></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2 col-sm-6 col-lg-3 col-md-offset-2">
            <a class="card" href="">
                <img src="" alt="">
                <div data-id="<?= $beauty->user_id ?>" id="pic"  class="add-pic card-heading"><strong><i class="icon icon-trash"></i></strong></div>
            </a>
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
<script src="/wpadmin/lib/jqueryrotate.js"></script>
<script src="/wpadmin/lib/lightbox/js/lightbox-rotate.js"></script>
<!--<script src="/wpadmin/lib/ueditor/ueditor.config.js" ></script>
<script src="/wpadmin/lib/ueditor/ueditor.all.js" ></script>
<script href="/wpadmin/lib/ueditor/lang/zh-cn/zh-cn.js" ></script>    -->
<script>
    $(function () {
        // initJqupload('cover', '/wpadmin/util/doUpload', 'jpg,png,gif,jpeg'); //初始化图片上传
        //var ue = UE.getEditor('content'); //初始化富文本编辑器
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('#select-user').select2({
            language: "zh-CN",
            placeholder: '选择一个用户'
        });
        var uploadObj = $('#pic').uploadFile({
            url: '/admin/beauty/uploadpic/<?= $beauty->user_id ?>',
            returnType: 'json',
            maxFileCount: 1,
            allowedTypes: 'jpg,png,gif,jpeg',
            doneStr: "上传完成",
            dragDrop: false,
            multiple: false,
            showDone: true,
            uploadStr: "添加照片",
            showStatusAfterSuccess: false,
            maxFileCountErrorStr: "不被允许,允许的最大数量为",
            dragDropStr: "<span><b>试试拖动文件上传</b></span>",
            extErrorStr: "类型不允许,允许类型如下:",
            multiDragErrorStr: '这里只能一次上传一张',
            customErrorKeyStr: '上传发生了错误',
            onSuccess: function (files, data, xhr, pd) {
                if (data.status) {
                    layer.msg(data.msg);
                    setTimeout(function () {
                        window.location.reload();
                    }, '1000');
                } else {
                    uploadObj.reset();
                    layer.alert(data.msg);
                }
            },
            onSelect: function (files)
            {
                uploadObj.reset();  //单个图片上传的 委曲求全的办法
            },
            onError: function (files, status, errMsg, pd) {
                console.log(status);
            }
        });
        $('.del-pic').on('click', function (event) {
            var id = $(this).data('id');
            var obj = $(this);
            $.getJSON('/admin/beauty/delpic', {id: id}, function (res) {
                if (res.status) {
                    layer.alert(res.msg);
                    obj.parents('div.pic').remove();
                }
            });
            return false;
        })
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
                                window.location.href = '/admin/beauty/index';
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
