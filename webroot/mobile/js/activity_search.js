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
        if (em.id.indexOf('parent_') != -1) {
            $('#choose_industry_ul li').removeClass('active');
            $(em).addClass('active');
            $('.choose_industry_child_ul').hide();
            $(em).children('ul').show();
        }
        if (em.id.indexOf('child_') != -1) {
            $('.choose_industry_child_li').removeClass('active');
            $(em).addClass('active');
            $("input[name='industry_id']").attr('value', $(em).attr('value'));
        }
        if (em.id.indexOf('sort_') != -1) {
            $('.choose_sort_child').removeClass('active');
            $(em).addClass('active');
            $("input[name='sort']").attr('value', $(em).attr('value'));
        }
        switch (em.id) {
            // 行业
            case 'choose_industry':
                $('#choose_industries').toggleClass('active');
                if ($('#choose_industries').hasClass('active') == true)
                {
                    $('#choose_industry_ul').show();
                    $('#choose_sorts').removeClass('active');
                    $('#sort_mark').hide();
                } else
                {
                    $('#choose_industry_ul').hide();
                }
                break;
            case 'choose_industries':
                $(em).toggleClass('active');
                if ($(em).hasClass('active') == true)
                {
                    $('#choose_industry_ul').show();
                    $('#choose_sorts').removeClass('active');
                    $('#sort_mark').hide();
                } else
                {
                    $('#choose_industry_ul').hide();
                }
                break;
            // 排序
            case 'choose_sort':
                $('#choose_sorts').toggleClass('active');
                if ($('#choose_sorts').hasClass('active') == true)
                {
                    $('#sort_mark').show();
                    $('#choose_industries').removeClass('active');
                    $('#choose_industry_ul').hide();
                } else
                {
                    $('#sort_mark').hide();
                }
                break;
            case 'choose_sorts':
                $(em).toggleClass('active');
                if ($(em).hasClass('active') == true)
                {
                    $('#sort_mark').show();
                    $('#choose_industries').removeClass('active');
                    $('#choose_industry_ul').hide();
                } else
                {
                    $('#sort_mark').hide();
                }
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