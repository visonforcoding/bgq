<header>
    <div class='inner'>
        <a href='#this' class='toback'></a>
        <h1>
            注册
        </h1>
    </div>
</header>

<div id="app" class="wraper">
    <h1 class='choose-org-type innerwaper'>请选择业务标签(可多选)</h1>
        <?php foreach ($industries as $key => $industry): ?>
        <div class="items">
            <div class="orgtitle  innerwaper">
                <span class="orgname"><?= $industry['name'] ?></span>
            </div>
            <?php if (!empty($industry['children'])): ?>
                <div class="orgmark">
                    <?php foreach ($item['children'] as $item): ?>
                        <a class="agency-item" data-val="<?=$item['id']?>" href="#this"><?= $item['name'] ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($key < (count($industries) - 1)): ?>
            <div class='h20'></div>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">行业投资</span>
        </div>
        <div class="orgmark">
            <?php foreach ($hang_items as $key=> $hang_item): ?>
                <a data-id="<?=$key?>" href="#this"><?=$hang_item?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class='h20'></div>
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">互联网</span>
        </div>
        <div class="orgmark">
        </div>
    </div>
    <div class='h20'></div>
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">医疗健康</span>
        </div>
        <div class="orgmark">
            <a href="#this">创业</a><a href="#this">产品</a><a href="#this">研发</a><a href="#this">运营</a>
            <a href="#this">市场</a>
        </div>
    </div>
    <div class='h20'></div>
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">资金业务</span>
        </div>
        <div class="orgmark">
            <a href="#this">创业</a><a href="#this">产品</a><a href="#this">研发</a><a href="#this">运营</a>
            <a href="#this">市场</a>
        </div>
    </div>
    <div class='h20'></div>
    <div class="items">
        <div class="orgtitle  innerwaper">
            <span class="orgname">其它</span>
        </div>
        <div class="orgmark myselfmark">
            <a href="#this"><input type='text' placeholder="请输入" /></a>
        </div>
    </div>
    <a href="#this" class='nextstep'>下一步</a>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/register.js" type="text/javascript" charset="utf-8"></script>
<script>
    
</script>
<?php
$this->end('script');
