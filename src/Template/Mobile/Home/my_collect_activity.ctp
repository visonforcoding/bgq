<header>
    <div class='inner'>
        <a href='/home/index' class='toback'></a>
        <h1>
            我的收藏
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="inner">
        <div  class="inner my-home-menu" >
            <a href="#this" class="active">活动</a>
            <a href="/home/my-collect-news">资讯</a>
        </div>
    </div>
    <section class="my-collection-info">
        <div class="innercon">
            <a href="#this" class="clearfix">
                <span class="my-pic-acive"><img src="../images/newspic1.png"/></span>
                <div class="my-collection-items">
                    <h3>2016年中国国际体育融资总裁年会</h3>
                    <span>深圳市福田区东海国际公寓</span>
                    <span>04月28日 - 04月30日 <i>601人报名</i></span>
                </div>
            </a>
        </div>
        <div class="innercon">
            <a href="#this" class="clearfix">
                <span class="my-pic-acive"><img src="../images/newspic1.png"/></span>
                <div class="my-collection-items">
                    <h3>2016年中国国际体育融资总裁年会</h3>
                    <span>深圳市福田区东海国际公寓</span>
                    <span>04月28日 - 04月30日 <i>601人报名</i></span>
                </div>
            </a>
        </div>
        <div class="innercon">
            <a href="#this" class="clearfix">
                <span class="my-pic-acive"><img src="../images/newspic1.png"/></span>
                <div class="my-collection-items">
                    <h3>2016年中国国际体育融资总裁年会</h3>
                    <span>深圳市福田区东海国际公寓</span>
                    <span>04月28日 - 04月30日 <i>601人报名</i></span>
                </div>
            </a>
        </div>
        <div class="innercon">
            <a href="#this" class="clearfix">
                <span class="my-pic-acive"><img src="../images/newspic1.png"/></span>
                <div class="my-collection-items">
                    <h3>2016年中国国际体育融资总裁年会</h3>
                    <span>深圳市福田区东海国际公寓</span>
                    <span>04月28日 - 04月30日 <i>601人报名</i></span>
                </div>
            </a>
        </div>
        <div class="innercon">
            <a href="#this" class="clearfix nobottom">
                <span class="my-pic-acive"><img src="../images/newspic1.png"/></span>
                <div class="my-collection-items">
                    <h3>2016年中国国际体育融资总裁年会</h3>
                    <span>深圳市福田区东海国际公寓</span>
                    <span>04月28日 - 04月30日 <i>601人报名</i></span>
                </div>
            </a>
        </div>
    </section>	
</div>
<script type="text/html" id="listTpl">
    <div class="innercon">
        <a href="/activity/details/{#id#}" class="clearfix nobottom">
            <span class="my-pic-acive"><img src="{#cover#}"/></span>
            <div class="my-collection-items">
                <h3>{#title#}</h3>
                <span>{#address#}</span>
                <span>{#time#} <i>{#apply_nums#}人报名</i></span>
            </div>
        </a>
    </div>
</script>
<?php $this->start('script'); ?>
<script>
    if(LEMON.isAPP)
    {
        LEMON.sys.back('/home/index');
    }
    
    $.util.dataToTpl('activity', 'listTpl',<?= $activityjson ?>, function (d) {
        return d;
    });
</script>
<?php $this->end('script');