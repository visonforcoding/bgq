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
            $(em).addClass('active');
            $(em).siblings().removeClass('active');
            $(em).children('ul').show();
            $(em).siblings().children('ul').hide();
        }
        if (em.id.indexOf('child_') != -1) {
            $(em).toggleClass('active');
            $(em).siblings().removeClass('active');
            $("input[name='industry_id']").attr('value', $(em).attr('value'));
        }
        if (em.id.indexOf('sort_') != -1) {
            $(em).addClass('active');
            $(em).siblings().removeClass('active');
            $(em).children('ul').show();
            $(em).siblings().children('ul').hide();
            $("input[name='sort']").attr('value', $(em).attr('value'));
        }
        switch (em.id) {
            case 'choose_industry':
                $(em).toggleClass('active');
                if ($(em).hasClass('active') == true)
                {
                    $(em).siblings('ul').show();
                    $(em).parent().siblings().children('span').removeClass('active');
                    $(em).parent().siblings().children('ul').hide();
                } else
                {
                    $(em).siblings('ul').hide();
                }
                break;
            case 'choose_sort':
                $(em).toggleClass('active');
                if ($(em).hasClass('active') == true)
                {
                    $(em).siblings('ul').show();
                    $(em).parent().siblings().children('span').removeClass('active');
                    $(em).parent().siblings().children('ul').hide();
                } else
                {
                    $(em).siblings('ul').hide();
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