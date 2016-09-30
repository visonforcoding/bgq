<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            注册
        </h1>
    </div>
</header>

<div id="app" class="wraper">
    <h1 class='choose-org-type innerwaper'>请选择业务标签(可多选)</h1>
        <?php foreach ($industries as $key => $industry): ?>
        <div class="items">
            <div class="orgtitle  innerwaper">
                <span class="orgname"><?= $industry['name'] ?></span>
            </div>
            <?php if (!empty($industry['children'])): ?>
                <div class="orgmark">
                    <?php foreach ($industry['children'] as $item): ?>
                        <a class="agency-item" data-val="<?=$item['id']?>" href="#this"><?= $item['name'] ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($key < (count($industries) - 1)): ?>
            <div class='h20'></div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class='h20'></div>
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">其它</span>
        </div>
        <div class="orgmark myselfmark">
            <a href="#this"><input type='text' id="extra_industry" placeholder="请输入" /></a>
        </div>
    </div>
    <a href="#this" id="submit" class='nextstep'>下一步</a>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>
<script>
    var agency,formdata;
    $(function(){
       $('#submit').click(function(){
         agency = [];
         formdata = {};
           $('.agency-item.active').each(function(i,elm){
               agency.push($(elm).data('val'));
           });
         formdata['industries[_ids]'] = agency;
//         formdata['industries'] = agency;
         var extra_industry = $('#extra_industry').val();
         if(extra_industry !==''&&$('#extra_industry').parent().hasClass('active')){
              formdata.ext_industry = extra_industry;
         }
//         console.log(formdata.industries);
           if(Object.keys(formdata).length>0){
               //对象长度判断
               $.post('/user/register-business',formdata,function(res){
                   if(res.status===true){
                        if($.util.isAPP){
                            $.util.setCookie('token_uin',res.token_uin,10*365*24*60);
                            LEMON.db.set('token_uin',res.token_uin);
                        }
                       window.location.href = res.url;
                   }else{
                       $.util.alert(res.msg);
                   }
               },'json');
           }else{
               $.util.alert('请先选择行业标签');
           }
       });
    });
</script>
<?php
$this->end('script');
