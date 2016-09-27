<?php $this->start('css') ?>
<link rel="stylesheet" type="text/css" href="/mobile/css/mobiscroll.css"/>
<?php $this->end('css') ?>
<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            编辑个人主页
        </h1>
    </div>
</header>
<div class="wraper m-fixed-bottom">
    <form method="post">
        <ul class="h-info-box e-info-box max_width" id="pData">
            <li class='u-img no-right-ico'>
                <a href="javascript:void(0)">
                    <span class="e_img">头像：</span>
                    <div class="upload-user-img">
                        <span id="upload_pic" class='tx'><img src="<?= $user->avatar ? getSmallAvatar($user->avatar) : '/mobile/images/touxiang.png' ?>"/><input type="hidden" name="avatar" value="<?= $user->avatar ?>" ></span>
                    </div>
                </a>
            </li>
            <li class="no-right-ico">
                <a href="javascript:void(0)">
                    <span><i class="color-items">*</i>公司：</span>
                    <div>
                        <input type="company" name="company" value="<?= $user->company ?>" placeholder="请填写公司" />
                    </div>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <span><i class="color-items">*</i>性别：</span>
                    <div>
                        <span class='typeselect'>
                            <select name="gender" class='checkedsex' id="gender" style='height:.6rem;'>
                                <option value="1" <?php if ($user->gender == 1): ?>selected="selected"<?php endif; ?>>男</option>
                                <option value="2" <?php if ($user->gender == 2): ?>selected="selected"<?php endif; ?>>女</option>
                            </select>
                        </span>
                    </div>
                </a>
            </li>
            <li class="no-right-ico">
                <a href="javascript:void(0)">
                    <span><i class="color-items">*</i>部门职务：</span>
                    <div >
                        <input type="position" name="position" value="<?= $user->position ?>" placeholder="请填写部门职务" />
                    </div>
                </a>
            </li>
            <li class="no-right-ico">
                <a href="javascript:void(0)">
                    <span><i class="color-items">*</i>邮箱：</span>
                    <div>
                        <input type="email" name="email" value="<?= $user->email ?>" placeholder="请填写邮箱" />
                    </div>
                </a>
            </li>
            <li>
                <a href="/home/edit-card">
                    <span><i class="color-items">*</i>我的名片：</span>
                    <div>
                        <span class="mcard"><img src="<?= $user->card_path ?>" id="card" /></span>
                    </div>
                </a>
            </li>
        </ul>
        <!--    <ul class="h-info-box e-info-box max_width">
                <li class="no-right-ico">
                    <a href="javascript:void(0)">
                        <span>联系电话：</span>
                        <div>
                            <input type="phone" readonly value="<?= $user->phone ?>" />
                        </div>
                    </a>
                </li>
                <li class="no-right-ico">
                    <a href="javascript:void(0)">
                        <span>邮箱：</span>
                        <div>
                            <input type="email" name="email" value="<?= $user->email ?>" placeholder="请填写邮箱" />
                        </div>
                    </a>
                </li>
            </ul>-->
        <ul class="h-info-box e-info-box max_width">
            <li>
                <a href="/home/edit-industries">
                    <span><i class="color-items">*</i>行业：</span>
                    <div>
                        <span id="industry"></span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/home/edit-agencies">
                    <span><i class="color-items">*</i>机构：</span>
                    <div>
                        <span id="agency"></span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/home/edit-city">
                    <span><i class="color-items">*</i>所在地：</span>
                    <div>
                        <span id="city">
                            <?php if (!$user->city): ?>
                                未完善
                            <?php endif; ?>
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/home/my-business">
                    <span><i class="color-items">*</i>擅长业务：</span>
                    <div>
                        <span id="goodat">
                            <?php if (!$user->goodat): ?>
                                未完善
                            <?php endif; ?>
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/home/edit-company-business">
                    <span><i class="color-items">*</i>公司业务：</span>
                    <div>
                        <span id="gsyw">
                            <?php if (!$user->gsyw): ?>
                                未完善
                            <?php endif; ?>
                        </span>
                    </div>
                </a>
            </li>

        </ul>
