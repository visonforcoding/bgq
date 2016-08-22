<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            专家简介
        </h1>

    </div>
</header>
<div class="wraper">
    <div class="h20">
    </div>
    <div class="a-form-box">
        <ul>
            <li>
                <textarea id="summary"><?= $summary ?></textarea>
            </li>
        </ul>
    </div>
    <a id="submit" href="javascript:void(0);" class="nextstep redshadow">保存</a>
    <!--<a href="my-history-info.html" class='historyinfo'>历史消息</a>-->
</div>
<?php $this->start('script'); ?>
<script>
   $('#submit').on('tap',function(){
       var summary = $('#summary').val();
       if(!summary){
           $.util.alert('请填写内容');
           return false;
       }
       $.util.ajax({
           data:{summary:summary},
           func:function(res){
               $.util.alert(res.msg);
               if(res.status){
                   setTimeout(function(){
                       location.href = "/user/home-page/<?= $id ?>";
                   },1000);
               }
           }
       });
   });
</script>
<?php
$this->end('script');