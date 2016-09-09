<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <form id="bgmj" class="form-horizontal">
        <div class="form-group">
            <label class="col-md-2 control-label">并购买家</label>
            <div class="col-md-8">
                <div>
                <?= $this->cell('Agency::multi',[$conf['bgmj']['agency']]) ?>
                </div>
                <div class="mt20">
                <?= $this->cell('Industry',[$conf['bgmj']['industry']]) ?>
                </div>
            </div>
        </div>
    </form>
    <form id="cytz" class="form-horizontal">
        <div class="form-group">
            <label class="col-md-2 control-label">产业投资</label>
            <div class="col-md-8">
                <div>
                <?= $this->cell('Agency::multi',[$conf['cytz']['agency']]) ?>
                </div>
                <div class="mt20">
                <?= $this->cell('Industry',[$conf['cytz']['industry']]) ?>
                </div>
            </div>
        </div>
    </form>
    <form id="bgrz" class="form-horizontal">
        <div class="form-group">
            <label class="col-md-2 control-label">并购融资</label>
            <div class="col-md-8">
                <div>
                <?= $this->cell('Agency::multi',[$conf['bgrz']['agency']]) ?>
                </div>
                <div class="mt20">
                <?= $this->cell('Industry',[$conf['bgrz']['industry']]) ?>
                </div>
            </div>
        </div>
    </form>
    <form id="bggw" class="form-horizontal">
        <div class="form-group">
            <label class="col-md-2 control-label">并购顾问</label>
            <div class="col-md-8">
                <div>
                <?= $this->cell('Agency::multi',[$conf['bggw']['agency']]) ?>
                </div>
                <div class="mt20">
                <?= $this->cell('Industry',[$conf['bggw']['industry']]) ?>
                </div>
            </div>
        </div>
    </form>
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
        initJqupload('card_path', '/wpadmin/util/doUpload?dir=/user/mp', 'jpg,png,gif,jpeg'); //初始化图片上传
        $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
        $('.select-agency').select2({
            language: "zh-CN",
            placeholder: '选择一个机构标签'
        });
        $('.select-industry').select2({
            language: "zh-CN",
            placeholder: '选择一个行业标签'
        });
        $('#submit').click(function () {
            var bggw = $('#bggw').serializeArray();
            var bgmj = $('#bgmj').serializeArray();
            var cytz = $('#cytz').serializeArray();
            var bgrz = $('#bgrz').serializeArray();
            data = {bggw:bggw,bgmj:bgmj,cytz:cytz,bgrz:bgrz};
            $.ajax({
                type:'post',
                url: '',
                data: data,
                dataType: 'json',
                success: function (res) {
                    if (typeof res === 'object') {
                        if (res.status) {
                            layer.confirm(res.msg, {
                                btn: ['确认', '继续添加'] //按钮
                            }, function () {
                                window.location.href = '/admin/set/index';
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
