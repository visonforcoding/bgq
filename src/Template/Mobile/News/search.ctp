<?= $this->element('header'); ?>
<div class="fixedwraper">
    <div class='h-news-search'>
        <a href='javascript:void(0);' class='iconfont news-serch'>&#xe613;</a>
        <form id="searchForm" onsubmit="return false;" style="width:100%;">
        <h1><input type="text" placeholder="请输入关键词" name="keyword"></h1>
        <input type="hidden" name="industry_id" value="" style="display:none;"/>
        <input type="hidden" name="sort" value="" style="display:none;"/>
        </form>
        <div class='h-regiser' id="doSearch" style="position: relative;right: 0;font-size: 0.28rem;width:1.2rem; padding: 0.1rem 0 0.12rem;color:#fff;background: #dd1f4b;border-radius: 0.1rem;
    text-align: center;">搜 索</div>
    </div>
    <div class="news-classify">
        <div class="classify-l fl ml" id="choose_industry" style="width:50%;">
            <span id="choose_industries">选择行业</span>
            <ul class="all-industry" hidden id="choose_industry_ul">
                <?php foreach ($industries as $k => $v): ?>
                    <?php if ($v['pid'] == 0): ?>
                        <li id="parent_<?= $v['id'] ?>"><a href="javascript:void(0)"><?= $v['name'] ?></a>
                            <?php if ($v['child']): ?>
                                <ul class="choose_industry_child_ul" hidden>
                                    <?php foreach ($v['child'] as $key => $val): ?>
                                        <li id="child_<?= $v['id'] ?>" value="<?= $val['id'] ?>" class="choose_industry_child_li"><a href="javascript:void(0)"><?= $val['name'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="classify-r fr" id="choose_sort" style="width:50%;">
            <span id="choose_sorts">排序</span>
            <ul class="sort-mark" hidden id="sort_mark">
                <li id="sort_mostapply" value="read_nums" class="choose_sort_child"><a href="javascript:void(0)">阅读最多</a></li>
                <li id="sort_recently" value="create_time" class="choose_sort_child"><a href="javascript:void(0)">最近更新</a></li>
            </ul>
        </div>
    </div>
    <div id="search"></div>
</div>
<div id="buttonLoading" class="loadingbox"></div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<!--<script type="text/html" id="search_tpl">
    <div class="innercon">
        <a href="/news/view/{#id#}" class="clearfix">
            <span class="my-pic-acive"><img src="{#cover#}"/></span>
            <div class="my-collection-items">
                <h3>{#title#}</h3>
                <span>{#address#}</span>
                <span>{#time#}</span>
            </div>
        </a>
    </div>
</script>-->
<script type="text/html" id="search_tpl">
    <section class="news-list-items" style="padding-bottom: 0.2rem;background: #fff;">
    <h1 class="firstnews"><span><img src="{#avatar#}" /></span>{#author#}</h1>
        <a href="/news/view/{#id#}" class="newsbox clearfix">
            <div class="sec-news-l">
                <h3>{#title#}</h3>
                <p>{#summary#}</p>
            </div>
            <div class="sec-news-r">
                <img src="{#cover#}"/>
            </div>
        </a>
    </section>
</script>
<script src="/mobile/js/news_search.js"></script>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                if (page === 9999) {
                    $('#buttonLoading').html('亲，没有更多资讯了');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.ajax({
                    type: 'post',
                    url: '/news/getMoreSearch/' + page,
                    data: $('#searchForm').serialize(),
                    dataType: 'json',
                    success: function (msg) {
                        console.log('page~~~' + page);
                        $.util.hideLoading('buttonLoading');
                        window.holdLoad = false;  //打开加载锁  可以开始再次加载
                        if (!msg.status) {  //拉不到数据了  到底了
                            page = 9999;
                            return;
                        }
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                var html = $.util.dataToTpl('', 'search_tpl', msg.data , function (d) {
                                    d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                    d.author = d.user.truename;
                                    return d;
                                });
                                $('#search').append(html);
                                page++;
                            }
                        }
                    }
                });
            });
        });
    }, 2000);
</script>
<?php
$this->end('script');
