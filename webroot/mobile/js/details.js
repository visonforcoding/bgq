var activity = function(){
    var opt={

    };

    $.extend(this, opt);
};
activity.prototype.init = function(){
    this.setDet();
    this.bindEvent();
};

activity.prototype.setDet = function(){

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
        if (em.id.indexOf('common_')) {
            console.log($(em));
        }
        switch (em.id) {
            // 点击评论
            case 'article-comment':
                $('.article-shadow').show();
                $('.article').show();
                break;
                // 点击回复评论
            case 'reply':
                $('.reply-shadow').show();
                $('.reply').show();
                var comid = $(this).attr('value');
                $('.publish-reply').attr('value', comid);
                break;
                // 取消评论
            case 'cancel':
                $('.reg-shadow').hide();
                $('.shadow-info').hide();
                break;
                // 评论点赞
            case 'likecom':
                $.ajax({
                    type: 'post',
                    url: '/activity/comLike/' + $(this).attr('comid'),
                    data: 'type=' + $(this).attr('type') + '&relate_id=' + $(this).attr('comid'),
                    dataType: 'json',
                    success: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                var num = $('.addnum').siblings('b').text();
                                num = parseInt(num) + 1;
                                $('.addnum').siblings('b').text(num);
                                $('#likecom').siblings('.addnum').addClass('show');
                                // 动画结束前只能点击一次
                                var addnum = $('.addnum')[0];
                                addnum.addEventListener("webkitAnimationEnd", function () {
                                    $('.show').removeClass('show');
                                });
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'like':
                $.ajax({
                    type: 'post',
                    url: '/activity/artLike/' + $(this).attr('artid'),
                    data: 'type=' + $(this).attr('type') + '&relate_id=' + $(this).attr('artid'),
                    dataType: 'json',
                    success: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $('.like').toggleClass('changecolor');
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'collect':
                $.ajax({
                    type: 'post',
                    url: '/activity/collect/' + $(this).attr('artid'),
                    data: 'type=' + $(this).attr('type') + '&relate_id=' + $(this).attr('artid'),
                    dataType: 'json',
                    success: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $('.collect').toggleClass('changecolor');
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
            case 'cancel':
                //do();
                break;
            case 'cancel':
                //do();
                break;
            case 'cancel':
                //do();
                break;
            case 'cancel':
                //do();
                break;
            case 'cancel':
                //do();
                break;
            case 'cancel':
                //do();
                break;
            case 'cancel':
                //do();
                break;
            case 'cancel':
                //do();
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
};
(new activity()).init();