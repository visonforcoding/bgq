<span id="login_status_page"><?=$isLogin?></span>
<script>
    if($('#login_status_page').html() == 'yes'){
        $.util.setCookie('login_status', 'yes', 99999999);
    }
    else{

        $.util.setCookie('login_status', '');
    }
</script>
