var activity = function () {
    var opt = {
    };

    $.extend(this, opt);
}

activity.prototype.init = function () {
    this.setDet();
    this.bindEvent();
};

activity.prototype.setDet = function () {

};

activity.prototype.bindEvent = function () {
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('agency_item_') != -1) {
            $('.agency-item').removeClass('active');
            $(em).addClass('active');

            var attr = $(em).attr('href');
            $(attr).show().siblings('.a-form-box').hide();

            $(attr).siblings('.a-form-box').find('input').val(null);
            $(attr).siblings('.a-form-box').find('textarea').val(null);

            var val = $(em).attr('type');
            $('input[name="type"]').val(val);
        }
        switch (em.id) {
            case 'submit':
                var form = $('form').serializeArray();
                var formData = [];
                // 将空的对象清除
                for (i = 0; i < form.length; i++)
                {
                    if (form[i].value != '')
                    {
                        formData[i] = form[i];
                    }
                }
                $.ajax({
                    type: 'post',
                    url: $('form').attr('action'),
                    data: formData,
                    dataType: 'json',
                    success: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $.util.alert(msg.msg);
                                setTimeout(function () {
                                    window.location.href = '/activity/index';
                                }, 3000);
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'toback':
                location.href = '/activity/index';
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
};

(new activity()).init();