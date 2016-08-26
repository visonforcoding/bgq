<!--<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            小秘书
        </h1>

    </div>
</header>-->

<div class="wraper">
    <!--<div class="h20">
            
    </div>-->
    <div class="dialogue" id='xiaomi'>
        <ul id="msgContent">

        </ul>
    </div>
</div>
<div style="height:3.2rem"></div>
<div class="todialogue">
    <div class="line"><span class="mistips bgff">我们会在三个工作日内处理您的申请</span></div>
    <div class="clearfix b-text">
        <div class="r-input">
            <textarea placeholder="请在这里输入" id="content"></textarea>
        </div>
        <span class="r-submit" id="submit">发送</span>
    </div>
</div>
<div class="reg-shadow" ontouchmove="return false;" id="shadow" hidden></div>
<div class="totips" style="height: 3.6rem;" hidden id="checkBtn">
    <h3 id="msg">请先去完善个人资料</h3>
    <span></span>
    <a href="javascript:void(0)" class="tipsbtn" id="no">取消</a><a href="/home/edit_userinfo" class="tipsbtn" id="yes">去完善</a>
</div>
<script type="text/html" id="tpl">
    {#msg#}
</script>
<?php $this->start('script') ?>
<script>
    $.util.checkUserinfoStatus();

    $.util.ajax({
        type: 'post',
        url: '/home/get-xiaomi',
        func: function (res) {
            if (res.status) {
                $.util.dataToTpl('msgContent', 'tpl', res.data, function (d) {
                    if (d.reply_id) {
                        d.msg = '<li class="fl"><span>' + d.msg + '</span><time>' + d.create_time + '</time></li>';
                    } else {
                        d.msg = '<li class="fr"><span>' + d.msg + '</span><time>' + d.create_time + '</time></li>';
                    }
                    return d;
                });
            }
        }
    })

    $(function () {
        $('#submit').click(function () {
            var content = $('#content').val();
            if (!content) {
                $.util.alert('内容不可为空');
                return false;
            }
            $.util.ajax({
                url: '/home/reply-xiaomi',
                data: {content: content},
                func: function (res) {
                    if (res.status) {
                        $.util.alert(res.msg);
                        setTimeout(function () {
                            location.href = '/home/my-xiaomi';
                        }, 2000);
                    } else {
                        if (res.msg.indexOf('请先去完善个人资料') != -1) {
                            $('#msg').html(res.msg);
                            $('#shadow').show();
                            $('#checkBtn').show();
                        } else {
                            $.util.alert(res.msg);
                        }
                    }
                }
            });
        });
    });
    
    setTimeout(function () {
        window.scrollTo(0, 99999);
    }, 200);

</script>
<?php
$this->end('script');
