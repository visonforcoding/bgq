<?php $this->start('static') ?>   
<link href="/wpadmin/lib/jqupload/uploadfile.css" rel="stylesheet">
<link href="/wpadmin/lib/jqvalidation/css/validationEngine.jquery.css" rel="stylesheet">
<link href="/wpadmin/lib/select2/css/select2.min.css" rel="stylesheet">
<?php $this->end() ?> 
<div class="work-copy">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active">
            <a href="#tab1" data-toggle="tab">基础信息</a>
        </li>
        <li>
            <a href="#tab2" data-toggle="tab">工作经历</a>
        </li>
        <li>
            <a href="#tab3" data-toggle="tab">教育经历</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane in active" id="tab1">
            <?= $this->Form->create($user, ['class' => 'form-horizontal' ,'id'=>'profile']) ?>
            <div class="form-group mt20">
                <label class="col-md-2 control-label">手机号</label>
                <div class="col-md-8">
                    <?php
                    echo $this->Form->input('phone', ['label' => false, 'class' => 'form-control']);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">姓名</label>
                <div class="col-md-8">
                    <?php
                    echo $this->Form->input('truename', ['label' => false, 'class' => 'form-control']);
                    ?>
                </div>
            </div>
            <!--    <div class="form-group">
                    <label class="col-md-2 control-label">等级</label>
                    <div class="col-md-8">
                        <label class="radio-inline"> <input name="level" value="1" checked="checked"  type="radio"> 普通</label>
                        <label class="radio-inline"> <input name="level" value="2"  type="radio"> 专家 </label>
                    </div>
                </div>-->
            <div class="form-group">
                <label class="col-md-2 control-label">身份证</label>
                <div class="col-md-8">
                    <?php
                    echo $this->Form->input('idcard', ['label' => false, 'class' => 'form-control']);
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
                <label class="col-md-2 control-label">职位</label>
                <div class="col-md-8">
                    <?php
                    echo $this->Form->input('position', ['label' => false, 'class' => 'form-control']);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">邮箱</label>
                <div class="col-md-8">
                    <?php
                    echo $this->Form->input('email', ['label' => false, 'class' => 'form-control']);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">性别</label>
                <div class="col-md-8">
                    <label class="radio-inline"> <input name="gender" value="1" <?php if ($user->gender == 1): ?> checked="checked"<?php endif; ?>  type="radio"> 男</label>
                    <label class="radio-inline"> <input name="gender" value="2" <?php if ($user->gender == 2): ?> checked="checked"<?php endif; ?>  type="radio"> 女 </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">等级</label>
                <div class="col-md-8">
                    <label class="radio-inline"> <input name="grade" value="1" <?php if ($user->grade == 1): ?> checked="checked"<?php endif; ?>  type="radio"> 普通</label>
                    <label class="radio-inline"> <input name="grade" value="2" <?php if ($user->grade == 2): ?> checked="checked"<?php endif; ?>  type="radio"> 高级 </label>
                    <label class="radio-inline"> <input name="grade" value="3" <?php if ($user->grade == 3): ?> checked="checked"<?php endif; ?>  type="radio"> vip </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">机构标签</label>
                <div class="col-md-8">
                    <?= $this->cell('Agency', [$user->agency_id]) ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">上传名片</label>
                <div class="col-md-8">
                    <div  class="img-thumbnail input-img"  single>
                        <img  alt="封面图片" src="<?= $user->card_path ?>"/>
                    </div>
                    <input name="card_path" value="<?= $user->card_path ?>" type="hidden"/>
                    <div id="card_path" class="jqupload">上传</div>
                    <span class="notice">类型为jpg,png,gif,jpeg</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">常驻城市</label>
                <div class="col-md-8">
                    <?= $this->cell('Region::base',[$user->city])?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">擅长业务</label>
                <div class="col-md-8">
                    <textarea name="goodat" class="form-control" rows="2"><?= $user->goodat ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">项目经验</label>
                <div class="col-md-8">
                    <textarea name="ymjy" class="form-control" rows="2"><?= $user->ymjy ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">业务能力</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="ywnl" rows="2"><?= $user->ywnl ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input type='submit' id='submit' class='btn btn-primary' value='保存' data-loading='稍候...' /> 
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
        <div class="tab-pane in " id="tab2">
            <?php $k = 1; ?>
            <?php $educationConf = \Cake\Core\Configure::read('educationType'); ?>
            <?php foreach ($user->educations as $education): ?>
            <form  action="/admin/user/education" class="form-horizontal mt20 education" method="post">
                    <fieldset>
                        <legend>教育经历<?= $k ?></legend>
                        <?php $k++; ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label">开始时间</label>
                            <div class="col-md-3">
                                <input name="id"  value="<?= $education->id ?>" type="hidden" class="form-control">
                                <input name="start_date" value="<?= $education->start_date ?>" class="datepicker form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">结束时间</label>
                            <div class="col-md-3">
                                <input name="end_date" value="<?= $education->start_date ?>" class="datepicker form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">毕业院校</label>
                            <div class="col-md-3">
                                <input name="school" value="<?= $education->school ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">专业</label>
                            <div class="col-md-3">
                                <input name="major" value="<?= $education->major ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">学历</label>
                            <div class="col-md-3">
                                <select name="education" class="form-control">
                                    <?php foreach ($educationConf as $key=>$value): ?>
                                    <option value="<?=$key?>" <?php if($key==$education->education):?>selected="selected"<?php endif;?>><?=$value?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <input type='submit' id='submit' class='btn btn-primary' value='保存' data-loading='稍候...' /> 
                            </div>
                        </div>
                    </fieldset>
                </form>
            <?php endforeach; ?>
        </div>
    </div>

    <?php $this->start('script'); ?>
    <script type="text/javascript" src="/wpadmin/lib/jqform/jquery.form.js"></script>
    <script type="text/javascript" src="/wpadmin/lib/jqupload/jquery.uploadfile.js"></script>
    <script type="text/javascript" src="/wpadmin/lib/jqvalidation/js/languages/jquery.validationEngine-zh_CN.js"></script>
    <script type="text/javascript" src="/wpadmin/lib/jqvalidation/js/jquery.validationEngine.js"></script>
    <script src="/wpadmin/lib/select2/js/select2.full.min.js" ></script>
    <script>
        $(function () {
            initJqupload('card_path', '/admin/util/doUpload', 'jpg,png,gif,jpeg'); //初始化图片上传
            $('form').validationEngine({focusFirstField: true, autoPositionUpdate: true, promptPosition: "bottomRight"});
            $('#select-agency').select2({
                language: "zh-CN",
                placeholder: '选择一个标签'
            });
            $('#profile').submit(function () {
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
                                    window.location.href = '/admin/user/index';
                                });
                            } else {
                                layer.alert(res.msg, {icon: 5});
                            }
                        }
                    }
                });
                return false;
            });
            $('.education').submit(function(){
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
                                   // window.location.href = '/admin/user/index';
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
    