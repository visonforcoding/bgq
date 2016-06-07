<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            资讯内容
        </h1>
        <a href="#this" id="collect" class='iconfont collection h-regiser'>&#xe610;</a>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
    </div>
</header>

<div class="wraper" id="news">
    <?php if (isset($news)): ?>
        <section class="newscon-box">
            <h3><?= $news->title ?></h3>
            <img src="<?= $news->cover ?>"/>
            <p><?= strip_tags($news->body) ?></p>
            <div class="con-bottom clearfix">
                <span class="readnums">阅读<i><?= $this->Number->format($news->read_nums) ?></i></span>
                <span  data-id="<?=$news->id?>" <?php if(isset($news->praises)&&!empty($news->praises)):?> data-disable="1" class="liked"<?php endif;?>
                       id="news-praise" >
                    <i class="iconfont like">&#xe616;</i><em><?= $this->Number->format($news->praise_nums) ?></em>
                </span>
            </div>
        </section>
    <?php endif; ?>
    <section class="newscomment-box" >
        <h3 class="comment-title">
            评论
            <span id="commit"><i  class="iconfont">&#xe618;</i>我要点评</span>
        </h3>
        <div id="coms">

        </div>
    </section>
    <div class="reg-shadow" style="display: none;">
    </div>
    <div class="shadow-info a-shadow a-forword" style="display: none;">
        <ul>
            <li><textarea id="content" type="text" placeholder="请输入评论"></textarea></li>
            <li><a id="cancel" href="javascript:void(0);">取消</a><a id="submit" href="javascript:void(0);">发表</a></li>
        </ul>
    </div>
</div>
<script type="text/html" id="listTpl">
    <div class="items">
        <div class="comm-info clearfix">
            <span><img src="{#user_avatar#}"/></span>
            <span class="infor-comm">
                <i class="username">{#user_truename#}</i>
                <i class="job">{#user_company#} {#user_position#}</i>
            </span>
            <span data-disable="{#disable#}" data-id="{#id#}" id="praise_{#id#}">
                <b class="addnum">+1</b>
                <i style="{#style#}" class="iconfont praise">&#xe615;</i>
                <em>{#praise_nums#}</em>
            </span>
        </div>
        <p data-id="{#id#}" data-userid="{#user_id#}" data-username="{#user_truename#}" id="common_{#id#}">{#body#}</p>
    </div>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    var reply_id = 0;
    $.util.dataToTpl('coms', 'listTpl',<?= json_encode($news->comments) ?>, function (d) {
        //d.industries_html = $.util.dataToTpl('', 'subTpl', d.industries);
        d.user_avatar = d.user.avatar;
        d.user_truename = d.user.truename;
        d.user_company = d.user.company;
        d.user_position = d.user.position;
        if(d.pid>0){
            d.body = '回复<span style="color:rgba(31, 27, 206, 0.95);"> '+d.reply.truename+' </span>：'+ d.body;
        }
        d.style = '';
        d.disable = '0';
        if (d.hasOwnProperty('likes')) {
            if (d['likes'].length) {
                d.style = 'font-weight:bold';
                d.disable = '1';
            }
        }
        return d;
    });
    setTimeout(function(){
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('praise_') !==-1) {
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
                        obj.find('.addnum').show();
                        obj.find('em').html(parseInt(obj.find('em').text()) + 1);
                        obj.find('i.praise').css('font-weight', 'bold');
                        obj.data('disable', '1');
                        setTimeout(function () {
                            obj.find('.addnum').hide();
                        }, 1000);
                    }
                }
            });
        }
        if (em.id.indexOf('common_') !==-1) {
            //回复评论
            var user_id = <?=  isset($user->id)?$user->id:0?>;
            if($(em).data('userid')==user_id){
                return;
            }
            var id = $(em).data('id');
            reply_id = id;
            $('#content').attr('placeholder','回复 '+$(em).data('username')+'：');
            $('.reg-shadow,.shadow-info').show('slow');
        }
        switch (em.id) {
            case 'commit':
                //弹出评论框
                $('.reg-shadow,.shadow-info').show('slow');
                break;
            case 'cancel':
                //关闭 评论框
                $('.reg-shadow,.shadow-info').hide('slow');
                break;
            case 'submit':
                //提交评论
                var content = $('#content').val();
                if (!content) {
                    $.util.alert('评论内容不可为空');
                    return false;
                }
                $.util.ajax({
                    url: '/news/comment',
                    data: {reply_id:reply_id,content: content, id:<?= $news->id ?>},
                    func: function (res) {
                        $.util.alert(res.msg);
                        if (res.status) {
                            window.location.reload();
                        }
                    }
                });
                break;
            case 'news-praise':
                //对文章的赞
                 var obj = $(em);
                if (obj.data('disable') === '1') {
                    return false;
                }
                $.util.ajax({
                    url: '/news/news-praise',
                    data: {id:<?= $news->id ?>},
                    func: function (res) {
                        $.util.alert(res.msg);
                        if (res.status) {
                            obj.find('em').html(parseInt(obj.find('em').text()) + 1);
                            obj.find('i.like').css('font-weight', 'bold');
                            obj.find('i.like').css('color', 'red');
                            window.location.reload();
                        }
                    }
                });
                break;
            case 'collect':
                var news_id = <?=$news->id ?>;
                $.util.ajax({
                   url:'/news/collect',
                   data:{id:news_id},
                   func:function(res){
                       $.util.alert(res.msg);
                       if(res.status){
                           
                       }
                   }
                });
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
    },0);
</script>
<?php $this->end('script'); ?>