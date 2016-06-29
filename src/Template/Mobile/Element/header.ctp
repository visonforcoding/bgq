
<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            <?= $pageTitle; ?>
        </h1>
    </div>
</header>
<script>
    if(/smartlemon|micromessenger/.test(navigator.userAgent.toLowerCase())){
        document.getElementsByTagName('header')[0]&& (document.getElementsByTagName('header')[0].style.display = 'block');
    }
</script>