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

            var val = $(em).attr('type');
            $('input[name="type"]').attr('value', val);
        }
        switch (em.id) {
            case 'submit':
                if($('textarea[name="description"]').val() == '')
                {
                    $.util.alert('请输入内容');
                    return false;
                }
                if($('input[name="type"]').attr('value') == '')
                {
                    $.util.alert('请选择一个类别');
                    return false;
                }
                var form = $('form').serializeArray();
                $.util.ajax({
                    url: $('form').attr('action'),
                    data: form,
                    func: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $.util.alert(msg.msg);
                                setTimeout(function () {
                                    window.location.href = '/activity/details/' + $('input[name="activity_id"]').val();
                                }, 3000);
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
};

(new activity()).init();