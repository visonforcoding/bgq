var activity = function () {
    var opt = {
    };

    $.extend(this, opt);
};

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
            case 'pay':
                $(em).siblings('i').toggleClass('active');
                if ($(em).siblings('i').attr('class') == 'active')
                {
                    $(em).attr('checked', true);
                } else
                {
                    $(em).attr('checked', false);
                }
                break;
            case 'submit':
                var form = $('form');
                var formData = {};
                var agency = [];
                if ($('input[name="title"]').val() == '')
                {
                    $.util.alert('题目不能为空');
                } else if ($('textarea[name="body"]').val() == '')
                {
                    $.util.alert('请填写内容');
                } else if ($('.industries').length = 0)
                {
                    $.util.alert('请选择行业标签');
                } else
                {
                    for (i = 0; i < $('.industries').length; i++)
                    {
                        agency.push($('.industries').eq(i).attr('value'));
                    }
                    formData.pay = $('input[name="pay"]').attr('checked'); // 是否众筹
                    formData.title = $('input[name="title"]').val(); // 标题
                    formData.body = $('textarea[name="body"]').val(); // 内容
                    formData['industries[_ids]'] = agency;
                    $.util.ajax({
                        url: form.attr('action'),
                        data: formData,
                        func: function (msg) {
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
                }
                break;
            case 'tochoose':
                location.href = "/activity/industries";
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
};

(new activity()).init();