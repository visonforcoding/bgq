
<body>
    <div class="wraper a-wraper">
        <div class="a-search-box" id="search">
            <a href="/activity/search"> 
                <div class="a-search">
                    <i class="iconfont">&#xe613;</i>
                    <div class="s-con">
                        <input type="text" placeholder="请输入关键词" readonly class="search" />
                    </div>
                </div>
            </a>
        </div>
        <div class="a-banner">
            <ul class="pic-list-container" id="imgList"></ul>
            <div class="yd" id="imgTab"></div>
        </div>
        <div id="activity"></div>
        <div id="buttonLoading" class="loadingbox"></div>
        <div class="submitbtn subactivity" id="release">
            <img src="/mobile/images/as.png">
        </div>
    </div>
</body>
<script type="text/html" id="activity_tpl">
    <section class='news-list-items'>
        <div class="active-items">
            <a href="/activity/details/{#id#}" class="a-head">
               <div><img src="{#cover#}"/></div>
                <h3>{#title#}</h3>
            </a>
            <div class="a-bottom">
                <span class="a-address">
                    {#address#}
                    {#apply_msg#}
                </span>
                <div class="a-other-info">
                    <span class="a-number">{#apply_nums#}人报名</span>
                    {#region_name#}{#industries_name#}
                    <span class="a-date">{#time#}</span>
                </div>
            </div>
        </div>
    </section>
</script>
<script type="text/html" id="subTpl">
    <a href="javascript:void(0);">{#name#}</a>
</script>
<script type="text/html" id="bannerTpl">
    <li><a href="{#url#}"><img back_src="{#img#}"/></a></li>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script src="/mobile/js/activity_index.js"></script>
<script>
    if($.util.isAPP){
        $('#search').css({'top':'0.6rem'});
    } else if($.util.isWX) {
        $('#search').css({'top':'0.2rem'});
    }
</script>
<script>
    $.getJSON('/activity/get-banner',function(res){
        if(res.status){
            var tab=[], html = $.util.dataToTpl('', 'bannerTpl', res.data, function (d) {
                tab.push('<span></span>');
                return d;
            });
            $('#imgList').html(html);
            $('#imgTab').html(tab.join(''));
            var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'));
        }
    });
    
    $.getJSON('/activity/getMoreActivity/1', function (res) {
        if (res.status) {
            var html = $.util.dataToTpl('', 'activity_tpl', res.data, function (d) {
                d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span class="is-apply">已报名</span>';
                d.industries_name = $.util.dataToTpl('', 'subTpl', d.industries);
                d.region_name = d.region ? '<a>' + d.region.name + '</a>' : '';
                d.cover = d.thumb ? d.thumb : d.cover;
                return d;
            });
            $('#activity').append(html);
        }
    });
    window.isApply = ',' + <?= $isApply ?> + ',';
    $.util.searchHide();
</script>
<?php
$this->end('script');
