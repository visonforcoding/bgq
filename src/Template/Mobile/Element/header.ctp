<header id="header" class="ui-header ui-header-positive ui-border-b" style="display: none">
    <i class="ui-icon-return" onclick="history.back()"></i>
    <h1><?= $pageTitle ?></h1>
    <?php if (isset($pageHeaderLink)): ?>
        <button class="ui-btn"  onclick="document.location.href='<?=$pageHeaderLink?>'">
        <?php else: ?>
            <button class="ui-btn">
    <?php endif; ?>
    <?= isset($pageHeaderLinkLabel) ? $pageHeaderLinkLabel : '回首页' ?></button>
</header>

<script>
    if(/smartlemon|micromessenger/.test(navigator.userAgent.toLowerCase())){
        document.getElementById('header').style.display = 'block';
    }
</script>