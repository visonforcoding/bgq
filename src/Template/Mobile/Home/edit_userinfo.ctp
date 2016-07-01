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
    <!--<div class="h-home-bottom">
        <div><span><img src="../images/home-pic.png"/></span><i class="iconfont">&#xe61e;</i></div>
        <h3>杨涛<span>IDG资本 董事长</span></h3>
    </div>-->
</header>
<div class="wraper m-fixed-bottom">
    <form method="post">
    <ul class="h-info-box e-info-box">
        <li class='u-img no-right-ico'>
            <a href="javascript:void(0)">
                <span>头像：</span>
                <div class="upload-user-img">
                    <span id="upload_pic" class='tx'><img src="<?= $user->avatar ? $user->avatar : '/mobile/images/touxiang.png' ?>"/><input type="hidden" name="avatar" value="<?=$user->avatar?>" ></span>
                </div>
            </a>
        </li>
        <li class="no-right-ico">
            <a href="javascript:void(0)">
                <span>姓名：</span>
                <div>
                    <input type="truename" readonly value="<?=$user->truename?>" />
                </div>
            </a>
        </li>
        <li class="no-right-ico">
            <a href="javascript:void(0)">
                <span>公司：</span>
                <div>
                    <input type="company" value="<?=$user->company?>" />
                </div>
            </a>
        </li>
        <li class="no-right-ico">
            <a href="javascript:void(0)">
                <span>职务：</span>
                <div >
                    <input type="position" value="<?=$user->position?>" />
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <span>性别：</span>
                <div>
                    <span>
                    <select name="gender" class='checkedsex'>
                        <option value="1" <?php if($user->gender==1):?>selected="true"<?php endif; ?>>男</option>
                        <option value="2" <?php if($user->gender==2):?>selected="false"<?php endif; ?>>女</option>
                    </select>
                    </span>
                </div>
            </a>
        </li>
    </ul>
    <ul class="h-info-box e-info-box">
        <li class="no-right-ico">
            <a href="javascript:void(0)">
                <span>联系电话：</span>
                <div>
                    <input type="phone" readonly value="<?=$user->phone?>" />
                </div>
            </a>
        </li>
        <li class="no-right-ico">
            <a href="javascript:void(0)">
                <span>邮箱：</span>
                <div>
                    <input type="email" value="<?=$user->email?>" />
                </div>
            </a>
        </li>
    </ul>
    <ul class="h-info-box e-info-box">
        <li>
            <a href="javascript:void(0)">
                <span>行业：</span>
                <div>
                    <input type="text" placeholder="金融" />
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <span>所在地：</span>
                <div>
                    <span><?= $user->city ?></span>
                </div>
            </a>
        </li>
        <li>
            <a href="/home/my-business">
                <span>擅长业务：</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
        <li>
            <a href="/home/edit-company-business">
                <span>公司业务：</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
        <li>
            <a href="/home/edit-education">
                <span>教育经历：</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
        <li>
            <a  href="/home/edit-work">
                <span>工作经历：</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
        <li>
            <a href="/home/edit-card">
                <span class="m-card">我的名片：</span>
                <div class="upload-user-img">
                    <span><input type="text"/></span>
                </div>
            </a>
        </li>
        <li class="nobottom">
            <a href="/home/edit-mark">
                <span>个人标签：</span>
                <div>
                    <span></span>
                    </div>
                </a>
            </li>
    </ul>
    </form>
    <a id="submit" href="javascript:void(0);" class="nextstep">完成</a>
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
<!-- <div class="checked-sex shadow-info" style="display: none;">
    <div class="h-checked-sex">
        <a href="javascript:void(0);">取消</a>

        <h3>性别</h3>
        <a  href="javascript:void(0);">完成</a>
    </div>
    <span>女</span>
    <span>男</span>
</div>
<div class="checked-sex shadow-info" style="display: none;">
    <div class="h-checked-sex">
        <a href="javascript:void(0);">取消</a>

        <h3>所在地</h3>
        <a href="javascript:void(0);">完成</a>
    </div>
    <span class="f-color-gray">山东  珠海</span>
    <span>广西   广州</span>
    <span class="f-color-gray">广东   深圳</span>
    <span class="f-color-gray">海南 佛山</span>
</div> -->
<script src="/mobile/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>

<!--<script src="/mobile/js/lib/lrz.all.bundle.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="/mobile/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>-->
<script src="/mobile/js/mobiscroll.2.13.2.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>

<script>
    $(function () {
        $('#upload_pic').on('touchstart',function(){
            if($.util.isAPP){
                LEMON.event.uploadPhoto('{"dir":"user/avatar","zip":"1"}',function(data){
                    var data = JSON.parse(data);
                   if(data.status===true){
                       $('input[name="avatar"]').val(data.thumbpath);
                       $.util.ajax({
                           url: '/user/getAppPic',
                           data: {avatar:data.thumbpath},
                           func: function(msg){
                               if(msg.status){
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
            } else if($.util.isWX) {
                $.util.wxUploadPic(function(id){
                    $.util.ajax({
                        url: "/user/getWxPic/" + id,
                        func: function (msg) {
                            $.util.alert(msg.msg);
                            $.util.alert(msg.path);
                            if(msg.status===true){
                                $('input[name="avatar"]').val(msg.path);
                            }
                        }
                    });
                });
            }else{
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
                            location.href = '/home/index';
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        });

        $('.checkedsex').mobiscroll().select({
            theme: 'mobiscroll',
            display: 'bottom',
            headerText: function (valueText) {
                return "请选择性别";
            },
            rows: 3
        });
    });
</script>
<?php
$this->end('script');
