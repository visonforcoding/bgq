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
        <a href="javascript:void(0);" id="applyActivity">已经报名</a>|
        <a href="javascript:void(0);" id="myActivity">活动需求</a>
    </div>
    <div id="dataBox"></div>

</div>
<script type="text/html" id="listTpl">
    <section class="my-collection-info">
        <div class="innercon">
            <a href="javascript:changeStatus('{#id#}', '{#msg_id#}')" class="clearfix nobottom" >
                <span class="my-pic-acive"><img src="{#cover#}"/></span>
                <div class="my-collection-items">
                    <h3>{#title#}</h3>
                    <div style="color:red;line-height: .36rem;">{#check#}</div>
                    <span>{#address#}<i class="f-color-gray">{#apply_nums#}人报名</i></span>
                    <span>{#time#}</span>
                </div>
            </a>
        </div>
    </section>
</script>
<script type="text/html" id="myactTpl">
    <section class="my-collection-info">
        <div class="innercon">
            <a href="{#id#}" class="clearfix nobottom">
                <div class="my-collection-items">
                    <h3>{#title#}</h3>
                    <!--<div style="color:red;line-height: .36rem;">{#check#}</div>-->
                    <span class="line2">{#body#}</span>
                    <span>{#create_time#}</span>
                </div>
            </a>
        </div>
    </section>
</script>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    var type = '<?= $type ?>';
</script>
<script>

    if(type == 2){
        myActivity($('#myActivity').get(0));
    } else {
        ApplyActivity($('#applyActivity').get(0));
    }
    
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('common_') != -1) {
            console.log($(em));
        }
        switch (em.id) {
            case 'myActivity':
                myActivity(em);
                break;
            case 'applyActivity':
                ApplyActivity(em);
                break;
            case 'detailClosePC':
                //do();
                break;
            case 'goTop':
                window.scrollTo(0, 0);
                e.preventDefault();
                break;
        }
    });

    function myActivity(em) {
        if ($(em).hasClass('active')) {
            return false;
        }
        $('#dataBox').html('');
        $(em).addClass('active');
        $('#applyActivity').removeClass('active');
        $.util.ajax({
            url: "/home/getMyActivity",
            func: function (msg) {
                if (typeof msg == 'object') {
                    if (msg.status) {
                        $.util.dataToTpl('dataBox', 'myactTpl', msg.data, function (d) {
                            d.cover = d.thumb ? d.thumb : d.cover;
                            d.id = '/activity/release/' + d.id;
                            return d;
                        });
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
    }

    function ApplyActivity(em) {
        if ($(em).hasClass('active')) {
            return false;
        }
        $('#dataBox').html('');
        $(em).addClass('active');
        $('#myActivity').removeClass('active');
        $.util.ajax({
            url: "/home/myActivityApply",
            func: function (msg) {
                if (typeof msg == 'object') {
                    if (msg.status) {
                        $.util.dataToTpl('dataBox', 'listTpl', msg.data, function (d) {
                            d.id = d.activity.id;
                            d.cover = d.activity.thumb ? d.activity.thumb : d.activity.cover;
                            d.title = d.activity.title;
                            d.adress = d.activity.adress;
                            d.apply_nums = d.activity.apply_nums;
                            d.time = d.create_time;
                            if (d.activity.must_check == 1) {
                                if (d.is_check === 0 && d.is_pass === 0) {
                                    d.check = '审核中';
                                    d.id = '/activity/details/' + d.activity.id;
                                } else if (d.is_check === 1 && d.is_pass === 0) {
                                    d.check = '未付款';
                                    d.id = '/Wx/meet-pay/' + d.lmorder.id;
                                } else if (d.is_pass === 1) {
                                    d.check = '报名成功';
                                    d.id = '/activity/details/' + d.activity.id;
                                }
                            } else {
                                if (d.is_pass === 0) {
                                    d.check = '未付款';
                                    d.id = '/Wx/meet-pay/' + d.lmorder.id;
                                } else if (d.is_pass === 1) {
                                    d.check = '报名成功';
                                    d.id = '/activity/details/' + d.activity.id;
                                }
                            }
                            d.msg_id = d.usermsg ? d.usermsg.id : '';
                            return d;
                        });
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
    }
    
    function changeStatus(url, id){
        if(id == ''){
            location.href = url;
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/home/read_msg/" + id,
                success: function (res) {
                    if(res.status){
                        location.href = url;
                    }
                }
            });
        }
    }
</script>
<?php $this->end('script'); ?>