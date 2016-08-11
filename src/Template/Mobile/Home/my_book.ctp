<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>我的约见</h1>
        <!--<a href="javascript:void(0);" class="h-regiser h-add"></a>-->
    </div>
</header>
<div class="wraper">
    <div class="inner my-home-menu" id="typeTab">
        <span type="books" <?php if($savant_books == []): ?> class="active"<?php endif; ?>>我约见</span>
        <span type="savant_books" <?php if($savant_books): ?> class="active"<?php endif; ?>>约见我</span>
    </div>
    <div  class="inner my-home-slidemenu" id="statusTab">
        <span status="1">待付款</span>
        <span status="0" class="active">确认中</span>
        <span status="3">已完成</span>
    </div>

    <div id="list">

    </div>
<script type="text/html" id="tpl">
    <section class="internet-v-info nopd">
        <a href="{#link#}{#id#}">
            <div class="innercon">
                <span class="head-img"><img src="{#user_logo#}"/>{#v#}</span>
                <div class="vipinfo my-meet-info">
                    <h3>{#truename#}
                        <time>{#time#}</time>
                        <span class="meetnum">{#meet_nums#}</span>
                    </h3>
                    <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                    <div class="mark">
                        <span class='color-items'>约见话题：{#title#}</span>
                    </div>
                </div>
            </div>
        </a>
        {#subject_status#}
        </div>
    </section>
</script>
</div>
<?php $this->start('script'); ?>
<script>
    var book_html = {books:[], savant_books:[]}, status='0', type='<?php if($savant_books == []): ?>books<?php else: ?>savant_books<?php endif; ?>';
    var books = <?=  json_encode($books)?>; var savant_books = <?=  json_encode($savant_books)?>;
</script>
<script>
    function setList(){
        if(book_html[type][status]) {
            $('#list').html(book_html[type][status]);
            return;
        }
        var data = type == 'books' ? books : savant_books, cdata=[];
        $.each(data, function(i,d){
            if(d.status == status) cdata.push(d);
        });
        if(!cdata.length){
            book_html[type][status] = '  ';
        }
        else {
            book_html[type][status] = $.util.dataToTpl('', 'tpl', cdata, function(d){
                d.link = type == 'books' ? '/home/my-book-detail/' :'/home/my-book_savant_detail/';
//                d.subject.user = d.subject.user || {};
                var user = d.subject.user?d.subject.user:d.user;
                d.user_logo = user.avatar;
                d.truename = user.truename;
                d.meet_nums = user.meet_nums+'人见过';
                d.company = user.company;
                d.position = user.position;
                d.title = d.subject.title;
                d.time = d.create_time;
                if(user.level == 2){
                    d.v = '<i></i>';
                }
                if(type == 'books'){
                    if(status === '3'){
                        if(d.is_done){
                            d.subject_status = '<div class="f-box"><div class="f-info"><span class="fl f-type"><i class="iconfont">&#xe62f;</i>已完成</span><a class="fr f-link" href="/home/my-book-detail/'+d.id+'">查看<i class="iconfont">&#xe667;</i></a></div>';
                        } else {
                            d.subject_status = '<div class="f-box"><div class="f-info"><span class="fl f-type"><i class="iconfont">&#xe62f;</i>约见中</span><a class="fr f-link" href="/home/my-book-detail/'+d.id+'">查看<i class="iconfont">&#xe667;</i></a></div>';
                        }
                    }
                } else {
                    if(status === '3'){
                        if(d.is_done){
                            d.subject_status = '<div class="f-box"><div class="f-info"><span class="fl f-type"><i class="iconfont">&#xe62f;</i>已完成</span><a class="fr f-link" href="/home/my-book_savant_detail/'+d.id+'">查看<i class="iconfont">&#xe667;</i></a></div>';
                        } else {
                            d.subject_status = '<div class="f-box"><div class="f-info"><span class="fl f-type"><i class="iconfont">&#xe62f;</i>约见中</span><a class="fr f-btn done"><span subject_id="'+d.id+'" id="subjectId_'+d.id+'">完成</span></a></div>';
                        }
                    }
                }
                return d;
            });
        }
        $('#list').html(book_html[type][status]);
    };
    
    $('.done').on('tap', function(){
        
    });

    $('body').on('tap', function (e) {
        var em = e.srcElement || e.target, tp=$(em).attr('type'), st=$(em).attr('status');
        if(tp && tp != type){
            type = tp;
            $('#typeTab span').removeClass('active');
            $(em).addClass('active');
            setList();
        }
        else if(st && st != status){
            status = st;
            $('#statusTab span').removeClass('active');
            $(em).addClass('active');
            setList();
        }
        console.log(em.id);
        if(em.id.indexOf('subjectId_') != -1){
            var id = $(em).attr('subject_id');
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/home/change_subject_status/"+id,
                success: function (res) {
                    $.util.alert(res.msg);
                    if(res.status){
                        $(em).parent('a').prev('span').html('<i class="iconfont">&#xe62f;</i>已完成');
                        $(em).parent('a').removeClass().addClass('f-link').addClass('fr');
                        $(em).parent('a').attr('href', '/home/my-book_savant_detail/'+id);
                        $(em).parent('a').html('查看<i class="iconfont">&#xe667;</i>');
                    }
                }
            });
        }
    });
    setList();

    if(LEMON.isAPP)
    {
        LEMON.sys.back('/home/index');
    }
</script>
<?php $this->end('script');
