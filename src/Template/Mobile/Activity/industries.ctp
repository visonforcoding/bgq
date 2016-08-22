<div id="app" class="wraper">
    <h1 class='choose-org-type innerwaper'>请选择行业标签(可多选)</h1>
    <?php foreach ($industries as $key => $industry): ?>
        <div class="items">
            <div class="orgtitle  innerwaper">
                <span class="orgname"><?= $industry['name'] ?></span>
            </div>
            <?php if (!empty($industry['children'])): ?>
                <div class="orgmark">
                    <?php foreach ($industry['children'] as $item): ?>
                        <a class="agency-item" data-val="<?= $item['id'] ?>" href="javascript:void(0)"><?= $item['name'] ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($key < (count($industries) - 1)): ?>
            <div class='h20'></div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class='h20'></div>
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">其它</span>
        </div>
        <div class="orgmark myselfmark">
            <a href="javascript:void(0)"><input type='text' id="extra_industry" placeholder="请输入" /></a>
        </div>
    </div>
    <a href="javascript:void(0)" id="submit" class='nextstep'>确定</a>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>
<script>
    var agency, formdata;
    $(function () {
        $('#submit').click(function () {
            agency = [];
            formdata = {};
            $('.agency-item.active').each(function (i, elm) {
                agency.push($(elm).data('val'));
            });
            formdata['industries[_ids]'] = agency;
            var extra_industry = $('#extra_industry').val();
            if (extra_industry !== '' && $('#extra_industry').parent().hasClass('active')) {
                formdata.ext_industry = extra_industry;
            }
            if (Object.keys(formdata['industries[_ids]']).length > 0) {
                //对象长度判断
                $.get('/activity/release', formdata, function (res) {
                    var url = '/activity/release';
                    for (i = 0; i < formdata['industries[_ids]'].length; i++)
                    {
                        url = url + '/' + formdata['industries[_ids]'][i];
                    }
                    window.location.href = url;
                });
            } else {
                $.util.alert('请选择您所在行业标签');
            }
        });
    });
</script>
<?php
$this->end('script');
