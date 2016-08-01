<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>我的约见</h1>
        <!--<a href="javascript:void(0);" class="h-regiser h-add"></a>-->
    </div>
</header>
<div class="wraper">
    <div class="inner my-home-menu" id="typeTab">
        <span type="savant_books" class="active">我是专家</span>
        <span type="books">我是顾客</span>
    </div>
    <div  class="inner my-home-slidemenu" id="statusTab">
        <span status="1">待付款</span>
        <span status="0" class="active">确认中</span>
        <span status="3">已完成</span>
    </div>

    <div id="list">

    </div>
<script type="text/html" id="tpl">
    <section class="internet-v-info no-margin-top">
        <a  href="{#link#}{#id#}">
        <div class="innercon">
            <span class="head-img"><img src="{#user_logo#}"/><i></i></span>
            <div class="vipinfo my-meet-info">
                <h3>{#truename#}
                    <span class="meetnum ml20">{#meet_nums#}</span>
                    <span style="font-size: 0.2rem">{#time#}</span>
                </h3>
                <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                <div class="mark">
                    <span class='color-items'>约见话题：{#title#}</span>
                </div>
            </div>
        </div>
        </a>
    </section>
</script>
</div>
<?php $this->start('script'); ?>
<script>
    var book_html = {books:[], savant_books:[]}, status='0', type='savant_books';
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
                d.meet_nums = user.meet_nums+'人约见过';
                d.company = user.company;
                d.position = user.position;
                d.title = d.subject.title;
                d.time = d.create_time
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
    });
    setList();

    if(LEMON.isAPP)
    {
        LEMON.sys.back('/home/index');
    }
</script>
<?php $this->end('script');
