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
                if($('textarea[name="description"]').val() == '') {
                    $.util.alert('请输入内容');
                    return false;
                }
                if($('input[name="type"]').attr('value') == '') {
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
                                setTimeout(function(){
                                    $('.reg-shadow').show('slow');
                                    $('.totips').show('slow');
                                }, 400);
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'closed':
                setTimeout(function(){
                    $('.reg-shadow').hide('slow');
                    $('.totips').hide('slow');
                }, 400);
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
};

(new activity()).init();