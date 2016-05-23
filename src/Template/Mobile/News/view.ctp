<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            资讯内容
        </h1>
        <a href="#this" id="share" class='iconfont collection h-regiser'>&#xe610;</a>
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
                <span >
                    <i class="iconfont like">&#xe616;</i><?= $this->Number->format($news->praise_nums) ?>
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
    <div class="alert">
        已收藏
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
            <span>
                <b class="addnum">+1</b><i data-id="{#id#}" data-disable="{#disable#}" style="{#style#}"  class="iconfont praise">&#xe615;</i>
                <em>{#praise_nums#}</em>
            </span>
        </div>
        <p id="common_{#id#}">{#body#}</p>
    </div>
</script>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('coms', 'listTpl',<?= json_encode($news->comments) ?>, function (d) {
        //d.industries_html = $.util.dataToTpl('', 'subTpl', d.industries);
        d.user_avatar = d.user.avatar;
        d.user_truename = d.user.truename;
        d.user_company = d.user.company;
        d.user_position = d.user.position;
        d.style = '';
        d.disable = '0';
        if(d.hasOwnProperty('likes')){
            if(d['likes'].length){
                d.style= 'font-weight:bold';
                d.disable = '1';
            }
        }
        return d;
    });
    $(function () {
        $('#commit,.items').click(function () {
            
            $('.reg-shadow,.shadow-info').show('slow');
        });
        $('#cancel').click(function () {
            $('.reg-shadow,.shadow-info').hide('slow');
        });
        $('#submit').click(function () {
            var content = $('#content').val();
            if(!content){
                $.util.alert('评论内容不可为空');
                return false;
            }
            $.util.ajax({
                url: '/news/comment',
                data: {content: content, id:<?= $news->id ?>},
                func: function (res) {
                    $.util.alert(res.msg);
                    if (res.status) {
                        window.location.reload();
                    }
                }
            });
        });
        $('.praise').click(function () {
            var id = $(this).data('id');
            var obj = $(this);
            if(obj.data('disable')==='1'){
                return false;
            }
            $.util.ajax({
                url: '/news/comment-praise',
                data: {id:id},
                func: function (res) {
                    if (res.status) {
                        obj.prev('.addnum').show();
                        obj.next('em').html(parseInt(obj.next('em').text())+1);
                        obj.css('font-weight','bold');
                        obj.data('disable','1');
                        setTimeout(function(){
                            obj.prev('.addnum').hide();
                        },1000);
                    }
                }
            });
        });
    });
        $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('common_')){
            console.log($(em));
        }
        switch(em.id){
            case 'imageViewer': case 'fullImg':
                //do();
            break;
            case 'blackCover':
                //do();
                break;
            case 'detailClosePC':
                //do();
                break;
            case 'goTop':
                window.scroll(0,0);
                e.preventDefault();
                break;
        }
    });
</script>
<?php $this->end('script'); ?>