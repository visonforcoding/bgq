<header>
    <div class='inner'>
        <a href='#this' class='toback iconfont news-serch' id="toback">&#xe613;</a>
        <h1>
            <form action="" method="post">
                <input type="text" placeholder="请输入关键词" name="keyword" value="<?php if($keyword){echo $keyword;} ?>" />
                <input type="hidden" name="industry_id" value="" style="display:none;"/>
                <input type="hidden" name="sort" value="" style="display:none;"/>
            </form>
        </h1>
        <a href="/activity/index" class='h-regiser'>取消</a>
    </div>
</header>
<div class="fixedwraper" >

    <div class="news-classify">
        <div class="classify-l fl ml" id="choose_industry">
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

        <div class="classify-r fr" id="choose_sort">
            <span id="choose_sorts">排序</span>
            <ul class="sort-mark" hidden id="sort_mark">
                <li id="sort_mostapply" value="apply_nums" class="choose_sort_child"><a href="javascript:void(0)">报名最多</a></li>
                <li id="sort_recently" value="create_time" class="choose_sort_child"><a href="javascript:void(0)">最近更新</a></li>
            </ul>
        </div>
    </div>
    <div id="search">
    <?php if ($search): ?>
        <section class="my-collection-info" style="padding-bottom: 0.2rem;margin-bottom: 1rem;background: #fff;">
            <?php foreach ($search as $k => $v): ?>
                <div class="innercon">
                    <a href="/activity/details/<?= $v['id']; ?>" class="clearfix">
                        <span class="my-pic-acive"><img src="<?= $v['cover'] ?>"/></span>
                        <div class="my-collection-items">
                            <h3><?= $v['title'] ?></h3>
                            <?php if ($isApply): ?>
                                <?php if (in_array($v['id'], $isApply)): ?>
                                    <span><i>已报名</i></span>
                                <?php endif; ?>
                            <?php endif; ?>
                            <span><?= $v['address'] ?></span>
                            <span><?= $v['time'] ?><i><?= $v['apply_nums'] ?>人报名</i></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
    </div>
</div>
<div id="buttonLoading" class="loadingbox"></div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script type="text/html" id="search_tpl">
    <section class="my-collection-info" style="padding-bottom: 0.2rem;margin-bottom: 1rem;background: #fff;">
            <div class="innercon">
                <a href="/activity/details/{#id#}" class="clearfix">
                    <span class="my-pic-acive"><img src="{#cover#}"/></span>
                    <div class="my-collection-items">
                        <h3>{#title#}</h3>
                        {#apply_msg#}
                        <span>{#address#}</span>
                        <span>{#time#}<i>{#aplly_nums#}人报名</i></span>
                    </div>
                </a>
            </div>
    </section>
</script>
<script src="/mobile/js/activity_search.js"></script>
<script>
    <?php if($alert): ?>
        setTimeout(function (){
            $.util.alert('<?= $alert; ?>');
        },500);
    <?php endif; ?>
    
    <?php if($is_apply): ?>
    window.isApply = ',' + <?= $is_apply ?> + ',';
    <?php endif; ?>
    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                if (page === 9999) {
                    $('#buttonLoading').html('亲，没有更多资讯了');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.getJSON('/activity/getMoreSearch/' + page + '/' + $('input[name="industry_id"]').val() + '/' + $('input[name="sort"]').val() + '/' + $('input[name="keyword"]').val(), function (res) {
                    $.util.hideLoading('buttonLoading');
                    window.holdLoad = false;  //打开加载锁  可以开始再次加载

                    if (!res.status) {  //拉不到数据了  到底了
                        page = 9999;
                        return;
                    }

                    if (res.status) {
                        var html = $.util.dataToTpl('', 'search_tpl', res.data, function (d) {
                            d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span><i>已报名</i></span>';
                            return d;
                        });
                        $('#search').append(html);
                        page++;
                    }
                });
            });
        });
    }, 2000);
</script>
<?php
$this->end('script');
