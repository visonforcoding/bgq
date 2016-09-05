<!--<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            名片夹
        </h1>
    </div>
</header>-->

<div class="wraper">
    <div class="my-focus-box">
                <div class='h-news-search'>
                    <a href='#this' class='iconfont news-serch'>&#xe618;</a>
                    <form id="searchForm">
                        <h1><input type="text" name="keyword" placeholder="请输入关键词" value="" /></h1>
                        <input type="hidden" name="resend" value="2" />
                    </form>
                    <div class='h-regiser' id="doSearch">搜索</div>
                </div>
            </div>
           
    <div class="h2"></div>
    <div class="inner my-home-menu" >
        <a href="javascript:void(0);" class='active' id="noSend">未回赠</a>
        <a href="javascript:void(0);" id="send">已回赠</a>
    </div>
    <div id="card"></div>
</div>
<script type='text/html' id="card_tpl">
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/user/home-page/{#user_id#}" class="head-img"><img src="{#user_avatar#}"/>{#v#}</a>
            <div class="vipinfo lay-c">
                <a href="/user/home-page/{#user_id#}" class='fl w88'>
                    <h3>{#user_truename#}</h3>
                    <span class="c-info">{#user_company#}  {#user_position#}</span>
                    <span class="c-info">{#user_phone#}</span>
                    <span class="c-info">{#user_email#}</span> 
                </a>
                {#giveBack#}
            </div>
        </div>
            
    </section>
</script>
<?php $this->start('script'); ?>
<script>
    function dealData(data){
        $.util.dataToTpl('card', 'card_tpl', data, function (d) {
            d.user_id = d.other_card.id;
            d.user_truename = d.other_card.truename;
            d.user_avatar = d.other_card.avatar ? d.other_card.avatar : '/mobile/images/touxiang.png';
            d.user_company = d.other_card.company;
            d.user_position = d.other_card.position;
            d.user_phone = d.other_card.phone;
            d.user_email = d.other_card.email;
            if(d.resend == 2) {
                d.giveBack = '<div class="fr" id="giveBack_'+ d.other_card.id + '" uid="' + d.other_card.id + '"><span class="meetnum toc"><i></i>回赠</span></div>';
            }
            if(d.other_card.level == 2){
                d.v = '<i></i>';
            }
            return d;
        });
    }
    
    dealData(<?= $cardjson ?>);
    
    $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('giveBack_') != -1){
            $.util.ajax({
                url: "/home/sendBack/" + $(em).attr('uid'),
                func: function(msg){
                    if(typeof msg == 'object') {
                        if(msg.status) {
                            $(em).children('span').text('已回赠');
                            $.util.alert(msg.msg);
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        }
        switch(em.id){
            case 'send':
                if($(em).hasClass('active')) {
                    return false;
                }
                $('#card').html('');
                $(em).addClass('active');
                $('#noSend').removeClass('active');
                $('input[name="resend"]').attr('value','1');
                $.util.ajax({
                    url: "/home/getCrad/1",
                    func: function(msg){
                        if(typeof msg == 'object') {
                            if(msg.status) {
                                dealData(msg.data);
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'noSend':
                if($(em).hasClass('active')) {
                    return false;
                }
                $('#card').html('');
                $(em).addClass('active');
                $('#send').removeClass('active');
                $('input[name="resend"]').attr('value','2');
                $.util.ajax({
                    url: "/home/getCrad/2",
                    func: function(msg){
                        if(typeof msg == 'object') {
                            if(msg.status) {
                                dealData(msg.data);
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'doSearch':
                search();
                break;
            case 'goTop':
                window.scrollTo(0,0);
                e.preventDefault();
                break;
        }
    });
    
    $('#searchForm').submit(function(){
        search();
        return false;
    });
    
    function search(){
        if($('input[name="keyword"]').val() === ''){
            $.util.alert('请输入内容');
            return false;
        }
        $.ajax({
            type: 'POST',
            data: $('form').serialize(),
            dataType: 'json',
            url: "/home/search-card",
            success: function (res) {
                if(res.status){
                    dealData(res.data);
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
        $('input[name="keyword"]').blur();
    };
    
    
</script>
<?php $this->end('script');
