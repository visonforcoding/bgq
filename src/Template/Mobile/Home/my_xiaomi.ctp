<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            小秘书
        </h1>
        <!-- <a href="/home/my-history-need" class='h-regiser'>历史消息</a> -->
    </div>
</header>
<div class="wraper">
    <div class="h20">
    </div>
    <div class="a-form-box">
        <ul>
            <li>
                <textarea id="content"></textarea>
            </li>
        </ul>
    </div>
    <a href="#this" id="submit" class="nextstep redshadow">发送</a>
    <a href="my-history-info.html" class='historyinfo'>历史消息</a>
</div>
<?php $this->start('script') ?>
<script>
   $(function(){
      $('#submit').click(function(){
         var content =  $('#content').val();
         if(!content){
             $.util.alert('不可为空');
             return false;
         }
         $.util.ajax({
            data:{content:content},
            func:function(res){
                $.util.alert(res.msg);
            }
         });
      });
   });
</script>
<?php $this->end('script');