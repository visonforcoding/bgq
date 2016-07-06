<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            资讯内容
        </h1>
      <!--   <a href="#this" id="collect" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a> -->
    </div>
</header>
<div class="wraper" id="news">
    <?php if (isset($news)): ?>
        <section class="newscon-box">
            <h3><?= $news->title ?></h3>
            <h1 class="con-des"><span><img src="<?= $news->user->avatar ? $news->user->avatar : '/mobile/images/touxiang.png'  ?>" /></span><?= $news->user->truename ?>
                <time><?= $news->create_time->i18nFormat('yyyy-MM-dd HH:mm:ss') ?></time>
            </h1>
            <img src="<?= $news->cover ?>"/>
            <p><?= $news->body ?></p>
            <div class="con-bottom clearfix pd20">
                <span class="readnums">阅读<i><?= $this->Number->format($news->read_nums) ?></i></span>
                <span  data-id="<?= $news->id ?>" <?php if (isset($news->praises) && !empty($news->praises)): ?> data-disable="1" class="liked"<?php endif; ?>
                       id="news-praise" >
                    <i class="iconfont like <?php if (isset($news->praises) && !empty($news->praises)): ?>changecolor<?php endif; ?>" >&#xe616;</i><em><?= $this->Number->format($news->praise_nums) ?></em>
                </span>
            </div>
        </section>
    <?php endif; ?>
    <section class="newscomment-box mb50" >
        <h3 class="comment-title">
            评论
            <!--<span id="commit"><i  class="iconfont">&#xe618;</i>我要点评</span>-->
        </h3>
        <div id="comment"><h4 id="noComment">还没任何评论</h4></div>
        <span class='com-all' id=""><a href="#allcoment">显示全部</a></span>
    </section>
    <!--专家推荐****************-->
    <?php if ($news->savants): ?>
        <div class="expert-commond innercon">
            <ul>
                <?php foreach ($news->savants as $k => $v): ?>
                    <li>
                        <a href="/meet/view/<?= $v['user']['id'] ?>">
                            <img src="<?= $v['user']['avatar'] ? $v['user']['avatar'] : '/mobile/images/touxiang.png' ?>" alt="<?= $v['user']['truename'] ?>" />
                            <h3><?= $v['user']['truename'] ?><span><?= $v['user']['company'] ?> <?= $v['user']['position'] ?></span></h3>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <!--专家推荐****************-->
    <div style='height:1.2rem'></div>
</div>
<div class="wraper pd10" id="allcoment" style="display:none;">
    <section class="newscomment-box">
        <h3 class="comment-title">
            评论

            <span><i class="iconfont">&#xe618;</i>我要点评</span>
        </h3>
        <div id="allComments"></div>
        <div id="buttonLoading" class="loadingbox"></div>
    </section>
</div>
<!--底部四个图-->
<div class="iconlist icon-width">
    <span class="iconfont" id="commit">&#xe618;</span>
    <span class="iconfont <?php if (!$isCollect): ?>active<?php endif; ?>" id="collect">&#xe610;</span>
    <span class="iconfont" id="share">&#xe614;</span>
    <span class="iconfont" id="goTop"></span>
</div>
<!--底部四个图**end-->
<div class="reg-shadow" style="display: none;" id="comment_shadow"></div>
<!-- 评论框 -->
<div class="shadow-info a-shadow a-forword">
    <ul>
        <li><textarea id="content" type="text" placeholder="请输入评论"></textarea></li>
        <li><a id="cancel" href="javascript:void(0);">取消</a><a id="submit" href="javascript:void(0);">发表</a></li>
    </ul>
</div>
<!-- 微信分享 -->
<div class="reg-shadow" style="display: none;" id="shadow"></div>
<div class="wxshare" id="wxshare" hidden>
    <span></span>
    <p></p>
 </div>
