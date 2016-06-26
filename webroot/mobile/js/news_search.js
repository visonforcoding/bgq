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
        setTimeout(function(){
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
            $('#choose_industries').html($(em).children('a').html());
            setTimeout(function(){
                $('#choose_industry_ul').hide();
                $('#choose_industries').removeClass('active');
            },301);
            $.ajax({
                type: 'post',
                url: '/news/getSearchRes',
                data: $('#searchForm').serialize(),
                dataType: 'json',
                success: function (msg) {
                    if (typeof msg === 'object') {
                        if (msg.status === true) {
                            var html = $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                                d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                d.author = d.user.truename;
                                return d;
                            });
                        } else {
                            $('#search').html('');
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        }
        if (em.id.indexOf('sort_') != -1) {
            $('.choose_sort_child').removeClass('active');
            $(em).addClass('active');
            $("input[name='sort']").attr('value', $(em).attr('value'));
            $('#choose_sorts').html($(em).children('a').html());
            setTimeout(function(){
                $('#sort_mark').hide();
                $('#choose_sorts').removeClass('active');
            },301);
            $.ajax({
                type: 'post',
                url: '/news/getSearchRes',
                data: $('#searchForm').serialize(),
                dataType: 'json',
                success: function (msg) {
                    if (typeof msg === 'object') {
                        if (msg.status === true) {
                            var html = $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                                d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                d.author = d.user.truename;
                                return d;
                            });
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        }
        switch (em.id) {
            case 'doSearch':
                $.ajax({
                    type: 'post',
                    url: '/news/getSearchRes',
                    data: $('#searchForm').serialize(),
                    dataType: 'json',
                    success: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                var html = $.util.dataToTpl('search', 'search_tpl', msg.data , function (d) {
                                    d.avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                    d.author = d.user.truename;
                                    return d;
                                });
                            } else {
                                $('#search').html('');
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
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
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }

        }, 350);
    });
};

(new activity()).init();