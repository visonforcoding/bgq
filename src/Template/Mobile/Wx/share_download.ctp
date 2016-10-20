<div class="wraper">
    <div class="d-page">
        <div class="block">
            <h1><img src="/mobile/images/logo-wx.png" alt="" /></h1>
            <p>并购帮</p>
            <p>并购人的生活方式</p>
        </div>
        <div class="d-down block" id="downbtn">
            <a id="download" href="com.chinamatop://main/param?url=http://m.chinamatop.com/<?= $url ?>"><span></span>在app中打开</a>
            <!--<a href="javascript:void(0)" id="download"><span></span>立刻下载</a>-->
            <p>or</p>
        </div>

        <div class="block wxsao">
            <img src="/mobile/images/wx.png"/>
            <p>关注我们的微信公众号</p>
        </div>

    </div>
</div>
<?php $this->start('script'); ?>
<script>
    $('#download').on('tap', function(){
        var em = this;
        if($.util.isWX){
            $.util.alert('请在浏览器中打开此页面');
            return;
        }
        setTimeout(function(){
            $.util.alert('你还没有安装app,请先下载安装。');
            $(em).html('立即下载');
            if($.util.isAndroid){
                em.href = '/mobile/app/bgq.apk';
            }
            else if($.util.isIOS){
                em.href = 'https://itunes.apple.com/us/app/bing-gou-bang/id1156402644';
//                $.util.alert('app即将上架app store,请耐心等待');
            }
        }, 300);
    });

    if($.util.getParam('downbtn')) $('#downbtn').html('<a href="https://itunes.apple.com/us/app/bing-gou-bang/id1156402644"><span>IOS下载</span></a><a href="/mobile/app/bgq.apk"><span>安卓下载</span></a>');
</script>
<?php $this->end('script'); 