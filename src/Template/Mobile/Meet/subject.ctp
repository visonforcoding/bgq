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
        <!-- <div class="h20"></div> -->
<!--        <div class="infobox paytype m-subject">
            <ul>
                <li>一对一面谈：
                    <span class='infocard'>
                    <input type="radio" name='type' value="1" 
                        <?php if(isset($subject)): ?>
                        <?php if($subject->type=='1'):?>checked="checked"<?php endif;?>
                            <?php else:?>checked="checked"<?php endif; ?>  />
                    
                    <?php if(isset($subject)): ?>
                        <?php if($subject->type=='1'):?><i class='active'></i><?php else: ?><i></i><?php endif;?>
                        <?php else:?><i class="active"></i>
                            <?php endif; ?>
                    </span>
                </li>
                <li>一对多面谈：<span class='infocard reg-repass'>
                    <input type="radio" value="2" <?php if(isset($subject)): ?><?php if($subject->type=='2'):?>checked="checked"<?php endif;?><?php endif; ?> name='type' />
                     <?php if(isset($subject)): ?>
                        <?php if($subject->type=='2'):?><i class='active'></i><?php else: ?><i></i><?php endif;?>
                        <?php else:?><i></i>
                            <?php endif; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="infobox m-subject-info" id="addrtime" <?php if(isset($subject)): ?><?php if($subject->type=='1'):?>hidden<?php endif;?><?php else:?>hidden<?php endif; ?>>
            <ul>
                <li>地点：<span class='infocard'><input type="text" name="address" value="<?php if(isset($subject)): ?><?=$subject->address?><?php endif; ?>" /></span></li>
                <li>时间：<span class='infocard reg-repass'><input type="text" name="invite_time" value='<?php if(isset($subject)): ?><?=$subject->invite_time?><?php endif; ?>' /></span></li>
            </ul>
        </div>-->
<!--        <div class="infobox m-subject-info">
            <ul class="s-price">
                <li>所需时间：<span class='infocard'>约<input type="text"  name="last_time" value="<?php if(isset($subject)): ?><?=$subject->last_time?><?php endif; ?>" />小时</span></li>
                <li>价格：<span class='infocard reg-repass'><input type="text"  name="price" value='<?php if(isset($subject)): ?><?=$subject->price?><?php endif; ?>' />元/次</span></li>
            </ul>
        </div>-->
    </form>
    <a id="submit" href="#this" class="nextstep">提交</a>
    <?php if(isset($subject)): ?>
    <a href="#this" id="del" class="s-btn colorbg">删除</a>
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
                             window.location.href = '/meet/my-subjects'
                         },1500)
                     }
                 }
             });
    });
    $('#submit').on('click', function () {
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
                            window.location.href = '/meet/my-subjects';
                        },1500);
                    } 
                }
            }
        });
        return false;
    });
</script>
<?php
$this->end('script');
