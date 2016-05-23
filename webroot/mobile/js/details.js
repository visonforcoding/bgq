var activity = function () {
    var opt = {
    };

    $.extend(this, opt);
};
activity.prototype.init = function () {
    var obj = this;
    this.setDet();
    obj.bindEvent();
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
        if (em.id.indexOf('likecom_') != -1) {
            $.ajax({
                type: 'post',
                url: '/activity/comLike/' + $(em).attr('comid'),
                data: 'type=' + $(em).attr('type') + '&relate_id=' + $(em).attr('comid'),
                dataType: 'json',
                success: function (msg) {
                    if (typeof msg === 'object') {
                        if (msg.status === true) {
                            var num = $('#addnum_' + $(em).attr('comid')).siblings('b').text();
                            num = parseInt(num) + 1;
                            $('#addnum_' + $(em).attr('comid')).siblings('b').text(num);
                            $('#likecom_' + $(em).attr('comid')).siblings('.addnum').addClass('show');
                            // 动画结束前只能点击一次
                            var addnum = $('#addnum_' + $(em).attr('comid'))[0];
                            addnum.addEventListener("webkitAnimationEnd", function () {
                                $('.show').removeClass('show');
                            });
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        }
        if (em.id.indexOf('reply_') != -1) {
            $('.reply-shadow').show();
            $('.reply').show();
            var comid = $(em).attr('value');
            $('#publish-reply').attr('value', comid);
        }
        if (em.id.indexOf('likecom_') != -1) {
//            console.log($(em));
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
                var comid = $(em).attr('value');
                $('#publish-reply').attr('value', comid);
                break;

            // 取消评论
            case 'cancel':
                setTimeout(function () {
                    $('.reg-shadow').hide();
                    $('.shadow-info').hide();
                }, 301);
                break;

            // 喜欢
            case 'like':
                $.ajax({
                    type: 'post',
                    url: '/activity/artLike/' + $(em).attr('artid'),
                    data: 'type=' + $(em).attr('type') + '&relate_id=' + $(em).attr('artid'),
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
                
            // 收藏
            case 'collect':
                $.ajax({
                    type: 'post',
                    url: '/activity/collect/' + $(em).attr('artid'),
                    data: 'type=' + $(em).attr('type') + '&relate_id=' + $(em).attr('artid'),
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
                
            // 评论文章
            case 'publish-article':
                var data = {};
                var body = $('textarea[name="comment-content-article"]').val();
                if (!body) {
                    $.util.alert('内容不可为空');
                    return false;
                }
                data.body = body;
                data.pid = 0;
                var activity_id = $('#publish-article').attr('activity_id');
                $.ajax({
                    type: 'post',
                    url: '/activity/doComment/' + activity_id,
                    data: data,
                    dataType: 'json',
                    success: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $.util.alert(msg.msg);
                                setTimeout(function () {
                                    window.location.reload();
                                    window.doScroll('scrollbarDown');
                                }, 3000);
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
                
            // 回复评论
            case 'publish-reply':
                var data = {};
                var body = $('textarea[name="comment-content-reply"]').val();
                if (!body) {
                    $.util.alert('内容不可为空');
                    return false;
                }
                data.body = body;
                data.pid = $('#publish-reply').attr('value');
                var activity_id = $('#publish-reply').attr('activity_id');
                $.ajax({
                    type: 'post',
                    url: '/activity/doComment/' + activity_id,
                    data: data,
                    dataType: 'json',
                    success: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $.util.alert(msg.msg);
                                setTimeout(function () {
                                    window.location.reload();
                                    window.doScroll('scrollbarDown');
                                }, 3000);
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
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
};
(new activity()).init();