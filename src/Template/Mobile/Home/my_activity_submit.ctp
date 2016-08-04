<!--<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            我的活动
        </h1>

    </div>
</header>-->
<div class="wraper">
    <div class="h20 nobottom">
    </div>
    <div class="inner my-home-menu">
        <a href="javascript:void(0);" class="active" id="applyActivity">已经报名</a>|
        <a href="javascript:void(0);" id="myActivity">我的发布</a>
    </div>
    <div id="dataBox"></div>
    
</div>
<script type="text/html" id="listTpl">
    <section class="my-collection-info">
        <div class="innercon">
            <a href="{#id#}" class="clearfix nobottom">
                <span class="my-pic-acive"><img src="{#cover#}"/></span>
                <div class="my-collection-items">
                    <h3>{#title#}</h3>
                    <div style="color:red">{#check#}</div>
                    <span>{#address#}<i class="f-color-gray">{#apply_nums#}人报名</i></span>
                    <span>{#time#}</span>
                </div>
            </a>
        </div>
    </section>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.ajax({
        url: "/home/myActivityApply",
        func: function(msg){
            if(typeof msg == 'object')
            {
                if(msg.status)
                {
                    $.util.dataToTpl('dataBox', 'listTpl',msg.data, function(d){
                        d.id = '/activity/details/' + d.activity.id;
                        d.cover = d.activity.thumb ? d.activity.thumb : d.activity.cover;
                        d.title = d.activity.title;
                        d.adress = d.activity.adress;
                        d.apply_nums = d.activity.apply_nums;
                        d.time = d.activity.time;
                        if(d.is_check === 0 && d.is_pass === 0){
                            d.check = '审核中';
                        } else if(d.is_check === 1 && d.is_pass === 0){
                            d.check = '未付款';
                        } else if(d.is_pass === 1){
                            d.check = '报名成功';
                        }
                        return d;
                    });
                }
            }
        }
    });
    $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('common_') != -1){
            console.log($(em));
        }
        switch(em.id){
            case 'myActivity':
                if($(em).hasClass('active'))
                {
                    return false;
                }
                $('#dataBox').html('');
                $(em).addClass('active');
                $('#applyActivity').removeClass('active');
                $.util.ajax({
                    url: "/home/getMyActivity",
                    func: function(msg){
                        if(typeof msg == 'object')
                        {
                            if(msg.status)
                            {
                                $.util.dataToTpl('dataBox', 'listTpl',msg.data, function(d){
                                    d.cover = d.thumb ? d.thumb : d.cover;
                                    if(d.is_check == 0){
                                        d.id = 'javascript:void(0)';
                                        d.check = '审核中';
                                    } else if(d.is_check == 1) {
                                        d.id = '/activity/details/' + d.id;
                                    } else if(d.is_check == 2) {
                                        d.id = 'javascript:void(0)';
                                        d.check = '审核未通过，理由为：' + d.reason;
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
            case 'applyActivity':
                if($(em).hasClass('active'))
                {
                    return false;
                }
                $('#dataBox').html('');
                $(em).addClass('active');
                $('#myActivity').removeClass('active');
                $.util.ajax({
                    url: "/home/myActivityApply",
                    func: function(msg){
                        if(typeof msg == 'object')
                        {
                            if(msg.status)
                            {
                                $.util.dataToTpl('dataBox', 'listTpl',msg.data, function(d){
                                    d.id = d.activity.id;
                                    d.cover = d.activity.thumb ? d.activity.thumb : d.activity.cover;
                                    d.title = d.activity.title;
                                    d.adress = d.activity.adress;
                                    d.apply_nums = d.activity.apply_nums;
                                    d.time = d.activity.time;
                                    if(d.is_check === 0 && d.is_pass === 0){
                                        d.check = '审核中';
                                    } else if(d.is_check === 1 && d.is_pass === 0){
                                        d.check = '未付款';
                                    } else if(d.is_pass === 1){
                                        d.check = '报名成功';
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
            case 'detailClosePC':
                //do();
                break;
            case 'goTop':
                window.scrollTo(0,0);
                e.preventDefault();
                break;
        }
    });
</script>
<?php $this->end('script'); ?>