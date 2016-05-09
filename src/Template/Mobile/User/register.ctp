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
        <a href='#this' class='imgcard'><img src='/mobile/images/card.png' /></a>
        <div class="filebtn">
            <a href="#this" class="uploadbtn">上传名片</a>
            <input id="upload_pic" type="file" />
        </div>
        <p>系统将自动识别名片中的信息</p>
    </div>
    <div class="infobox">
        <form id="reg-form" action="" method="post">
        <ul>
            <input name="card_path" type="hidden"/>
            <li>姓名：<span class='infocard'><input type="text" name="truename" placeholder="杨涛" /></span></li>
            <li>公司：<span class='infocard'><input type="text" name="company" placeholder="IDG资本" /></span></li>
            <li>职务：<span class='infocard'><input type="text" name="position" placeholder="董事长" /></span></li>
            <!--<li>联系电话：<span class='infocard'><input type="text" name="phone" placeholder="13806159876" /></span></li>-->
            <li>邮箱：<span class='infocard'><input type="email" name="email" placeholder="idg@foxmail.com" /></span></li>
            <li>地址：<span class='infocard'><input type="text" name="address" placeholder="深圳市南山区新豪方大厦" /></li>
            <!--<li>登录密码：<span class='infocard reg-pass'><input type="password" name="password"   /></span></li>-->
            <!--<li>再次输入密码：<span class='infocard reg-repass'><input type="password" name="repassword"   /></span></li>-->
        </ul>
        </form>
    </div>
    <a href="#this" id="submit" class="nextstep">下一步</a>
</div>

<?php $this->start('script') ?>
<script src="/mobile/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/lib/lrz.all.bundle.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(function () {
        $('#upload_pic').change(function () {
            var file = $(this).get(0).files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                console.log(reader);
                $('.imgcard').find('img').attr('src', e.target.result);
                lrz(file,{quality:0.7}).then(function(rst){
                    //压缩处理
                    $.ajax({
                        url: '/do-upload?dir=user/mp',
                        data: rst.formData,
                        type: 'POST',
                        cache: false,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function (data) {
                            if(data.status===true){
                               $('input[name="card_path"]').val(data.path);
                               $.post('/user/recog-mp',{path:data.path},function(res){
                                   if(res.status===true){
                                       console.log(res.result);
                                       $('input[name="truename"]').val(res.result.name[0]);
                                       $('input[name="company"]').val(res.result.comp[0]);
                                       $('input[name="position"]').val(res.result.title[0]);
//                                       $('input[name="phone"]').val(res.result.mobile[0]);
                                       $('input[name="email"]').val(res.result.email[0]);
                                       $('input[name="address"]').val(res.result.addr[0]);
                                   }
                               },'json');
                            }
                        },
                        error: function () {
                        }
                    });
                });
            };
        });
        
        $('#submit').on('click',function(){
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
</script>
<?php
$this->end('script');
