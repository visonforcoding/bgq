<div class="wraper">
    <div class="h20"></div>
    <form action="" method="post">
        <ul class="h-info-box no-t-border">
            <li class="l-input"><input type="text" placeholder="请输入手机号码" name="phone" /></li>
            <li class="l-input"><input type="email" placeholder="请输入邮箱地址" name="email" /></li>
        </ul>
    </form>
    <a href="javascript:void(0);" class="nextstep redshadow" id="submit">下一步</a>
</div>
<script>
    $('input[name="phone"]').focusout(function () {
        var phone = $(this).val();
        //checkPhone(phone);
    });
    $('#submit').on('click', function () {
        if ($('input[name="phone"]').val() == '') {
            $.util.alert('请输入手机号码', 1000);
            return false;
        }
        //if (!$.util.isMobile($('input[name="phone"]').val())) {
        //    $.util.alert('请输入正确的手机号码', 1000);
        //    return false;
        //}
        if ($('input[name="email"]').val() == '') {
            $.util.alert('请输入邮箱地址', 1000);
            return false;
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '',
            data: $('form').serialize(),
            success: function (res) {
                if(res.status){
                    window.location.href = '/user/set-pwd';
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    });

    function checkPhone(phone) {
        if (phone !== '') {
            if ($.util.isMobile(phone)) {
                $.post('/user/ckUserPhoneExist', {phone: phone}, function (res) {
                    if (res.status === true) {
                        $.util.alert('该手机号已注册', 1000);
                    }
                }, 'json');
            } else {
                $.util.alert('手机号不合法！', 1000);
            }
        }
    }
</script>
