<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>我的约见</h1>
        <!--<a href="javascript:void(0);" class="h-regiser h-add"></a>-->
    </div>
</header>
<div class="wraper">
    <div class="inner my-home-menu" id="typeTab">
        <span type="books">我约见</span>
        <span type="savant_books">约见我</span>
    </div>
    <div  class="inner my-home-slidemenu" id="statusTab">
        <span status="2">未通过</span>
        <span status="0">未确认</span>
        <span status="1">已确认</span>
    </div>

    <div id="list">

    </div>
<script type="text/html" id="tpl">
    <section class="internet-v-info">
        <a link="{#link#}"  id='msgId_{#msg_id#}' msg_id='{#msg_id#}' onclick="read(this);">
            <div class="innercon">
                <span class="head-img"><img src="{#user_logo#}"/>{#v#}</span>
                <div class="vipinfo my-meet-info">
                    <h3>{#truename#}
                        <time>{#time#}</time>
                        <span class="meetnum">{#meet_nums#}</span>
                    </h3>
                    <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                    <div class="mark meet_title_con">
                        <span class='color-items m_sub_title line1'>约见话题：{#title#}</span>
                        <em class="meet_tips">{#msg#}{#arrow#}</em>
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
    if(location.hash){
        switch(location.hash){
            // 我约见的未确认
            case '#1':
                var book_html = {books:[], savant_books:[]}, status='0', type='books';
                $('span[status="0"]').addClass('active');
                $('span[type="books"]').addClass('active');
                break;
            // 我约见的已确认
            case '#2':
                var book_html = {books:[], savant_books:[]}, status='1', type='books';
                $('span[status="1"]').addClass('active');
                $('span[type="books"]').addClass('active');
                break;
            // 我约见的未通过
            case '#3':
                var book_html = {books:[], savant_books:[]}, status='2', type='books';
                $('span[status="2"]').addClass('active');
                $('span[type="books"]').addClass('active');
                break;
            // 约见我的未确认
            case '#4':
                var book_html = {books:[], savant_books:[]}, status='0', type='savant_books';
                $('span[status="0"]').addClass('active');
                $('span[type="savant_books"]').addClass('active');
                break;
            // 约见我的已确认
            case '#5':
                var book_html = {books:[], savant_books:[]}, status='1', type='savant_books';
                $('span[status="1"]').addClass('active');
                $('span[type="savant_books"]').addClass('active');
                break;
            // 约见我的未通过
            case '#6':
                var book_html = {books:[], savant_books:[]}, status='2', type='savant_books';
                $('span[status="2"]').addClass('active');
                $('span[type="savant_books"]').addClass('active');
                break;
        }
        
    } else {
        var book_html = {books:[], savant_books:[]}, status='0', type='<?php if($savant_books == []): ?>books<?php else: ?>savant_books<?php endif; ?>';
        $('span[status="0"]').addClass('active');
        $('span[type="<?php if($savant_books == []): ?>books<?php else: ?>savant_books<?php endif; ?>"]').addClass('active');
    }
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
                d.link = status === '1' ? '/home/book-chat/'+d.id : '/home/my-book-detail/'+d.id;
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
                d.msg = d.usermsgs.length || d.book_chats.length ? '<span class="l_tips opci"></span>':'';
                d.msg_id = d.usermsgs.length ? d.usermsgs[0].id : '';
                if(type == 'books'){
                    if(status === '1'){
                        d.link = '/home/book-chat/'+d.id+'/1';
                        if(d.is_done){
                            d.subject_status = '<div class="f-box"><div class="f-info"><span class="fl f-type"><i class="iconfont">&#xe62f;</i>已完成</span><a class="fr f-link" href="/home/my-book-detail/'+d.id+'">查看<i class="iconfont">&#xe667;</i></a></div>';
                        } else {
                            d.subject_status = '<div class="f-box"><div class="f-info"><span class="fl f-type"><i class="iconfont">&#xe62f;</i>约见中</span><a class="fr f-link" href="/home/my-book-detail/'+d.id+'">查看<i class="iconfont">&#xe667;</i></a></div>';
                        }
                    } else {
                        d.link = '/home/my-book-detail/'+d.id;
                        d.arrow = '<i class="iconfont fr">&#xe667;</i>';
                    }
                } else {
                    if(status === '1'){
                        d.link = '/home/book-chat/'+d.id+'/2';
                        if(d.is_done){
                            d.subject_status = '<div class="f-box"><div class="f-info"><span class="fl f-type"><i class="iconfont">&#xe62f;</i>已完成</span><a class="fr f-link" href="/home/my-book_savant_detail/'+d.id+'">查看<i class="iconfont">&#xe667;</i></a></div>';
                        } else {
                            d.subject_status = '<div class="f-box"><div class="f-info"><span class="fl f-type"><i class="iconfont">&#xe62f;</i>约见中</span><a class="fr f-btn done"><span subject_id="'+d.id+'" id="subjectId_'+d.id+'">完成</span></a></div>';
                        }
                    } else {
                        d.link = '/home/my-book-savant-detail/'+d.id;
                        d.arrow = '<i class="iconfont fr">&#xe667;</i>';
                    }
                }
                return d;
            });
        }
        $('#list').html(book_html[type][status]);
    };
    
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
        if(em.id.indexOf('subjectId_') != -1){
            var id = $(em).attr('subject_id');
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/home/change-subject-status/"+id,
                success: function (res) {
                    $.util.alert(res.msg);
                    if(res.status){
                        $(em).parent('a').prev('span').html('<i class="iconfont">&#xe62f;</i>已完成');
                        $(em).parent('a').removeClass().addClass('f-link').addClass('fr');
                        $(em).parent('a').attr('href', '/home/my-book-savant-detail/'+id);
                        $(em).parent('a').html('查看<i class="iconfont">&#xe667;</i>');
                    }
                }
            });
        }
    });
    setList();

    if(LEMON.isAPP) {
        if(location.hash){
        
        } else {
            LEMON.sys.back('/home/index');
        }
    }
    
    function read(em){
        var obj = $(em);
        if(obj.attr('msg_id')){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/home/read-msg/" + obj.attr('msg_id'),
                success: function (res) {
                    if(res.status){
                        obj.find('em').children('.opic').remove();
                        location.href = obj.attr('link');
                    } else {
                        $.util.alert(res.msg);
                    }
                }
            });
        } else {
            location.href = obj.attr('link');
        }
    }
</script>
<?php $this->end('script');
