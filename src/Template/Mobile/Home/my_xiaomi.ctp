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
            <textarea placeholder="请输入内容" id="content"></textarea>
        </div>
        <span class="r-submit" id="submit">发送</span>
    </div>
</div>
<script type="text/html" id="tpl">
    {#msg#}
</script>
<?php $this->start('script') ?>
<script>
    
    $.util.ajax({
        type: 'post',
        url: '/home/get-xiaomi',
        func: function(res){
            if(res.status){
                $.util.dataToTpl('msgContent', 'tpl', res.data, function(d){
                    if(d.reply_id){
                        d.msg = '<li class="fl"><span>'+d.msg+'</span><time>'+d.create_time+'</time></li>';
                    } else {
                        d.msg = '<li class="fr"><span>'+d.msg+'</span><time>'+d.create_time+'</time></li>';
                    }
                    return d;
                });
            }
        }
    })
    
    $(function(){
        $('#submit').click(function(){
            var content =  $('#content').val();
            if(!content){
                $.util.alert('内容不可为空');
                return false;
            }
            $.util.ajax({
               url: '/home/reply-xiaomi',
               data:{content:content},
               func:function(res){
                   $.util.alert(res.msg);
                   if(res.status){
                        setTimeout(function(){
                            location.href = '/home/my-xiaomi';
                        },2000);
                    }
               }
            });
        });
    });
    setTimeout(function(){
        window.scrollTo(0, 99999);
    }, 200);
    
</script>
<?php $this->end('script');
