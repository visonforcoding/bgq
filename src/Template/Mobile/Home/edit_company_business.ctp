<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            公司业务
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="my-good-b">
        <textarea id="gsyw" name="gsyw"><?=$user->gsyw?></textarea>
    </div>
    <a href="#this" id="submit" class="nextstep">保存</a>
</div>
<?php $this->start('script') ?>
<script>
    $('#submit').on('tap',function(){
        var gsyw = $('#gsyw').val();
        if(!gsyw){
            $.util.alert('输入不可为空');
            return false;
        }
        $.util.ajax({
            data:{'gsyw':gsyw},
            func:function(res){
                $.util.alert(res.msg);
                if(res.status){
                    setTimeout(function(){
                        window.location.href = '/home/edit-userinfo';
                    },1500);
                }
            }
        });
    });
</script>
<?php $this->end('script'); ?>