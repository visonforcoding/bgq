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
    <div class="dialogue">
        <ul>
            <?php if(!empty($conversation)): ?>
                <?php foreach($conversation as $k=>$v): ?>
                    <?php if($v['pid']!=0): ?>
                        <li class="fl"><span><?= $v['msg'] ?></span><time><?= $v['create_time']->i18nFormat('yyyy-MM-dd') ?></time></li>
                    <?php else: ?>
                        <li class="fr"><span><?= $v['msg'] ?></span><time><?= $v['create_time']->i18nFormat('yyyy-MM-dd') ?></time></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div style="height:1rem"></div>
<div class="todialogue">
    <textarea placeholder="请输入内容" id="content"></textarea>
    <span id="submit"></span>
</div>
<?php $this->start('script') ?>
<script>
   window.scrollTo(0, 999999);
    $(function(){
        $('#submit').click(function(){
            var content =  $('#content').val();
            if(!content){
                $.util.alert('内容不可为空');
                return false;
            }
            $.util.ajax({
               url: '/home/reply_xiaomi',
               data:{content:content},
               func:function(res){
                   $.util.alert(res.msg);
                   setTimeout(function(){
                       location.href = '/home/my_xiaomi';
                   },2000);
               }
            });
        });
    });
</script>
<?php $this->end('script');
