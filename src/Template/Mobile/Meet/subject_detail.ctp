<!--<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            话题详情
        </h1>
        <a href="#this" class='iconfont share h-regiser'>&#xe614;</a>
    </div>
</header>-->
<div class="wraper">
    <div class="h20">
    </div>
    <section>
        <ul class="m-detail">
            <li class='mtitle'>
                <h3><?= $subject->title ?><span class='m-block'><?= $subject->user->truename ?> <?= $subject->user->company ?> <?= $subject->user->position ?></span></h3>
<!--                <span class="meet-type">
                </span>-->
            </li>
            <!--            <li>
                            <span><?= $subject->price ?>元/次</span>
                            <span class="fr">约<?= $subject->last_time ?>小时</span>
                        </li>-->
            <li>
                <h3 class="t-tittle">话题简介</h3>
                <p><?= $subject->summary ?>
                </p>
            </li>
        </ul>
    </section>
    <div class="a-form-box m-form-box">
        <ul>
            <li>
                <i>请简略介绍需求(300字以下)</i>
                <textarea id="summary"></textarea>
                <i class="m-tips"><b class="iconfont"></b>详细的介绍能让专家更加了解你<span>你填的信息只有专家能看到，不会公开给其它人</span></i>
            </li>
        </ul>
    </div>
    <a href="javascript:void(0)" id="submit" class="nextstep" user_id="<?= $user_id ?>">立即预约</a>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    window.subject_id = '<?= $subject->id ?>';
</script>
<script>
//    $('.nextstep').on('tap', function () {
//        if ($(this).attr('user_id') == '') {
//            $.util.alert('请先登录');
//            setTimeout(function () {
//                location.href = '/user/login?redirect_url=/meet/subject-detail/<?= $subject->id ?>';
//            }, 2000);
//        } else {
//            location.href = '/meet/book/<?= $subject->id ?>';
//        }
//    });

    $('#submit').on('tap', function () {
        if ($(this).attr('user_id') == '') {
            $.util.alert('请先登录');
            setTimeout(function () {
                location.href = '/user/login?redirect_url=/meet/subject-detail/<?= $subject->id ?>';
            }, 2000);
        } else {
            var id = window.subject_id;
            var summary = $('#summary').val();
            if (!summary) {
                $.util.alert('内容不可为空');
                return false;
            } else if (summary.length > 300) {
                $.util.alert('');
                return false;
            }
            $.util.ajax({
                url: '/meet/book/<?= $subject->id ?>',
                data: {id: id, summary: summary},
                func: function (res) {
                    $.util.alert(res.msg);
                    if (res.status) {
                        document.location.href = '/meet/book-success/<?= $subject->user->id ?>';
                    }
                }
            });
        }
    });
</script>
<?php
$this->end('script');