<!--        <ul class="h-info-box e-info-box max_width">
            
        </ul>-->
        <ul class="h-info-box e-info-box max_width">
            <li>
                <a href="/home/edit-education">
                    <span>教育经历：</span>
                    <div>
                        <span id="educations">
                            <?php if (!$user->educations): ?>
                                未完善(选填)
                            <?php endif; ?>
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="/home/edit-work">
                    <span>工作经历：</span>
                    <div>
                        <span id="careers">
                            <?php if (!$user->careers): ?>
                                未完善（选填）
                            <?php endif; ?>
                        </span>
                    </div>
                </a>
            </li>
            <li class="nobottom">
                <a href="/home/edit-mark">
                    <span>个人标签：</span>
                    <div>
                        <span id="grbq">
                            <?php if (!$user->grbq): ?>
                                未完善(选填)
                            <?php endif; ?>
                        </span>
                    </div>
                </a>
            </li>
        </ul>
    </form>
    <!--    <div style='height:1rem;'></div>
        <a id="submit" href="javascript:void(0);" class="f-bottom">完成</a>-->
</div>
<div class='reg-shadow' style="display: none;"></div>
<div class="shadow-info" style="display: none;">
    <div class="picinfo">
        <span>拍照</span>
        <span>相册</span>
    </div>
    <div class="picinfo">
        <span>取消</span>
    </div>
</div>

<script>
//    var ref = $.util.getParam('ref') ? $.util.getParam('ref') : '/home/index';
    LEMON.sys.back(document.referrer);
//    if($.util.isAPP){
//        if(document.URL.indexOf('#home') != -1){
//            LEMON.sys.back('/user/home-page/<?= $user->id ?>');
//        } else {
//            LEMON.sys.back('/home/index');
//        }
//    }


    $('#pData input').on('blur', function () {
        var name = this.name;
        var val = this.value;
        if (val == this.defaultValue)
            return;
        if (val == ''){
            $.util.alert('请填入内容');
            return;
        }
        this.defaultValue = val;
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/save-userinfo",
            data: {name: name, val: val},
            success: function (res) {
                $.util.alert(res.msg, 700);
            }
        });
    });

    $('#gender').on('change', function () {
        var name = $(this).get(0).name;
        var val = $(this).val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/save-userinfo",
            data: {name: name, val: val},
            success: function (res) {
                $.util.alert(res.msg, 700);
            }
        });
    });

    window.onBackView = function () {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/userinfo-status",
            success: function (res) {
                if (res.status) {
                    $('#city').html(res.data.city);
                    $('#goodat').html(res.data.goodat);
                    $('#gsyw').html(res.data.gsyw);
                    $('#educations').html(res.data.educations);
                    $('#careers').html(res.data.careers);
                    $('#grbq').html(res.data.grbq);
                    $('#industry').html(res.data.industry);
                    $('#agency').html(res.data.agency);
                    $('#card').attr('src', res.data.card_path);
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    };
    window.onBackView();


    $(function () {
        $('#upload_pic').on('touchstart', function () {
            if ($.util.isAPP) {
                LEMON.event.uploadPhoto('{"dir":"user/avatar","zip":"1"}', function (data) {
                    var data = JSON.parse(data);
                    if (data.status === true) {
                        $('input[name="avatar"]').val(data.thumbpath);
                        $('#upload_pic img').attr('src', data.thumbpath);
                        $.util.ajax({
                            url: '/user/getAppPic',
                            data: {avatar: data.thumbpath},
                            func: function (msg) {
                                if (msg.status) {
                                    $.util.alert(msg.msg);
                                } else {
                                    $.util.alert(msg.msg);
                                }
                            }
                        });
                    } else {
                        $.util.alert('app上传失败');
                    }
                });
                return false;
            } else if ($.util.isWX) {
                $.util.wxUploadPic(function (id) {
                    alert(id);
                    $.util.ajax({
                        url: "/user/getWxPic/" + id,
                        func: function (msg) {
                            $.util.alert(msg.msg);
                            if (msg.status === true) {
                                $('#upload_pic img').attr('src', msg.path);
                                $('input[name="avatar"]').val(msg.path);
                            }
                        }
                    });
                });
            } else {
                $.util.alert('请在微信或APP上传图片');
            }
        });

        $('#submit').on('click', function () {
            var $form = $('form');
            $.util.ajax({
                data: $form.serialize(),
                func: function (msg) {
                    if (typeof msg === 'object') {
                        if (msg.status) {
                            $.util.alert(msg.msg);
                            setTimeout(function () {
                                location.href = '/home/index';
                            }, 2000);
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        });
        /**
         $('.checkedsex').mobiscroll().select({
         theme: 'mobiscroll',
         display: 'bottom',
         headerText: function (valueText) {
         return "请选择性别";
         },
         rows: 3
         });
         */
    });
</script>
<?php
$this->end('script');
