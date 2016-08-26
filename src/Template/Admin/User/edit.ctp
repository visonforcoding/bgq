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
            <?= $this->Form->create($user, ['class' => 'form-horizontal', 'id' => 'profile']) ?>
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
                <label class="col-md-2 control-label">负责人</label>
                <div class="col-md-8">
                    <?= $this->cell('Admin', [[$user->admin_id]]) ?>
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
                    <?= $this->cell('Region::base', [$user->city]) ?>
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
            <?php if ($user->careers): ?>
                <?php $k = 1; ?>
                <?php foreach ($user->careers as $career): ?>
                    <div class="career">
                        <div class="input-group col-md-8 col-md-offset-1 mt20">
                            <span class="input-group-addon">公司</span>
                            <input type="text" name="company" value="<?= $career->company ?>" class="form-control" placeholder="2009-9">
                            <span class="input-group-addon">职位</span>
                            <input type="text" name="position" value="<?= $career->position ?>" class="form-control" placeholder="2009-9">
                            <span class="input-group-addon">开始时间</span>
                            <input type="text" name="start_date" value="<?= $career->start_date ?>" class="form-control" placeholder="2009-9">
                            <span class="input-group-addon">结束时间</span>
                            <input type="text" name="end_date" value="<?= $career->end_date ?>" class="form-control" placeholder="经济管理">
                        </div>
                        <div class="input-group col-md-8 col-md-offset-1 mt20">
                            <span class="input-group-addon">工作描述</span>
                            <input type="text" name="descb" value="<?= $career->descb ?>" class="form-control" placeholder="经济管理">
                            <span data-id="<?= $career->id ?>" class="input-group-addon del"><i style="color:blue" class="icon icon-trash"></i></span>
                            <span data-id="<?= $career->id ?>" class="input-group-addon save"><i style="color:blue" class="icon icon-save"></i></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="career">
                <div class="input-group col-md-8 col-md-offset-1 mt20">
                    <span class="input-group-addon">公司</span>
                    <input type="text" name="company"  class="form-control" >
                    <span class="input-group-addon">职位</span>
                    <input type="text" name="position"  class="form-control" >
                    <span class="input-group-addon">开始时间</span>
                    <input type="text" name="start_date"  class="form-control" >
                    <span class="input-group-addon">结束时间</span>
                    <input type="text" name="end_date"  class="form-control" >
                </div>
                <div class="input-group col-md-8 col-md-offset-1 mt20">
                    <span class="input-group-addon">工作描述</span>
                    <input type="text" name="descb"  class="form-control" >
                    <span class="input-group-addon add"><i style="color:blue" class="icon icon-plus-sign"></i></span>
                </div>
            </div>
        </div>
        <div class="tab-pane in " id="tab3">
            <?php $educationConf = \Cake\Core\Configure::read('educationType'); ?>
            <?php if ($user->educations): ?>
                <?php $k = 1; ?>
                <?php foreach ($user->educations as $education): ?>
                    <div class="education input-group col-md-8 col-md-offset-1 mt20">
                        <span class="input-group-addon">开始时间</span>
                        <input type="text" name="start_date" value="<?= $education->start_date ?>" class="form-control" placeholder="2009-9">
                        <span class="input-group-addon">结束时间</span>
                        <input type="text" name="end_date" value="<?= $education->end_date ?>" class="form-control" placeholder="2009-9">
                        <span class="input-group-addon">学校</span>
                        <input type="text" name="school" value="<?= $education->school ?>" class="form-control" placeholder="2009-9">
                        <span class="input-group-addon">专业</span>
                        <input type="text" name="major" value="<?= $education->major ?>" class="form-control" placeholder="经济管理">
                        <span class="input-group-addon">学历</span>
                        <?php echo $this->form->select('education', $educationConf, ['class' => 'form-control', 'value' => $education->education]) ?>
                        <span data-id="<?= $education->id ?>" class="input-group-addon del"><i style="color:blue" class="icon icon-trash"></i></span>
                        <span data-id="<?= $education->id ?>" class="input-group-addon save"><i style="color:blue" class="icon icon-save"></i></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="education input-group col-md-8 col-md-offset-1 mt20">
                <span class="input-group-addon">开始时间</span>
                <input type="text"  name="start_date" class="form-control" placeholder="2009-9">
                <span class="input-group-addon">结束时间</span>
                <input type="text" name="end_date" class="form-control" placeholder="2013-6">
                <span class="input-group-addon">学校</span>
                <input type="text" name="school" class="form-control" placeholder="X大学">
                <span class="input-group-addon">专业</span>
                <input type="text" name="major" class="form-control" placeholder="经济管理">
                <span class="input-group-addon">学历</span>
                <?php echo $this->form->select('education', $educationConf, ['class' => 'form-control']) ?>
                <span class="input-group-addon add"><i style="color:blue" class="icon icon-plus-sign"></i></span>
            </div>
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
            $('#select-admin').select2({
                language: "zh-CN",
                placeholder: '选择一个管理员作为负责人'
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
            $('.education .del').click(function () {
                var id = $(this).data('id');
                $.getJSON('/admin/user/delEducation', {'id': id}, function (res) {
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
                });
            });
            $('.career .del').click(function () {
                var id = $(this).data('id');
                $.getJSON('/admin/user/delCareer', {'id': id}, function (res) {
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
                });
            });
            $('.education .add').click(function () {
                var form = $(this).parent('.input-group');
                var formdata = {};
                formdata['start_date'] = $(form).find('input[name="start_date"]').val();
                formdata['end_date'] = $(form).find('input[name="end_date"]').val();
                formdata['school'] = $(form).find('input[name="school"]').val();
                formdata['major'] = $(form).find('input[name="major"]').val();
                formdata['education'] = $(form).find('select[name="education"]').val();
                $.ajax({
                    type: 'post',
                    url: '/admin/user/addEducation/' +<?= $user->id ?>,
                    data: formdata,
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
            $('.career .add').click(function () {
                var form = $(this).parents('.career');
                var formdata = {};
                formdata['company'] = $(form).find('input[name="company"]').val();
                formdata['position'] = $(form).find('input[name="position"]').val();
                formdata['start_date'] = $(form).find('input[name="start_date"]').val();
                formdata['end_date'] = $(form).find('input[name="end_date"]').val();
                formdata['descb'] = $(form).find('input[name="descb"]').val();
                $.ajax({
                    type: 'post',
                    url: '/admin/user/addCareer/' +<?= $user->id ?>,
                    data: formdata,
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
            $('.career .save').click(function () {
                var id = $(this).data('id');
                var form = $(this).parents('.career');
                var formdata = {};
                formdata['company'] = $(form).find('input[name="company"]').val();
                formdata['position'] = $(form).find('input[name="position"]').val();
                formdata['start_date'] = $(form).find('input[name="start_date"]').val();
                formdata['end_date'] = $(form).find('input[name="end_date"]').val();
                formdata['descb'] = $(form).find('input[name="descb"]').val();
                $.ajax({
                    type: 'post',
                    url: '/admin/user/saveCareer/' + id,
                    data: formdata,
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
            $('.education .save').click(function () {
                var id = $(this).data('id');
                var form = $(this).parent('.input-group');
                var formdata = {};
                formdata['start_date'] = $(form).find('input[name="start_date"]').val();
                formdata['end_date'] = $(form).find('input[name="end_date"]').val();
                formdata['school'] = $(form).find('input[name="school"]').val();
                formdata['major'] = $(form).find('input[name="major"]').val();
                formdata['education'] = $(form).find('select[name="education"]').val();
                $.ajax({
                    type: 'post',
                    url: '/admin/user/saveEducation/' + id,
                    data: formdata,
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
    