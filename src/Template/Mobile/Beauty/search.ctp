<link rel="stylesheet" type="text/css" href="/mobile/css/zt.css"/>
<div class="fixedwraper wraper">
    <div class='h-news-search'>
        <a href='javascript:void(0);' class='iconfont news-serch'>&#xe618;</a>
        <form action="/beauty/get-search-res/1" method="post" >
            <h1><input type="text" name="keyword" placeholder="用户名"></h1>
        </form>
        <div class="h-regiser" id="doSearch">搜 索</div>
    </div>
    <section class="z_items content_inner" id="beauty">
    </section>
    <div id="buttonLoading" class="loadingbox"></div>
</div>
<script type="text/html" id="tpl">
    <dl>
        <a href="/beauty/homepage/{#id#}">
            <dt class="posi_top"><img src="{#pic#}" alt="" /><span></span><i>{#beauty_id#}</i></dt>
            <dd class="zt_name"><span class="p_name color-items mr10">{#username#}</span><span class="p_job color-gray">{#position#}</span></dd>
            <dd class="zt_commpany">{#company#}</dd>
        </a>
        <dd class="mt20"><span class="zt_num color-items fl">{#vote_nums#}票</span><span class="fr zt_r_btn {#vote_class#}" user_id="{#user_id#}">{#vote_word#}</span></dd>
    </dl>
</script>
<?php $this->start('script'); ?>
<script type="text/javascript">
    $.util.dataToTpl('beauty_people', 'tpl', '', function (d) {
        return d;
    });
    $('#doSearch').on('tap', function () {
        if ($('input[name="keyword"]').val() == '') {
            $.util.alert('请输入内容后再搜索');
        }
        $('#beauty').html('');
        search();
    });

    $('form').on('submit', function () {
        $('#beauty').html('');
        search();
        return false;
    });

    function search() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/beauty/get-search-res/1",
            data: $('form').serialize(),
            success: function (res) {
                if (res.status) {
                    var html = dealData(res.data);
                    $('#beauty').append(html);
                    $('.vote').on('tap', function () {
                        if(!$.util.isLogin()){
                            $.util.setCookie('regist_ref', document.URL, '15');
                        }
                        var obj = $(this);
                        if(!obj.hasClass('vote')){
                            return false;
                        }
                        obj.removeClass('vote');
                        $.util.ajax({
                            url: '/beauty/vote/' + obj.attr('user_id'),
                            func: function (res) {
                                if (res.status) {
                                    obj.addClass('bggray').removeClass('vote');
                                    obj.html('已投票');
                                    obj.prev('span.zt_num').html(parseInt(obj.prev('span.zt_num').html()) + 1 + '票');
                                } else {
                                    $.util.alert(res.msg);
                                    obj.addClass('vote');
                                }
                            }
                        });
                    });
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    }

    var page = 2;
    setTimeout(function () {
        $(window).on("scroll", function () {
            $.util.listScroll('items', function () {
                if (page == 9999) {
                    $('#buttonLoading').html('亲，没有更多搜索结果了');
                    return;
                }
                $.util.showLoading('buttonLoading');
                $.getJSON('/beauty/get-search-res/' + page, function (res) {
                    console.log('page~~~' + page);
                    $.util.hideLoading('buttonLoading');
                    window.holdLoad = false;  //打开加载锁  可以开始再次加载

                    if (!res.status) {  //拉不到数据了  到底了
                        page = 9999;
                        return;
                    }

                    if (res.status) {
                        var html = dealData(res.data);
                        $('#beauty').append(html);
                        $('.vote').on('tap', function () {
                            if(!$.util.isLogin()){
                                $.util.setCookie('regist_ref', document.URL, '15');
                            }
                            var obj = $(this);
                            if(!obj.hasClass('vote')){
                                return false;
                            }
                            obj.removeClass('vote');
                            $.util.ajax({
                                url: '/beauty/vote/' + obj.attr('user_id'),
                                func: function (res) {
                                    if (res.status) {
                                        obj.addClass('bggray').removeClass('vote');
                                        obj.html('已投票');
                                        obj.prev('span.zt_num').html(parseInt(obj.prev('span.zt_num').html()) + 1 + '票');
                                    } else {
                                        $.util.alert(res.msg);
                                        obj.addClass('vote');
                                    }
                                }
                            });
                        });
                        if (res.data.length < 10) {
                            page = 9999;
                            $('#buttonLoading').html('亲，没有更多搜索结果了');
                        } else {
                            page++;
                        }
                    }
                });
            });
        });
    }, 2000);

    function dealData(data) {
        var html = $.util.dataToTpl('', 'tpl', data, function (d) {
            d.position = d.user.position;
            d.company = d.user.company;
            d.username = d.user.truename;
            d.user_id = d.user.id;
            d.pic = d.beauty_pics.length ? d.beauty_pics[0].pic_url : '';
            if (d.vote) {
                d.vote_class = 'bggray';
                d.vote_word = '已投票';
            } else {
                d.vote_class = 'vote';
                d.vote_word = '投 票';
            }
            return d;
        });
        return html;
    }
</script>
<?php
$this->end('script');
