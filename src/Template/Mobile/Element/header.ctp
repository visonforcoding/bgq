
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
        document.getElementById('header').style.display = 'block';
    }
</script>