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
    this.scroll();
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
                
                break;
            case 'goTop':
                window.scrollTo(0, 0);
                e.preventDefault();
                break;
        }
    });
};

activity.prototype.scroll = function () {
//    var obj = this;
    window.hideRelease = false;
    window.hideToTop = false;
    $(window).on("scroll", function () {
        // 滚动一个屏幕长度，隐藏发布活动
        var lastSt = window.hideRelease;
        window.hideRelease = document.body.scrollTop > $(window).height();
        var lastTo = window.hideToTop;
        window.hideToTop = document.body.scrollTop > '2000';
        if(lastSt != window.hideRelease){
//            window.hideRelease ? $('#release').removeClass('moveleft').addClass('moveright').css('display', 'none') : $('#release').addClass('moveleft').css('display', '');
            window.hideRelease ? $('#release').hide() : $('#release').show();
        }
        if(lastTo != window.hideToTop){
            window.hideToTop ? $('#toTop').show() : $('#toTop').hide();
        }
    });
};

activity.prototype.getData = function(){
    var  obj = this;
    $(window).on("scroll", function () {
        
        $.util.listScroll('items', function () {
            if (obj.page == 9999) {
                $('#buttonLoading').html('亲，没有更多活动了，请看看其他的栏目吧');
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
                    var html = dealData(res.data);
                    $('#activity').append(html);
                    if(res.data < 5){
                        obj.page = 9999;
                        $('#buttonLoading').html('亲，没有更多活动了，请看看其他的栏目吧');
                    } else {
                        obj.page++;
                    }
                }
            });
        });
    });
};

(new activity()).init();