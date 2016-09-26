<link rel="stylesheet" type="text/css" href="/mobile/css/zt.css"/>
<div class="wraper content_inner" style="margin-bottom:1rem;">
    <div class="infotab m-infotab-list">
        <div class="tabcon bd2 zt_tab_con">
            <form>
                <ul class="cur inner basicon">
                    <li class="b-dq"><span><i class="iconfont col_darkblue">&#xe66a;</i>姓 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</span><div><em><?= $is_apply ? $user->user->truename : $user->truename; ?></em></div></li>
                    <li class="b-hy"><span><i class="iconfont col_yellow">&#xe684;</i>我的星座</span>
                        <div >
                            <em class="hid_wid">
                                <select name="constellation" style="overflow: scroll;">
                                    <option value="">请选择</option>
                                    <?php if($is_apply): ?>
                                    <option value="白羊座" <?php if($user->constellation == '白羊座'): ?>selected<?php endif; ?>>白羊座</option>
                                    <option value="金牛座" <?php if($user->constellation == '金牛座'): ?>selected<?php endif; ?>>金牛座</option>
                                    <option value="双子座" <?php if($user->constellation == '双子座'): ?>selected<?php endif; ?>>双子座</option>
                                    <option value="巨蟹座" <?php if($user->constellation == '巨蟹座'): ?>selected<?php endif; ?>>巨蟹座</option>
                                    <option value="狮子座" <?php if($user->constellation == '狮子座'): ?>selected<?php endif; ?>>狮子座</option>
                                    <option value="处女座" <?php if($user->constellation == '处女座'): ?>selected<?php endif; ?>>处女座</option>
                                    <option value="天秤座" <?php if($user->constellation == '天秤座'): ?>selected<?php endif; ?>>天秤座</option>
                                    <option value="天蝎座" <?php if($user->constellation == '天蝎座'): ?>selected<?php endif; ?>>天蝎座</option>
                                    <option value="射手座" <?php if($user->constellation == '射手座'): ?>selected<?php endif; ?>>射手座</option>
                                    <option value="摩羯座" <?php if($user->constellation == '摩羯座'): ?>selected<?php endif; ?>>摩羯座</option>
                                    <option value="水瓶座" <?php if($user->constellation == '水瓶座'): ?>selected<?php endif; ?>>水瓶座</option>
                                    <option value="双鱼座" <?php if($user->constellation == '双鱼座'): ?>selected<?php endif; ?>>双鱼座</option>
                                    <?php else: ?>
                                    <option value="白羊座">白羊座</option>
                                    <option value="金牛座">金牛座</option>
                                    <option value="双子座">双子座</option>
                                    <option value="巨蟹座">巨蟹座</option>
                                    <option value="狮子座">狮子座</option>
                                    <option value="处女座">处女座</option>
                                    <option value="天秤座">天秤座</option>
                                    <option value="天蝎座">天蝎座</option>
                                    <option value="射手座">射手座</option>
                                    <option value="摩羯座">摩羯座</option>
                                    <option value="水瓶座">水瓶座</option>
                                    <option value="双鱼座">双鱼座</option>
                                    <?php endif; ?>
                                </select>
                            </em>
                        </div>
                        <b class="iconfont r_more">&#xe667;</b>
                    </li>
                    <li class="b-yw">
                        <span><i class="iconfont col_cyan">&#xe670;</i>参赛宣言</span>
                        <div><em><input name="declaration" type="text" placeholder="请输入" value="<?= $is_apply ? $user->declaration : '' ?>" /></em></div>
                    </li>
                    <li class="b-gs"><span><i class="iconfont color-items">&#xe61c;</i>兴趣爱好</span><div><em><input name="hobby" type="text" placeholder="请输入" value="<?= $is_apply ? $user->hobby : '' ?>" /></em></div></li>
                    <li class="b-gs noafter"><span><i class="iconfont col_blue">&#xe67e;</i>个人简介</span><div><em class="zt_text"><textarea name="brief" placeholder="请输入"><?= $is_apply ? $user->brief : '' ?></textarea></em></div></li>
                </ul>
            </form>
        </div>
    </div>
    <!--照片-->
    <div class='photo_album mt20'>
        <div class="p_title  innercon"><h3><i class="iconfont">&#xe685;</i>你的照片</h3></div>
        <div class="photo_list bgff">
            <ul id="uploadPic">
                <?php foreach ($pic as $k => $v): ?>
                <li onclick=""><img src="<?= $v['pic_url'] ?>"/></li>
                <?php endforeach; ?>
                <li id="upload_pic">
                    <div class="uploadfile">
                        <span class="addpoto"><i class="iconfont">&#xe692;</i></span>
                        <!--<input type="text" name="vote_pic" class="type_file" />-->
                    </div>
                </li>
            </ul>
            <h3 class="tc poto_tips">( 至少上传1张，最多上传6张 )</h3>
        </div>
    </div>
</div>
<a href="javascript:void(0);" class="f-bottom" id="submit"><?= $is_apply ? '保存资料' : '提交申请' ?></a>
<?php $this->start('script'); ?>
<script>
    $('#submit').on('tap', function () {
        if($('select[name="constellation"]').val() == ''){
            $.util.alert('请选择星座');
            return false;
        }
        if($('input[name="declaration"]').val() == ''){
            $.util.alert('请填写参赛宣言');
            return false;
        }
        if($('input[name="hobby"]').val() == ''){
            $.util.alert('请填写兴趣爱好');
            return false;
        }
        if($('textarea[name="brief"]').val() == ''){
            $.util.alert('请填写个人简介');
            return false;
        }
        $.util.ajax({
            url: $('form').attr('action'),
            data: $('form').serialize(),
            func: function (res) {
                $.util.alert(res.msg);
                if (res.status) {
                    setTimeout(function () {
                        location.href = '/beauty/index';
                    }, 1000);
                }
            }
        });
    });

    if ($('#uploadPic').children('li').length > 6) {
        $('#upload_pic').remove();
    }

    $('#upload_pic').on('touchstart', function () {
        if ($.util.isAPP) {
            LEMON.event.uploadPhoto('{"dir":"beauty/pic","zip":"1"}', function (data) {
                var data = JSON.parse(data);
                if (data.status === true) {
                    $('#uploadPic').prepend('<li onclick=""><img src="' + data.smallpath + '"/></li>');
                    if ($('#uploadPic').children('li').length > 6) {
                        $('#upload_pic').remove();
                    }
                    alert(data.smallpath);
                    $.util.ajax({
                        url: '/beauty/getAppPic',
                        data: {url: data.smallpath},
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
                $.util.ajax({
                    url: "/beauty/getWxPic/" + id,
                    func: function (msg) {
                        $.util.alert(msg.msg);
                        if (msg.status === true) {
                            $('#uploadPic').prepend('<li><img src="' + msg.smallpath + '"/></li>');
                            if ($('#uploadPic').children('li').length > 6) {
                                $('#upload_pic').remove();
                            }
                        }
                    }
                });
            });
        } else {
            $.util.alert('请在微信或APP上传图片');
        }
    });
</script>
<?php
$this->end('script');
