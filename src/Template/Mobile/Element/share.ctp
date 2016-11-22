<a href="javascript:void(0)" id="open_app_url">
<!--    <div class="transmitpage clearfix" hidden id="share_download">
        <div>
            <h1><img src="/mobile/images/logo-wx.png"></h1>
            <h3>并购帮<span>并购人的生活方式</span></h3>
        </div>
        <span class="green-btn">立即下载</span>
    </div>-->
    <div class="transmitpage clearfix" hidden id="share_download">
        <div>
            <h1><img src="/mobile/images/logo-wx.png"/></h1>
            <h3><span>来这里 ，圈子就活了！</span></h3>
        </div>
        <span class="green-btn" id="open_app">打开并购帮</span>
    </div>
</a>
<script>
    setTimeout(function(){
        if ($.util.getParam('share') == 1 && !$.util.isAPP) {
            $('#share_download').show();
        }
        $('#open_app').on('click', function(){
            location.href = 'com.chinamatop://main/param?url='+encodeURI(document.URL);
            setTimeout(function(){
                $('#open_app_url').attr('href', '/Wx/share-download/<?= $table ?>/<?= $id ?>');
                $('#open_app').html('立即下载');
            }, 500);
        });
        if($.util.getParam('jump') && !$.util.isAPP){
            location.href = 'com.chinamatop://main/param?url='+encodeURI(document.URL);
        }
    }, 1000);
    
</script>
