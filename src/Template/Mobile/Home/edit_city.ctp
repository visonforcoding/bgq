<div id="app" class="wraper">
    <!--<h1 class='choose-org-type innerwaper'>请选择所在城市</h1>-->
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">所在城市</span>
        </div>
        <div class="orgmark">
<!--            <a href="javascript:void(0)" city_name="北京" class="<?php if($city === '北京'): ?>active<?php endif; ?>">北京</a>
            <a href="javascript:void(0)" city_name="上海" class="<?php if($city === '上海'): ?>active<?php endif; ?>">上海</a>
            <a href="javascript:void(0)" city_name="广州" class="<?php if($city === '广州'): ?>active<?php endif; ?>">广州</a>
            <a href="javascript:void(0)" city_name="深圳" class="<?php if($city === '深圳'): ?>active<?php endif; ?>">深圳</a>
            <a href="javascript:void(0)" city_name="武汉" class="<?php if($city === '武汉'): ?>active<?php endif; ?>">武汉</a>
            <a href="javascript:void(0)" city_name="成都" class="<?php if($city === '成都'): ?>active<?php endif; ?>">成都</a>
            <a href="javascript:void(0)" city_name="重庆" class="<?php if($city === '重庆'): ?>active<?php endif; ?>">重庆</a>
            <a href="javascript:void(0)" city_name="杭州" class="<?php if($city === '杭州'): ?>active<?php endif; ?>">杭州</a>-->
            <?php foreach($region as $k=>$v): ?>
                <a href="javascript:void(0)" city_name="<?= $v->name ?>" class="<?php if($city === $v->name): ?>active<?php endif; ?>"><?= $v->name ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <a href="javascript:void(0)" id="submit" class='nextstep'>保存</a>
</div>
<?php $this->start('script') ?>
<!--<script src="/mobile/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>-->
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>
<script>
    var city;
    $(function () {
        $('#submit').on('tap', function () {
            city = $('.orgmark .active').attr('city_name');
            if(city){
                
            } else {
                city = $('#extra_city').val();
                if(!city){
                    $.util.alert('请选择所在城市');
                    return;
                }
            }
            $.post('/home/save-city', {city:city}, function (res) {
                if (res.status === true) {
                    $.util.alert(res.msg);
                    setTimeout(function () {
                        window.location.href = '/home/edit-userinfo';
                    }, 2000);
                } else {
                    $.util.alert(res.msg);
                }
            }, 'json');
        });
    });

    $('.items>.orgmark>a').on('tap', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('.items>.orgmark>a').removeClass('active');
            $(this).addClass('active');
        }
    });

    $('.orgname').on('tap', function () {
        if ($(this).hasClass('bgorgname')) {
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
