<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>

            设置
        </h1>

    </div>
</header>

<div class="wraper">
    <div class="h2"></div>
<!--    <div class="infoboxlist a-pay paytype installbox">
        <ul class='ulinfo'>
            <li>消息提醒：<span class='infocard'><input type="radio" name='pay' checked="checked" /><i class='active'></i></span></li>

        </ul>
    </div>-->
   <!--  <div class="infoboxlist a-pay paytype installbox">
        <ul class='ulinfo'>
            <li>系统版本：</li>

        </ul>
    </div> -->

    <ul class="h-info-box e-info-box">
        <li class="no-right-ico install">
            <span>使用缓存</span>
            <div>
                <span class="btn" id='checkBtn'><i class="off"></i></span>
            </div>
        </li>
        <li class="lh4 no-right-ico install">
            <a href="javascript:void(0);">
                <span>系统版本</span>
                <div>
                    <span id="verson">Verson 1.0</span>
                </div>
            </a>
        </li>

        <li class="lh4">
            <a href="/mobile/html/api_test.html">
                <span>for api test</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
        <li class="lh4">
            <a href="javascript:void(0);">
                <span>给我打分</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
        <li  class="nobottom lh4">
            <a href="/user/change-phone">
                <span>更换手机号码</span>
                <div>
                    <span></span>
                </div>
            </a>
        </li>
    </ul>
   <a href="javascript:void(0);" class="nextstep redshadow" id="logout">退出登录</a>
</div>
<div class='bottom-logo'>
    <h3><a href="#this"><img src="/mobile/images/logo.png"/></a></h3>
    <p>V1.0</p>
    <p><a href="#this">服务条款</a> | <a href="#this">免责声明</a></p>
</div>
<div class="companyinfo">
    <p>Copyright ©2012-2018</p>
    <p>君汉控股（深圳）有限公司</p>
</div>
<?php $this->start('script'); ?>
<script>
    $('#logout').on('tap', function(){
        $.ajax({
            type: 'POST',
            url: '/user/login-out',
            dataType: 'json',
            success: function(msg){
                if(msg.status) {
                    $.util.alert(msg.msg);
                    $.util.setCookie('token_uin','');
                    $.util.setCookie('login_status', '');
                    LEMON.db.set('token_uin','');
                    location.href = '/home/index';
                } else {
                    $.util.alert(msg.msg);
                }
            }
        });
    });
    $('#verson').html('Verson '+LEMON.sys.version());

    function setCheck(st){
        if(st == 'on'){
            $('#checkBtn i').get(0).className = 'on';
            $('#checkBtn').removeClass().addClass('c-btn');
        }
        else{
            $('#checkBtn i').get(0).className = 'off';
             $('#checkBtn').removeClass().addClass('btn');
        }
    }
    alert(14)

    $('#checkBtn').on('tap',function(){
        alert(LEMON.sys.isUseLOC())
        if(LEMON.sys.isUseLOC() == 'on'){
            LEMON.sys.closeLOC();
            setCheck('off');
        }else{
            LEMON.sys.openLOC();
            setCheck('on');
        }
    })

    setCheck(LEMON.sys.isUseLOC());
</script>
<?php $this->end('script');