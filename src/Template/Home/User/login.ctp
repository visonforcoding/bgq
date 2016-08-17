<div class="wraper">
    <div class="head">
        <h1 class="innerbox wxlogin">
            <a href="javascript:void(0)" class="cur login" id="login">登录</a>
            <!--<a href="/w/register" class="reg">注册</a>-->
            <div class="wx" id="wx">
                <img src="/<?= $code; ?>"/>
                <i>打开并购圈APP，扫码登陆</i>
            </div>
        </h1>
    </div>

    <span class="fixedmiddle"></span>

</div>
<div class="innerwraper"></div>
<script type="text/javascript">
    var isInside = false;
    var loginbtn = document.getElementById('login');
    var wxbox = document.getElementById('wx');
    var img = wxbox.getElementsByTagName('img')[0];
    var timer = '';
    loginbtn.onmouseover = function () {
        wxbox.style.opacity = 1;
        timer = setInterval(check, 2000);
    };
    loginbtn.onmouseout = function () {
        setTimeout(function () {
            if (!isInside) {
                wxbox.style.opacity = 0;
                clearInterval(timer);
            }
        }, 1000);
    };
    wxbox.onmouseenter = function () {
        isInside = true;
    };
    wxbox.onmouseleave = function () {
        isInside = false;
        this.style.opacity = 0;
    };

    
    function check(){
        $.ajax({
            type: 'POST',
            url: '/w/User/check/<?= $guid ?>',
            dataType: 'json',
            success: function (res) {
                console.log(res);
                if(res.status){
                    $.util.alert(res.msg);
                    setTimeout(function(){
                        location.href = '/w/index/index';
                    }, 2000);
                }
            }
        });
    }
</script>
