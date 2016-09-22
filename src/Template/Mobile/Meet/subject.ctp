<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            编辑话题
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="h20">
    </div>
    <form action="" method="">
        <div class="a-form-box s-form-box">
            <ul>
                <li>
                    <span>题目</span>
                    <input name="title" type="text" value="<?php if(isset($subject)): ?><?=$subject->title?><?php endif; ?>" />
                </li>
                <li>
                    <i>话题简介</i>
                    <textarea name="summary"><?php if(isset($subject)): ?><?=$subject->summary?><?php endif; ?></textarea>
                </li>
            </ul>
        </div>
    </form>
    <a id="submit" href="javascript:void(0)" class="nextstep">提交</a>
    <?php if(isset($subject)): ?>
    <a href="javascript:void(0)" id="del" class="s-btn colorbg">删除</a>
    <?php endif;?>
</div>
<?php $this->start('script') ?>
<script>
    $('input[name="type"]').on('click',function(){
            $('input[name="type"]').next('i').removeClass('active');
            $(this).next('i').addClass('active');
            if($(this).attr('value') == 1){
                $('#addrtime').hide();
            } else {
                $('#addrtime').show();
            }
    });
    $('#del').on('click',function(){
        $.util.ajax({
            url:'/meet/del-subject/'<?php if(isset($subject)):?>+<?=$subject->id?><?php endif;?>,
            func:function(res){
                $.util.alert(res.msg);
                if(res.status){
                    setTimeout(function(){
                        window.location.href = document.referrer;
                    },1500);
                }
            }
        });
    });
    $('#submit').on('click', function () {
        if($('input[name="title"]').val() == ''){
            $.util.alert('请填写题目');
            return false;
        }
        if($('textarea[name="summary"]').val() == ''){
            $.util.alert('请填写话题简介');
            return false;
        }
        if($('#submit').hasClass('noTap')){
            return false;
        }
        $('#submit').addClass('noTap');
        $form = $('form');
        $.util.ajax({
            type: 'post',
            url: $form.attr('action'),
            data: $form.serialize(),
            func: function (msg) {
                if (typeof msg === 'object') {
                    $.util.alert(msg.msg);
                    if (msg.status === true) {
                        setTimeout(function(){
                            window.location.href = document.referrer;
                            $('#submit').removeClass('noTap');
                        },1500);
                    } else {
                        $('#submit').removeClass('noTap');
                    }
                }
            }
        });
        return false;
    });
</script>
<?php
$this->end('script');
