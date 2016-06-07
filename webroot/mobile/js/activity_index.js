var activity = function () {
    var opt = {
        page:2
    };
    $.extend(this, opt);
};

activity.prototype.init = function () {
    var obj = this;
    this.setDet();
    this.bindEvent();
    setTimeout(function(){
        obj.getData();
    }, 2000);
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
        switch (em.id) {
            case 'release':
                if ($(em).attr('user'))
                {
                    location.href = "/activity/release";
                } else {
                    $.util.alert('请先登录');
                }
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
};

activity.prototype.getData = function(){
    var  obj = this;
    $(window).on("scroll", function () {
        $.util.listScroll('items', function () {
            if (obj.page == 9999) {
                $('#buttonLoading').html('亲，没有更多资讯了，请明天再来吧');
                return;
            }
            $.util.showLoading('buttonLoading');
            $.getJSON('/activity/getMoreActivity/' + obj.page, function (res) {
                console.log('page~~~' + obj.page);
                $.util.hideLoading('buttonLoading');
                window.holdLoad = false;  //打开加载锁  可以开始再次加载

                if (!res.status) {  //拉不到数据了  到底了
                    obj.page = 9999;
                    return;
                }

                if (res.status) {
                    var html = $.util.dataToTpl('', 'activity_tpl', res.data, function (d) {
                        d.apply_msg = window.isApply.indexOf(',' + d.id + ',') == -1 ? '' : '<span class="is-apply">已报名</span>';
                        d.industries_name = $.util.dataToTpl('', 'subTpl', d.industries);
                        return d;
                    });
                    $('#activity').append(html);
                    obj.page++;
                }
            });
        });
    });
};

(new activity()).init();