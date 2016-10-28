<div class="wraper">
    <div class="bgb_down_des">
        <div class="down_app">
            <div class="down_logo"><img src="/mobile/images/logo-wx1.png"/></div>
            <h1>并购帮</h1>
            <h3>并购菁英汇出品</h3>
            <div class="downbtn">
                <a href="javascript:void(0);" class="downbtn_items ios_down" id="ios"><i class='iconfont'>&#xe65c;</i>APP Store</a>
                <a href="javascript:void(0);" class="downbtn_items android_down" id="android"><i class='iconfont'>&#xe659;</i>Android</a>
            </div>
            <h3 class="down_title_des">海量项目免费对接</h3>
            <div class="down_logo_bottom"><img src="/mobile/images/wx_down.jpg"/></div>
        </div>
    </div>
</div>
<div class="reg-shadow" hidden id="shadow"></div>
<div class="sharetowx" hidden id="share_wx">
    <div class="point">
        <img src="/mobile/images/sharetowx.png"/>
    </div>
</div>
<?php $this->start('script'); ?>
<script>
//    $('#download').on('tap', function(){
//        var em = this;
//        if($.util.isWX){
//            $.util.alert('请在浏览器中打开此页面');
//            return;
//        }
//        setTimeout(function(){
//            $.util.alert('你还没有安装app,请先下载安装。');
//            $(em).html('立即下载');
//            if($.util.isAndroid){
//                em.href = '/mobile/app/bgq.apk';
//            }
//            else if($.util.isIOS){
//                em.href = 'https://itunes.apple.com/us/app/bing-gou-bang/id1156402644?l=zh&ls=1&mt=8';
////                $.util.alert('app即将上架app store,请耐心等待');
//            }
//        }, 300);
//    });

    $('#ios').on('click', function(){
        if($.util.isWX){
            $('#shadow').show();
            $('#share_wx').show();
            return;
        }
        if($.util.isAndroid){
            $.util.alert('请下载安卓的安装包');
            return;
        }
        if($.util.isIOS){
            location.href = 'https://itunes.apple.com/us/app/bing-gou-bang/id1156402644?l=zh&ls=1&mt=8';
        }
    });
    
    $('#android').on('click', function(){
        if($.util.isWX){
            $('#shadow').show();
            $('#share_wx').show();
            return;
        }
        if($.util.isIOS){
            $.util.alert('请下载苹果的安装包');
            return;
        }
        if($.util.isAndroid){
            location.href = '/mobile/app/bgq.apk';
        }
    });

//    if($.util.getParam('downbtn')) $('#downbtn').html('<a href="https://itunes.apple.com/us/app/bing-gou-bang/id1156402644"><span>IOS下载</span></a><a href="/mobile/app/bgq.apk"><span>安卓下载</span></a>');
</script>
<?php $this->end('script'); 
