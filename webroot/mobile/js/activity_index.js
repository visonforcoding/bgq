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

(new activity()).init();