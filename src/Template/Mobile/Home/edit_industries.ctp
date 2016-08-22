<div id="app" class="wraper">
    <h1 class='choose-org-type innerwaper'>请选择业务标签(最多4个)</h1>
        <?php foreach ($industries as $key => $industry): ?>
        <div class="items">
            <div class="orgtitle  innerwaper">
                <span class="orgname"><?= $industry['name'] ?></span>
            </div>
            <?php if (!empty($industry['children'])): ?>
                <div class="orgmark">
                    <?php foreach ($industry['children'] as $item): ?>
                    <a class="agency-item <?php if(in_array($item['id'], $userIndustry)): ?>active<?php endif; ?>" data-val="<?=$item['id']?>" href="#this" ><?= $item['name'] ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($key < (count($industries) - 1)): ?>
            <div class='h20'></div>
        <?php endif; ?>
    <?php endforeach; ?>
    <a href="javascript:void(0)" id="submit" class='nextstep'>保存</a>
</div>
<?php $this->start('script') ?>
<!--<script src="/mobile/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>-->
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>
<script>
    var agency,formdata;
    $(function(){
       $('#submit').on('tap', function(){
        agency = [];
        formdata = {};
          $('.agency-item.active').each(function(i,elm){
              agency.push($(elm).data('val'));
          });
        formdata['industries[_ids]'] = agency;
        if(formdata['industries[_ids]'].length>4){
           $.util.alert('行业标签最多只能选择4个');
           return;
        }
//         formdata['industries'] = agency;
         var extra_industry = $('#extra_industry').val();
         if(extra_industry !==''&&$('#extra_industry').parent().hasClass('active')){
              formdata.ext_industry = extra_industry;
         }
//         console.log(formdata.industries);
           if(formdata['industries[_ids]'].length>0){
               //对象长度判断
               $.post('/home/save-industries',formdata,function(res){
                   if(res.status===true){
                       $.util.alert(res.msg);
                       setTimeout(function(){
                           window.location.href = '/home/edit-userinfo';
                       },2000);
                   }else{
                       $.util.alert(res.msg);
                   }
               },'json');
           }else{
               $.util.alert('请先选择您所在行业标签');
           }
       });
    });
    
    $('.items>.orgmark>a').on('tap', function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        } else {
            $(this).addClass('active');
        }
    });
    
    $('.orgname').on('tap', function(){
        if($(this).hasClass('bgorgname')){
            $(this).removeClass('bgorgname');
            $(this).parents('.orgtitle').siblings().show(200);
        } else {
            $(this).addClass('bgorgname');
            $(this).parents('.orgtitle').siblings().hide(200);
        }
    });
</script>
<?php
$this->end('script');
