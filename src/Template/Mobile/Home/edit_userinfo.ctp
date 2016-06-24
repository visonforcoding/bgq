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
    <ul class="h-info-box e-info-box">
        <form method="post">
        <li>
            <a href="javascript:void(0)">
                <span>头像：</span>
                <div class="upload-user-img">
                    <input type="hidden" name="avatar" >
                    <span><input  id="upload_pic" type="file" /></span>
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
        <li>
            <a href="javascript:void(0)">
                <span>性别：</span>
                <div>
                    <span>男</span>
                </div>
            </a>
        </li>
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
                    <span>深圳</span>
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
            <a href="edit-company-business.html">
                <span>公司业务：</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
        <li>
            <a href="edit-education.html">
                <span>教育经历：</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
        <li>
            <a  href="edit-work.html">
                <span>工作经历：</span>
                <div>

                    <span></span>
                </div>
            </a>
        </li>
        <li>
            <a href="edit-card.html">
                <span>我的名片：</span>
                <div class="upload-user-img">
                    <span><input type="file"/></span>
                </div>
            </a>
        </li>
        <li class="nobottom">
            <a href="edit-mark.html">
                <span>个人标签：</span>
                <div>
                    <span></span>

                </div>
            </a>
        </li>
        </form>
    </ul>
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
<div class="checked-sex shadow-info" style="display: none;">
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
</div>
<script src="/mobile/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/lib/lrz.all.bundle.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(function () {
        $('#upload_pic').click(function(){
            if($.util.isAPP){
                alert('我要调JSAPI了');
                LEMON.event.uploadPhoto('{"dir":"user/avatar","zip":"1"}',function(data){
                    alert(data);
                  var data = JSON.parse(data);
                   if(data.status===true){
                       $('input[name="avatar"]').val(data.thumbpath);
                    }
                });
               return false; 
            }
        });
        $('#upload_pic').change(function () {
            var file = $(this).get(0).files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                console.log(reader);
                //$('.imgcard').find('img').attr('src', e.target.result);
                lrz(file,{quality:0.7}).then(function(rst){
                    //压缩处理
                    $.ajax({
                        url: '/do-upload?dir=user/avatar&zip=1',
                        data: rst.formData,
                        type: 'POST',
                        cache: false,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function (data) {
                            if(data.status===true){
                               $('input[name="avatar"]').val(data.thumbpath);
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
                            $.util.alert(msg.msg);
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        });
    });
</script>
<?php
$this->end('script');