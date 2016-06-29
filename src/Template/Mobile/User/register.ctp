<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            注册
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="uploadbox">
        <a href='#this' class='imgcard'><img src='/mobile/images/card.jpg' /></a>
        <div class="filebtn">
            <a href="javascript:void(0)" class="uploadbtn" id="uploadPic">上传名片</a>
            <input id="upload_pic" type="hidden"  />
        </div>
        <p>系统将自动识别名片中的信息</p>
    </div>
    <div class="infobox">
        <form id="reg-form" action="" method="post">
            <ul>
                <input name="card_path" type="hidden"/>
                <li>姓名：<span class='infocard'><input type="text" name="truename"  /></span></li>
                <li>公司：<span class='infocard'><input type="text" name="company"  /></span></li>
                <li>职务：<span class='infocard'><input type="text" name="position"  /></span></li>
                <!--<li>联系电话：<span class='infocard'><input type="text" name="phone" placeholder="13806159876" /></span></li>-->
                <li>邮箱：<span class='infocard'><input type="email" name="email"  /></span></li>
                <li>地址：<span class='infocard'><input type="text" name="address"  /></li>
                <!--<li>登录密码：<span class='infocard reg-pass'><input type="password" name="password"   /></span></li>-->
                <!--<li>再次输入密码：<span class='infocard reg-repass'><input type="password" name="repassword"   /></span></li>-->
            </ul>
        </form>
    </div>
    <a href="#this" id="submit" class="nextstep">下一步</a>
</div>
<?php $this->assign('footer', '') ?>
<?php $this->start('script') ?>
<!--<script src="/mobile/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/lib/lrz.all.bundle.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>-->
<script>
    $(function () {
        $('#submit').on('click', function () {
            var $form = $('form');
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: 'json',
                success: function (msg) {
                    if (typeof msg === 'object') {
                        if (msg.status) {
                            window.location.href = msg.url;
                        } else {
                            alert(msg.msg);
                        }
                    }
                }
            });
        });
    });
    $('#uploadPic').on('tap', function () {
        var path = null;
        if ($.util.isAPP) {
            LEMON.event.uploadPhoto(callback());
        } else if ($.util.isWX) {
            $.util.wxUploadPic(function (id) {
                $.util.ajax({
                    url: "/user/getWxPic/" + id + '?dir=user/mp',
                    func: function (res) {
                        if (res.status === true) {
                            $.util.alert(res.msg);
                            path = res.path;
                            $('input[name="card_path"]').val(res.path);
                        }
                    }
                });
            });
        } else {
            $.util.alert('请在微信或APP里面上传名片');
        }
        if (path) {
            alert(path);
            $.post('/user/recog-mp', {path:path}, function (res) {
                if (res.status === true) {
                    $('input[name="truename"]').val(res.result.name[0]);
                    $('input[name="company"]').val(res.result.comp[0]);
                    $('input[name="position"]').val(res.result.title[0]);
                    $('input[name="email"]').val(res.result.email[0]);
                    $('input[name="address"]').val(res.result.addr[0]);
                }
            }, 'json');
        }
    });
</script>
<?php
$this->end('script');
