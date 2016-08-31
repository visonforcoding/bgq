<span id="login_status_page"><?=$isLogin?></span>

<script>
    var setCookie = function(name, value, expires, path, domain, secure) {
        var exp = new Date(), expires = arguments[2] || null, path = arguments[3] || "/", domain = arguments[4] || null, secure = arguments[5] || false;
        expires ? exp.setMinutes(exp.getMinutes() + parseInt(expires)) : "";
        document.cookie = name + '=' + escape(value) + ( expires ? ';expires=' + exp.toGMTString() : '') + ( path ? ';path=' + path : '') + ( domain ? ';domain=' + domain : '') + ( secure ? ';secure' : '');
    };

    if(document.getElementById('login_status_page').innerHTML == 'yes'){
        setCookie('login_status', 'yes', 99999999);
    }
    else{
        setCookie('login_status', '');
    }
</script>
