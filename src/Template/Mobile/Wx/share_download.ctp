<div class="wraper">
    <div class="d-page">
        <div class="block">
            <h1><img src="/mobile/images/logo-wx.png" alt="" /></h1>
            <p>并购圈</p>
            <p>并购人的生活方式</p>
        </div>
        <div class="d-down block">
            <a href="com.chinamatop://main/param?url=<?= $url ?>"><span></span>立刻打开</a>
            <a href="javascript:void(0)" id="download"><span></span>立刻下载</a>
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
    $('download').on('tap', function(){
        
    });
</script>
<?php $this->end('script'); 