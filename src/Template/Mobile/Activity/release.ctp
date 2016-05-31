<header>
    <div class='inner'>
        <a href='#this' class='toback' ></a>
        <h1><?= $pagetitle; ?></h1>

    </div>
</header>

<div class="wraper">
    <form action="" method="post">
        <div class="h20"></div>
        <div class="infoboxlist a-pay paytype">
            <ul class='ulinfo'>
                <li id="pay">是否为众筹项目：<span class='infocard'><input type="checkbox" name='pay' checked="true" id="pay_input"/><i class='active' id="pay_i"></i></span></li>
            </ul>
        </div>
        <div class="tojudge innercon tochoose" id="tochoose">
            选择行业标签
            <span></span>
        </div>
        <div class="items">
            <div class="orgmark">
                <?php if ($industries): ?>
                    <?php foreach ($industries as $k => $v): ?>
                        <a href="#this" value="<?= $v['id']; ?>" class="industries"><?= $v['name']; ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="h20"></div>
        <div class="crowdfunding innercon">
            <span>标题</span><input type="text" name="title" />
            <span>内容</span><textarea name="body" rows="" cols=""></textarea>
        </div>
        <div class="h20"></div>

        <a href="#this" class='nextstep' id="submit">提交</a>
    </form>
</div>
<?= $this->element('footer'); ?>
<?php $this->start('script') ?>
<script src="/mobile/js/activity_release.js"></script>
<script type="text/javascript">

    $('input[name="title"]').focus(function () {
        if ($('.industries').length == 0)
        {
            $.util.alert('先选择行业');
            $(this).blur();
            setTimeout(function () {
                location.href = "/activity/industries"
            }, 1000);
        }
    });

    $('textarea[name="body"]').focus(function () {
        if ($('.industries').length == 0)
        {
            $.util.alert('先选择行业');
            $(this).blur();
            setTimeout(function () {
                location.href = "/activity/industries"
            }, 1000);
        }
    });
</script>
<?php
$this->end('script');
