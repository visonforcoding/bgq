<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            个人标签
        </h1>
    </div>
</header>
<div class="wraper">
    <div class="h20">
    </div>
    <div class="items bbottom">
        <div class="orgtitle  innerwaper">
            <span class="orgname">个人标签（最多5个）</span>
        </div>
        <div class="orgmark">
            <?php if ($mark_arr): ?>
                <?php foreach ($profiletags as  $tag): ?>
                    <?php $flag = false; ?>
                    <?php foreach ($mark_arr as $mark): ?>
                        <?php if ($tag == $mark): ?>
                            <a href="javascript:void(0)" data-val="<?= $tag ?>" class="agency-item active"><?= $tag ?></a>
                            <?php $flag = true; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if (!$flag): ?>
                        <a href="javascript:void(0)" data-val="<?= $tag ?>" class="agency-item"><?= $tag ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
                  <?php if($extra_mark):?>
                        <?php foreach ($extra_mark as $extra):?>
                            <a href="javascript:void(0)" data-val="<?= $extra ?>" class="agency-item active"><?= $extra ?></a>
                        <?php endforeach;?>
                   <?php endif;?>
            <?php else: ?>
                <?php foreach ($profiletags as $tag): ?>
                    <a href="javascript:void(0)" data-val="<?= $tag ?>" class="agency-item"><?= $tag ?></a>
                <?php endforeach; ?>
            <?php endif; ?>
            <a href="javascript:void(0)" class='a-mark agency-item'><input style="border: none" type="" name="" id="extra_industry" value="" placeholder="输入自定义新标签" /></a>
        </div>
    </div>
    <a  id="submit" href="javascript:void(0)" class='nextstep'>保存</a>
</div>
<?php $this->start('script') ?>
<!--<script src="/mobile/js/jquery.js" type="text/javascript" charset="utf-8"></script>-->
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>
<script>
    var agency, formdata;
    $(function () {
        $('.agency-item').on('click', function () {
            $(this).toggleClass('active');
        });
        $('#submit').click(function () {
            agency = [];
            formdata = {};
            $('.agency-item.active').not('.a-mark').each(function (i, elm) {
                agency.push($(elm).data('val'));
            });
            formdata['tags'] = agency;
//            formdata['industries'] = agency;
            var extra_industry = $('#extra_industry').val();
            if (extra_industry !== '' && $('#extra_industry').parent().hasClass('active')) {
                console.log(formdata);
                console.log(extra_industry);
                formdata['tags'].push(extra_industry);
            }
//            if (Object.keys(formdata).length < 5) {
            if (formdata['tags'].length <= 5) {
//                if (Object.keys(formdata).length = 0) {
                if (formdata['tags'].length == 0) {
                    $.util.alert('至少要选一个');
                    return;
                }
                //对象长度判断
                $.util.ajax({
                    data: formdata,
                    func: function (res) {
                        $.util.alert(res.msg);
                        if (res.status) {
                            setTimeout(function () {
                                window.location.href = '/home/edit-userinfo';
                            }, 1500);
                        }
                    }
                })
            } else {
                $.util.alert('最多可选5个');
            }
        });

        $('#addTag').on('tap', function () {
            layer.alery(123);
        });
    });
</script>
<?php
$this->end('script');
