<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            注册
        </h1>
    </div>
</header>
<div class="wraper">
    <h1 class='choose-org-type innerwaper'>请选择机构类型</h1>
    <?php foreach ($agencies as $key => $agency): ?>
        <div class="items">
            <div class="orgtitle  innerwaper">
                <span class="orgname"><?= $agency['name'] ?></span>
            </div>
            <?php if (!empty($agency['children'])): ?>
                <div class="orgmark">
                    <?php foreach ($agency['children'] as $item): ?>
                        <a class="agency-item" data-val="<?=$item['id']?>" href="#this"><?= $item['name'] ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($key < (count($agencies) - 1)): ?>
            <div class='h20'></div>
        <?php endif; ?>
    <?php endforeach; ?>
    <a href="#this" id="submit" class='nextstep'>下一步</a>
</div>

<?php $this->start('script') ?>
<script src="/mobile/js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>
<script>
    var agency = 0;
    $(function(){
       $('.agency-item').on('click',function(){
           $('.agency-item').removeClass('active');
           $(this).addClass('active');
           agency = $(this).data('val');
       }) ;
       $('#submit').on('click',function(){
           if(agency>0){
               $.post('/user/register-org',{agency:agency},function(res){
                   if(res.status===true){
                       window.location.href = res.url;
                   }else{
                       alert(res.msg);
                   }
               },'json');
           }else{
               alert('请先选择机构类型');
           }
       });
    });
</script>
<?php
$this->end('script');
