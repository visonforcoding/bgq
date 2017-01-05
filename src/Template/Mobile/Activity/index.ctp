
<body>
    <div class="meet_search_box flex flex_center innercon">
        <div class="search-content flex">
            <i class="iconfont">&#xe602;</i>
            <form id="searchForm" method="post">
                <input type="text" placeholder="搜索" name='keyword' />
            </form>
        </div>
    </div>
    <div class="wraper" id='wraper'>
        <div id="top_block"></div>
        <div class="a-banner">
            <ul class="pic-list-container" id="imgList"></ul>
            <div class="yd" id="imgTab"></div>
        </div>
         <!--分类--start-->
        <div class="menusort a_menusort clearfix">
            <div class="allmenu">
                <div class="menulist clearfix" id="allsort">
                    <a href="/activity/search/0">
                        <i class="iconfont">&#xe698;</i>
                        <span>沙龙论坛</span>
                    </a>
                    <a href="/activity/search/1">
                        <i class="iconfont">&#xe699;</i>
                        <span>生活聚会</span>
                    </a>
                    <a href="/activity/search/2">
                       <i class="iconfont">&#xe69a;</i>
                        <span>学习培训</span>
                    </a>
                    <a href="/activity/search/3">
                        <i class="iconfont">&#xe69b;</i>
                        <span>招聘服务</span>
                    </a>
            </div>
            </div>
        </div>
            <!--分类--end-->
        <div id="activity" style='border-bottom:1px #e5e5e5 solid;'></div>
        <div id="buttonLoading" class="loadingbox"></div>
        <div style="height: 1.2rem; display: none;" id="iosBottom"></div>
        
    </div>
     <div class="submitbtn subactivity">
            <div class="back_to_top" id="toTop" onclick="javascript:window.scrollTo(0, 0);" style="display: none"><i class="iconfont">&#xe664;</i></div>
            <div class="submit_require" id="release"><a href="javascript:$.util.checkLogin('/activity/release');">发布<br />需求</a></div>
        </div>
</body>
<script type="text/html" id="activity_tpl">
    <section class='news-list-items'>
        <div class="active-items">
            <a href="/activity/details/{#id#}" class="a-head">
                <div class="conbox">
                    {#img#}
                    <div class="status">{#apply_msg#}{#pass_msg#}</div>
                </div>
                <h3>{#title#}</h3>
                
            </a>
            <div class="a-bottom">
                <span class="a-address">
                    {#address#}
                </span>
                <div class="a-other-info">
                    <a href="/activity/search/{#series_id#}">{#series_name#}</a>
                    <span class="a-number" style="{#display#}">{#apply_nums#}人报名</span>
                    {#region_name#}
                    <span class="a-date">{#activity_time#}</span>
                </div>
            </div>
        </div>
    </section>
</script>
<!--<script type="text/html" id="subTpl"> 
    <a href="/activity/search">{#name#}</a>
</script>-->
<script type="text/html" id="bannerTpl">
    <li><a href="{#url#}"><img back_src="{#img#}"/></a></li>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script src="/mobile/js/activity_index.js"></script>
<script>
    if ($.util.isAPP) {
        $('#search').css({'top': '0.6rem'});
        $('#top_block').css({'height': '68px'});
        $('.meet_search_box').css({'padding-top': '20px', 'height': '68px'});
    } else if ($.util.isWX) {
        $('#search').css({'top': '0.2rem'});
        $('#top_block').css({'height': '48px'});
        $('.meet_search_box').css({'padding-top': '0', 'height': '48px'});
    }
</script>
<script>
    window.isApply = ',' + '<?= $isApply ?>' + ',';
    window.series = <?= json_encode($activityseries) ?>;
</script>
<script>
    if ($.util.isIOS) {
        $('#iosBottom').show();
        $('#wraper').addClass('searchwraper');
    }
    $.getJSON('/activity/get-banner', function (res) {
        if (res.status) {
            var tab = [], html = $.util.dataToTpl('', 'bannerTpl', res.data, function (d) {
                tab.push('<span></span>');
                return d;
            });
            $('#imgList').html(html);
            $('#imgTab').html(tab.join(''));
            var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'), $('.a-banner'));
        }
    });
    $.getJSON('/activity/getMoreActivity/1', function (res) {
        if (res.status) {
            $('#activity').html('');
            var html = dealData(res.data);
            $('#activity').append(html);
        }
    });
    function dealData(data) {
        var html = $.util.dataToTpl('', 'activity_tpl', data, function (d) {
            d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span class="registered">已报名</span>';
//            d.pass_msg = d.pass_time ? '<span class="registered colorbg">已过期</span>' : '';
            d.series_name = d.series_id !== '' ? window.series[d.series_id] : '';
            d.region_name = d.region ? '<a>' + d.region.name + '</a>' : '';
            d.cover = d.thumb ? d.thumb : d.cover;
            d.display = d.is_show_apply ? '' : 'display:none;';
            if(d.cover){
                d.img = '<img src="' + d.cover + '"/>';
            }
            return d;
        });
        return html;
    }

//    $.util.searchHide();
    $('#searchForm').on('submit', function(){
        if($('input[name="keyword"]').val() == ''){
            return false;
        } else {
            location.href = encodeURI('/activity/search?keyword='+$('input[name="keyword"]').val());
            return false;
        }
    });
</script>
<?php
$this->end('script');
