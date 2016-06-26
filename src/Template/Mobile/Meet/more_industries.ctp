<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            互联网
        </h1>

    </div>
</header>

<div class="wraper">
    <div class="navmenu j-sort">
        <a href="javascript:void(0);" class="h-regiser m-sort active" id="sort">默认排序</a>

        <div class="innercon">
            <a href="/meet/moreIndustries" class="allmark <?php echo $id ? '':'active' ?>">全部</a>
            <div class="outerbox">
                <ul>
                    <?php foreach ($industries as $k=>$v): ?>
                        <li id="sub_<?= $v['id'] ?>" data_id="<?= $v['id'] ?>"><a href="javascript:void(0)"><?= $v['name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div style="height:1rem;"></div>
    <div id='biggies'></div>
</div>

<div class='reg-shadow' style="display: none;"></div>
<div class="m-fixed-top" style="display: none;">
    <ul>
        <li><a href="javascript:void(0);">人气推荐</a></li>
        <li><a href="javascript:void(0);">最新上榜</a></li>
        <li><a href="javascript:void(0);">评价最好</a></li>
        <li><a href="javascript:void(0);">约见最多</a></li>
    </ul>
</div>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/meet/view/{#id#}"><span class="head-img"><img src="{#avatar#}"/><i></i></span></a>
            <div class="vipinfo">
                <a href="/meet/view/{#id#}">
                    <h3>{#truename#}<span class="meetnum">{#meet_nums#}人见过</span></h3>
                    <span class="job">{#company#}&nbsp;&nbsp;{#position#}</span>
                </a>
                <div class="mark">
                    {#subjects#}
                </div>
            </div>
        </div>
    </section>
</script>
<script type='text/html' id='subTpl'>
    <a href="/meet/subject_detail/{#id#}">{#title#}</a>
</script>
<script src="/mobile/js/loopScroll.js"></script>
<script type="text/javascript">
    window.sort = true;
    
    $.util.dataToTpl('biggies', 'biggie_tpl',<?= $biggiejson ?>, function (d) {
        d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
        d.subjects = $.util.dataToTpl('', 'subTpl', d.subjects);
        return d;
    });
    $('body').on('tap', function(e){
        var target = e.srcElement || e.target, em=target, i=1;
        while(em && !em.id && i<=3){ em = em.parentNode; i++;}
        if(!em || !em.id) return;
        if(em.id.indexOf('common_') != -1){
            console.log($(em));
        }
        switch(em.id){
            case 'imageViewer': case 'fullImg':
                //do();
            break;
            case 'sort':
                if(window.sort == true)
                {
                    $('.reg-shadow').show();
                    $('.m-fixed-top').show();
                    window.sort = false;
                }
                else
                {
                    $('.reg-shadow').hide();
                    $('.m-fixed-top').hide();
                    window.sort = true;
                }
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
