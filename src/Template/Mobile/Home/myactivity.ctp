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
        <a href="javascript:void(0);" class="active" id="myActivity">我的发布</a>|
        <a href="javascript:void(0);" id="applyActivity">已经报名</a>
    </div>
    <section class="my-collection-info" id="dataBox">
    </section>
</div>
<script type="text/html" id="listTpl">
    <div class="innercon">
        <a href="/activity/details/{#id#}" class="clearfix nobottom">
            <span class="my-pic-acive"><img src="{#cover#}"/></span>
            <div class="my-collection-items">
                <h3>{#title#}</h3>
                <span>{#address#}<i class="f-color-gray">{#apply_nums#}人报名</i></span>
                <span>{#time#}</span>
            </div>
        </a>
    </div>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $.util.dataToTpl('dataBox', 'listTpl',<?= json_encode($activities) ?>);
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
                    url: "",
                    func: function(msg){
                        if(typeof msg == 'object')
                        {
                            if(msg.status)
                            {
                                $.util.dataToTpl('dataBox', 'listTpl',msg.data);
                                $.util.alert(msg.msg);
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