<?php $this->start('static'); ?>
<style>
    #mp{
        background: url('/mobile/img//unknown-avatar.png');
        filter:alpha(opacity:0); 
        /*opacity:0;*/
        width:200px;
    }
</style>
<?php $this->end('static'); ?>
<header class="mui-bar mui-bar-nav">
    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
    <h1 class="mui-title">注册</h1>
</header>
<div class="mui-content">
    <form class="mui-input-group">
        <div style="min-width:200px;width:200px;margin:0px auto;">
            <input type="file" id="mp" name="mp"/> 
        </div>
        <button id='reg' style="height:20px;line-height:20px;margin-bottom:10px;" class="mui-btn mui-btn-block mui-btn-primary">上传</button>
        <div class="mui-input-row">
            <label>账号</label>
            <input id='account' type="text" class="mui-input-clear mui-input" placeholder="请输入账号">
        </div>
        <div class="mui-input-row">
            <label>密码</label>
            <input id='password' type="password" class="mui-input-clear mui-input" placeholder="请输入密码">
        </div>
        <div class="mui-input-row">
            <label>确认</label>
            <input id='password_confirm' type="password" class="mui-input-clear mui-input" placeholder="请确认密码">
        </div>
        <div class="mui-input-row">
            <label>邮箱</label>
            <input id='email' type="email" class="mui-input-clear mui-input" placeholder="请输入邮箱">
        </div>
        <div class="mui-input-row">
            <label>名片</label>
            <input id='mp' type="file" class="mui-input-clear mui-input" placeholder="上传名片">
        </div>
    </form>
    <div class="mui-content-padded">
        <button id='reg' class="mui-btn mui-btn-block mui-btn-primary">注册</button>
    </div>
    <div class="mui-content-padded">
    </div>
</div>
<?php $this->start('script'); ?>
<script src="/mobile/lib/JIC.min.js"></script>
<script>
    document.querySelector('#mp').onchange = function (evt) {
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*'))
                continue;
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    var img = document.createElement('img');
                    img.title = theFile.name;
                    img.src = e.target.result;
                    document.body.appendChild(img); //这里你想插哪插哪  
                }
            })(f);
            reader.readAsDataURL(f);
        }
    };
</script>
<?php
$this->end('script');