<script type="text/html" id="listTpl">
    <div class="items">
        <div class="comm-info clearfix">
            <span><a class="alink" href="/user/home-page/{#user_id#}"><img src="{#user_avatar#}"/></a></span>
            <span class="infor-comm">
                <a href="/user/home-page/{#user_id#}"> <i class="username">{#user_truename#}<time>{#create_time#}</time></i>  </a>
                <i class="job">{#user_company#} {#user_position#}</i>
            </span>
            <span data-disable="{#disable#}" data-id="{#id#}" id="praise_{#id#}">
                <b class="addnum">+1</b>
                <i style="{#style#}" class="iconfont praise_{#id#}">&#xe615;</i>
                <em>{#praise_nums#}</em>
            </span>
        </div>
        <div class="aaaa" style="height: 100px;margin-top: 10px">
            {#body#}
        </div>

        <p data-id="{#id#}" data-userid="{#user_id#}" data-username="{#user_truename#}" id="common_{#id#}">{#body#}</p>
    </div>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    // 分享设置
    window.shareConfig.link = 'http://m.chinamatop.com/news/view/<?= $news->id ?>';
    window.shareConfig.title = '<?= $news->title ?>';
    var share_desc = '<?= $news->share_desc ?>';
    share_desc && (window.shareConfig.desc = share_desc);
    setTimeout(function(){LEMON.show.shareIco();},100);

</script>
<script>
    window.__comments = <?= json_encode($news->comments) ?>;
    window.__user_id = <?= isset($user->id) ? $user->id : 0 ?>;
    window.__id = <?= $news->id ?>;

    window.comme_submit = true;
    $('.com-all').hide();
    // 少于五条评论隐藏显示全部, 大于一条评论隐藏还没有任何评论
    var circle = setInterval(function(){
        if($('#comment').children('.items').length >= 5)
        {
            $('.com-all').show();
            clearInterval(circle);
        }
        if($('#comment').children('.items').length > 0) {
            $('#noComment').hide();
        }
    },100);
    
    var reply_id = 0;
    $.util.dataToTpl('comment', 'listTpl', window.__comments, function (d) {
        //d.industries_html = $.util.dataToTpl('', 'subTpl', d.industries);
        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
        d.user_truename = d.user.truename;
        d.user_company = d.user.company;
        d.user_position = d.user.position;
        d.user_id = d.user.id;
        if (d.pid > 0) {
            d.body = '回复<span style="color:rgba(0, 0, 0, 0.95);"> ' + d.reply.truename + ' </span>：' + d.body;
        }
        d.style = '';
        d.disable = '0';
        if (d.hasOwnProperty('likes')) {
            if (d['likes'].length) {
                d.style = 'color:red';
                d.disable = '1';
            }
        }
        return d;
    });

    setTimeout(function () {
        ii=0;
        $('body').on('touchstart', function(e){
        //$('body').on('tap', function (e) {
            var target = e.srcElement || e.target, em = target, i = 1;
            $.util.alert((ii++)+em.id+'~~'+em.className+'~~'+em.innerHTML.substr(0,5));
            //$('#commit').html((ii++)+em.id+'~~'+em.className+'~~'+em.innerHTML)
            while (em && !em.id && i <= 3) {
                em = em.parentNode;
                i++;
            }
            if (!em || !em.id)
                return;
            if (em.id.indexOf('praise_') !== -1) {
                //对评论的赞
                var id = $(em).data('id');
                var obj = $(em);
                if (obj.data('disable') === '1') {
                    return false;
                }
                $.util.ajax({
                    url: '/news/comment-praise',
                    data: {id: id},
                    func: function (res) {
                        if (res.status) {
                            console.log($('.praise_'+ id))
                            $('.praise_'+ id).siblings('.addnum').show();
                            $('.praise_'+ id).siblings('em').html(parseInt(obj.find('em').text()) + 1);
                            $('.praise_'+ id).css('color', 'red');
                            $('#praise_'+ id).data('disable', '1');
                            setTimeout(function () {
                                $('.praise_'+ id).siblings('.addnum').hide();
                            }, 1000);
                        }
                    }
                });
            }
            if (em.id.indexOf('common_') !== -1) {
                //回复评论
                var user_id = window.__user_id;
                if ($(em).data('userid') == user_id) {
                    return;
                }
                var id = $(em).data('id');
                reply_id = id;
                $('#content').attr('placeholder', '回复 ' + $(em).data('username') + '：');
                $('#comment_shadow').show('slow');
                $('.shadow-info').removeClass('m-height').addClass('c-height');
            }
            switch (em.id) {
                case 'commit':
                    //弹出评论框
                    $('#comment_shadow').show('slow');
                    $('.shadow-info').removeClass('m-height').addClass('c-height');
                    break;
                case 'cancel':
                    //关闭 评论框
                    setTimeout(function (){
                        $('#comment_shadow').hide('slow');
                        $('.shadow-info').removeClass('c-height').addClass('m-height');
                    }, 301);
                    break;
                case 'submit':
                    //提交评论
                    var content = $('#content').val();
                    if (!content) {
                        $.util.alert('评论内容不可为空');
                        return false;
                    }
                    if(window.comme_submit == true)
                    {
                        setTimeout(function(){
                            window.comme_submit = true;
                        },2000);
                        window.comme_submit = false;
                        $.util.ajax({
                            url: '/news/comment',
                            data: {reply_id: reply_id, content: content, id:window.__id},
                            func: function (res) {
                                if (res.status == true) {
                                    $.util.alert(res.msg);
                                    console.log(res.data);
                                    var html = $.util.dataToTpl('', 'listTpl', [res.data], function (d) {
                                        //d.industries_html = $.util.dataToTpl('', 'subTpl', d.industries);
                                        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                        d.user_truename = d.user.truename;
                                        d.user_company = d.user.company;
                                        d.user_position = d.user.position;
                                        if (d.pid > 0) {
                                            d.body = '回复<span style="color:rgba(31, 27, 206, 0.95);"> ' + d.reply.truename + ' </span>：' + d.body;
                                        }
                                        d.style = '';
                                        d.disable = '0';
                                        if (d.hasOwnProperty('likes')) {
                                            if (d['likes'].length) {
                                                d.style = 'color:red';
                                                d.disable = '1';
                                            }
                                        }
                                        return d;
                                    });
                                    $('#comment').prepend(html);
                                    $('#allComments').prepend(html);
                                    setTimeout(function(){
                                        $('#comment_shadow').hide('slow');
                                        $('.shadow-info').removeClass('c-height').addClass('m-height');
                                    }, 301);
                                } else
                                {
                                    $.util.alert(res.msg);
                                }
                            }
                        });
                    }
                    break;
                case 'news-praise':
                    //对文章的赞
                    var obj = $(em);
                    if (obj.data('disable') === '1') {
                        return false;
                    }
                    obj.find('i.like').toggleClass('changecolor');
                    obj.find('i.like').toggleClass('scale');
                    $.util.ajax({
                        url: '/news/news-praise',
                        data: {id:window.__id},
                        func: function (res) {
                            $.util.alert(res.msg);
                            if (res.status) {
                                obj.find('em').html(parseInt(obj.find('em').text()) + 1);
                            } else {
                                obj.find('i.like').toggleClass('changecolor');
                                obj.find('i.like').toggleClass('scale');
                                $.util.alert(msg.msg);
                            }
                        }
                    });
                    break;
                case 'collect':
                    var news_id = window.__id;
                    $.util.ajax({
                        url: '/news/collect',
                        data: {id: news_id},
                        func: function (res) {
                            $.util.alert(res.msg);
                            if (res.status) {
                                $(em).toggleClass('active');
                            }
                        }
                    });
                    break;
                case 'share':
                    if(navigator.userAgent.toLowerCase().indexOf('micromessenger') == -1)
                    {
                        LEMON.share.banner();
                    }
                    else if($.util.isWX)
                    {
                        $('#wxshare').show();
                        $('#shadow').show();
                    }
                    break;
                case 'shadow':case 'wxshare':
                    setTimeout(function(){
                        $('#shadow').hide();
                        $('#wxshare').hide();
                    }, 400);
                    break;
                case 'comment_shadow':
                    setTimeout(function(){
                        $('#comment_shadow').hide('slow');
                        $('.shadow-info').removeClass('c-height').addClass('m-height');
                    },301);
                    break;
                case 'goTop':
                    window.scrollTo(0, 0);
                    e.preventDefault();
                    break;
            }
        });
    }, 0);
    
    $(window).on('hashchange', function(){
        if(location.hash == '#allcoment'){
            $('#news').hide();
            $('#allcoment').show();
            $.ajax({
                type: 'post',
                url: '/news/showAllComment/<?= $news->id ?>',
                dataType: 'json',
                success: function (res) {
                    if (typeof res === 'object') {
                        if (res.status === true) {
                            var html = $.util.dataToTpl('allComments', 'listTpl', res.data, function (d) {
                                d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                d.user_truename = d.user.truename;
                                d.user_company = d.user.company;
                                d.user_position = d.user.position;
                                if (d.pid > 0) {
                                    d.body = '回复<span style="color:rgba(31, 27, 206, 0.95);"> ' + d.reply.truename + ' </span>：' + d.body;
                                }
                                d.style = '';
                                d.disable = '0';
                                if (d.hasOwnProperty('likes')) {
                                    if (d['likes'].length) {
                                        d.style = 'color:red';
                                        d.disable = '1';
                                    }
                                }
                                return d;
                            });
                        }
                    }
                }
            });
            var page = 3;
            setTimeout(function () {
                $(window).on("scroll", function () {
                    $.util.listScroll('items', function () {
                        if (page === 9999) {
                            $('#buttonLoading').html('亲，没有更多评论了');
                            return;
                        }
                        $.util.showLoading('buttonLoading');
                        $.getJSON('/news/getMoreComment/' + page + '/' + window.__id, function (res) {
                            $.util.hideLoading('buttonLoading');
                            window.holdLoad = false;  //打开加载锁  可以开始再次加载

                            if (!res.status) {  //拉不到数据了  到底了
                                page = 9999;
                                return;
                            }

                            if (res.status) {
                                var html = $.util.dataToTpl('', 'listTpl', res.data, function (d) {
                                    d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                    d.user_truename = d.user.truename;
                                    d.user_company = d.user.company;
                                    d.user_position = d.user.position;
                                    if (d.pid > 0) {
                                        d.body = '回复<span style="color:rgba(31, 27, 206, 0.95);"> ' + d.reply.truename + ' </span>：' + d.body;
                                    }
                                    d.style = '';
                                    d.disable = '0';
                                    if (d.hasOwnProperty('likes')) {
                                        if (d['likes'].length) {
                                            d.style = 'color:red';
                                            d.disable = '1';
                                        }
                                    }
                                    return d;
                                });
                                $('#allComments').append(html);
                                page++;
                            }
                        });
                    });
                });
            }, 2000);
        }else{
            $('#news').show();
            $('#allcoment').hide();
        }
    });
</script>
<?php $this->end('script'); ?>