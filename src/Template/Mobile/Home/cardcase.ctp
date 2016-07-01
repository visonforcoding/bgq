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
                <div class='inner my-search'>
                    <a href='#this' class='toback iconfont news-serch'>&#xe613;</a>
                    <h1><input type="text" placeholder="请输入关键词"></h1>
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
            <a href="/meet/view/{#user_id#}" class="head-img"><img src="{#user_avatar#}"/><i></i></a>
            <div class="vipinfo lay-c">
                <a href="/meet/view/{#user_id#}" class='fl'>
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
    $.util.dataToTpl('card', 'card_tpl',<?= $cardjson ?>, function (d) {
        d.user_id = d.other_card.id;
        d.user_truename = d.other_card.truename;
        d.user_avatar = d.other_card.avatar ? d.other_card.avatar : '/mobile/images/touxiang.png';
        d.user_company = d.other_card.company;
        d.user_position = d.other_card.position;
        d.user_phone = d.other_card.phone;
        d.user_email = d.other_card.email;
        if(d.resend == 2)
        {
            d.giveBack = '<div class="fr" id="giveBack_'+ d.other_card.id + '" uid="' + d.other_card.id + '"><span class="meetnum toc"><i></i>回赠</span></div>';
        }
        return d;
    });
    
    $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('giveBack_') != -1){
            $.util.ajax({
                url: "/home/sendBack/" + $(em).attr('uid'),
                func: function(msg){
                    if(typeof msg == 'object')
                    {
                        if(msg.status)
                        {
                            $(em).children('span').text('已回赠');
                            $.util.alert(msg.msg);
                        }
                        else
                        {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        }
        switch(em.id){
            case 'send':
                if($(em).hasClass('active'))
                {
                    return false;
                }
                $('#card').html('');
                $(em).addClass('active');
                $('#noSend').removeClass('active');
                $.util.ajax({
                    url: "/home/getCrad/1",
                    func: function(msg){
                        if(typeof msg == 'object')
                        {
                            if(msg.status)
                            {
                                
                                $.util.dataToTpl('card', 'card_tpl', msg.data, function (d) {
                                    d.user_id = d.other_card.id;
                                    d.user_truename = d.other_card.truename;
                                    d.user_avatar = d.other_card.avatar ? d.other_card.avatar : '/mobile/images/touxiang.png';
                                    d.user_company = d.other_card.company;
                                    d.user_position = d.other_card.position;
                                    d.user_phone = d.other_card.phone;
                                    d.user_email = d.other_card.email;
                                    if(d.resend == 2)
                                    {
                                        d.giveBack = '<div class="fr" id="giveBack_'+ d.other_card.id + '" uid="' + d.other_card.id + '"><span class="meetnum toc"><i></i>回赠</span></div>';
                                    }
                                    return d;
                                });
                            }
                        }
                    }
                });
                break;
            case 'noSend':
                if($(em).hasClass('active'))
                {
                    return false;
                }
                $('#card').html('');
                $(em).addClass('active');
                $('#send').removeClass('active');
                $.util.ajax({
                    url: "/home/getCrad/2",
                    func: function(msg){
                        if(typeof msg == 'object')
                        {
                            if(msg.status)
                            {
                                
                                $.util.dataToTpl('card', 'card_tpl', msg.data, function (d) {
                                    d.user_id = d.other_card.id;
                                    d.user_truename = d.other_card.truename;
                                    d.user_avatar = d.other_card.avatar ? d.other_card.avatar : '/mobile/images/touxiang.png';
                                    d.user_company = d.other_card.company;
                                    d.user_position = d.other_card.position;
                                    d.user_phone = d.other_card.phone;
                                    d.user_email = d.other_card.email;
                                    if(d.resend == 2)
                                    {
                                        d.giveBack = '<div class="fr" id="giveBack_'+ d.other_card.id + '" uid="' + d.other_card.id + '"><span class="meetnum toc"><i></i>回赠</span></div>';
                                    }
                                    return d;
                                });
                            }
                            else
                            {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'goTop':
                window.scrollTo(0,0);
                e.preventDefault();
                break;
        }
    });
    
</script>
<?php $this->end('script');
