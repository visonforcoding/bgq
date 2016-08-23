<div id="app" class="wraper">
    <h1 class='choose-org-type innerwaper'>请选择机构标签</h1>
    <?php foreach ($agencies as $key => $agency): ?>
        <div class="items">
            <div class="orgtitle  innerwaper">
                <span class="orgname"><?= $agency['name'] ?></span>
            </div>
            <?php if (!empty($agency['name'])): ?>
                <div class="orgmark">
                    <?php foreach ($agency['children'] as $item): ?>
                        <a class="agency-item <?php if ($item['id'] == $user->agency_id): ?>active<?php endif; ?>" data-val="<?= $item['id'] ?>" href="javascript:void(0)" ><?= $item['name'] ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($key < (count($agencies) - 1)): ?>
            <div class='h20'></div>
        <?php endif; ?>
    <?php endforeach; ?>
    <a href="javascript:void(0)" id="submit" class='nextstep'>保存</a>
</div>
<?php $this->start('script') ?>
<!--<script src="/mobile/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>-->
<!--<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>-->
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>
<script>
    var agency, formdata;
    $(function () {
        $('#submit').on('tap', function () {
            agency = [];
            formdata = '';
            $('.agency-item.active').each(function (i, elm) {
                formdata = $(elm).data('val');
            });
            if (formdata) {
                //对象长度判断
                $.post('/home/save-agency', {agency:formdata}, function (res) {
                    if (res.status === true) {
                        $.util.alert(res.msg);
                        setTimeout(function () {
                            window.location.href = '/home/edit-userinfo';
                        }, 2000);
                    } else {
                        $.util.alert(res.msg);
                    }
                }, 'json');
            } else {
                $.util.alert('请先选择机构标签');
            }
        });
    });

    $('.items>.orgmark>a').on('tap', function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('.items>.orgmark>a').removeClass('active');
            $(this).addClass('active');
        }
    });

    $('.orgname').on('tap', function () {
        if ($(this).hasClass('bgorgname')) {
            $(this).removeClass('bgorgname');
            $(this).parents('.orgtitle').siblings().show(200);
        } else {
            $(this).addClass('bgorgname');
            $(this).parents('.orgtitle').siblings().hide(200);
        }
    });
</script>
<?php
$this->end('script');
