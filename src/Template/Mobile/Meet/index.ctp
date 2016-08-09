<header>
    <div class='inner'>
        <h1>
            专家约见
        </h1>
        <a href="#this" class='iconfont news-serch h-regiser'>&#xe618;</a>
    </div>
</header>

<div class="wraper newswraper">
    <div class="a-search-box" id="search">
        <a href="/meet/search">
            <div class="a-search">
                <i class="iconfont">&#xe618;</i>
                <div class="s-con">
                    <input type="text" placeholder="请输入关键词" readonly class='search'/>
                </div>
            </div>
        </a>
    </div>
    <div class="a-banner" >
        <ul class="pic-list-container" id="imgList">
            <?php foreach ($banners as $k=>$v): ?>
            <li><a href="<?= $v['url'] ?>"><img src="<?= $v['img'] ?>"/></a></li>
            <?php endforeach; ?>
        </ul>
        <div class="yd" id="imgTab">
            <?php foreach ($banners as $v): ?>
            <span></span>
            <?php endforeach; ?>
        </div>
    </div>
    <!--分类--start-->
    <div class="menusort clearfix">
        <div class="allmenu">
            <div class="menulist clearfix" >
                
                <a href="/meet/moreIndustries/4">
                    <i class="iconfont">&#xe636;</i>
                    <span>医疗健康</span>
                </a>
                <a href="/meet/moreIndustries/5">
                    <i class="iconfont">&#xe635;</i>
                    <span>互联网</span>
                </a>
                <a href="/meet/moreIndustries/6">
                   <i class="iconfont">&#xe637;</i>
                    <span>大消费</span>
                </a>
                <a href="/meet/moreIndustries/7">
                    <i class="iconfont">&#xe63b;</i>
                    <span>文化传媒</span>
                </a>
                <a href="/meet/moreIndustries/8">
                    <i class="iconfont">&#xe63c;</i>
                    <span>工业4.0</span>
                </a>
                <a href="/meet/moreIndustries/9">
                    <i class="iconfont">&#xe63d;</i>
                    <span>新能源</span>
                </a>
                <a href="/meet/moreIndustries/10">
                    <i class="iconfont">&#xe63f;</i>
                    <span>新材料</span>
                </a>
                <a href="/meet/moreIndustries/11">
                    <i class="iconfont">&#xe638;</i>
                    <span>节能环保</span>
                </a>
                 <a href="/meet/moreIndustries/11">
                    <i class="iconfont">&#xe640;</i>
                    <span>定增基金</span>
                </a>
                <a href="/meet/industries">
                    <i class="iconfont">&#xe64f;</i>
                    <span>更多</span>
                </a>
            </div>
        </div>
        <!-- <a href="javascript:void(0);" class="sele-r" id="toRight"></a> -->
    </div>
    <!--分类--end-->
    
    <div class="dk">
        <ul id='items'>
            <?php foreach($biggieAd as $k=>$v): ?>
            <li><a href="/meet/view/<?= $v['savant']['user_id'] ?>"><img src="<?= $v['url'] ?>"/></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id='biggie'></div>
    <div id="buttonLoading" class="loadingbox"></div>
</div>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/meet/view/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/meet/view/{#id#}">
                    <h3><div class="l-name">{#truename#}</div>{#city#}<span class="meetnum">{#meet_nums#}人见过</span></h3>
                    <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                </a>
                <div class="mark bgblue">
                    {#subjects#}
                </div>
            </div>
        </div>
    </section>
</script>
<script type='text/html' id='subTpl'>
    <a href="/meet/subject_detail/{#id#}">{#title#}</a>
</script>
<script type='text/html' id='mySubTpl'>
    <a href="/meet/subject/{#id#}">{#title#}</a>
</script>
<?=$this->element('footer');?>
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    window.user_id = "<?= $user_id ?>";
</script>
<script>
    if($.util.isAPP){
        $('#search').css({'top':'0.6rem'});
    } else if($.util.isWX) {
        $('#search').css({'top':'0.2rem'});
    }
</script>
<script>
    $.util.dataToTpl('biggie', 'biggie_tpl',<?= $meetjson ?>, function (d) {
        d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
        d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
        if(window.user_id == d.id){
            d.subjects = $.util.dataToTpl('', 'mySubTpl', d.subjects);
        } else {
            d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
        }
        return d;
    });
    
    var page = 2;
    setTimeout(function(){
    $(window).on("scroll", function () {
        $.util.listScroll('items', function () {
            if(page == 9999){
                $('#buttonLoading').html('亲，没有更多条目了，请看看其他的栏目吧');
                return;
            }
            $.util.showLoading('buttonLoading');
            $.getJSON('/meet/getMoreBiggie/'+page,function(res){
                console.log('page~~~'+page);
                $.util.hideLoading('buttonLoading');
                window.holdLoad = false;  //打开加载锁  可以开始再次加载

                if(!res.status) {  //拉不到数据了  到底了
                    page = 9999;
                    return;
                }

                if(res.status){
                    var html = $.util.dataToTpl('', 'biggie_tpl', res.data, function (d) {
                        d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
                        d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
                        d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
                        return d;
                    });
                    $('#biggie').append(html);
                    page++;
                }
            });
        });
    });
    }, 2000);
    
    //轮播
    var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'),$('.a-banner'));
    //var loop2 = $.util.loopImg($('#items'), $('#imgList li'));


    // setTimeout(function(){
    //     var iconLoop = new simpleScroll({viewDom:$('#icons'),  moveDom:$('#allsort'), right:$('#toRight'), fix:25});
    // },1000);

    var sub = null;

    setTimeout(function(){
        sub = $.util.loop({
                min : 3,
                moveDom: $('#items'),
                moveChild: $('#items li'),
                lockScrY: true,
                loopScroll: true,
                autoTime:0,
               viewDom:$('.dk'),
            });
   },0)

    $.util.searchHide();
</script>
<?php $this->end('script');