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
    //ii=0;
    //$('body').on('touchstart', function(e){
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        //$('#article_comment').html((ii++)+em.id+'~~'+em.className)
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('likecom_') != -1) {
            if ($(em).attr('disable') === '1') {
                return false;
            }
            $.util.ajax({
                url: '/activity/comLike/' + $(em).attr('comid'),
                func: function (msg) {
                    console.log(msg);
                    if (typeof msg === 'object') {
                        if (msg.status === true) {
                            var num = $('.addnum_' + $(em).attr('comid')).siblings('.praise_num').text();
                            num = parseInt(num) + 1;
                            $('.addnum_' + $(em).attr('comid')).siblings('.praise_num').text(num);
                            $('.addnum_' + $(em).attr('comid')).siblings('.addnum').addClass('show');
                            // 动画结束前只能点击一次
                            var addnum = $('.addnum_' + $(em).attr('comid'))[0];
                            addnum.addEventListener("webkitAnimationEnd", function () {
                                $('.show').removeClass('show');
                            });
                            $('.addnum_' + $(em).attr('comid')).css('color', 'red');
                            $('.addnum_' + $(em).attr('comid')).attr('disable', '1');
                        } else {
                            $.util.alert(msg.msg);
                        }
                    }
                }
            });
        }
        // 回复评论
        if (em.id.indexOf('reply_') != -1) {
            if ($('#article_comment').attr('user_id')) {
                if($(em).attr('user_id') == $('#article_comment').attr('user_id')) {
                    return;
                }
                var reply_id = $(em).attr('value');
                var msg = '回复 ' + $('#comment_username_' + reply_id).attr('user_name') + ' :';
                $('#r_textarea').attr('placeholder', msg);
                $('.reply-shadow').show();
                $('.reply').removeClass('m-height').addClass('c-height');
                var comid = $(em).attr('value');
                $('#publish_reply').attr('value', comid);
            } else {
                $.util.alert('请先登录');
                setTimeout(function () {
                    location.href = '/user/login?redirect_url=/activity/details/' + $('#enroll').attr('activity_id');
                }, 2000);
            }
        }
        switch (em.id) {
            // 点击评论
            case 'article_comment':
                if ($(em).attr('user_id')) {
                    $('.article-shadow').show();
                    $('.article').removeClass('m-height').addClass('c-height');
                } else {
                    $.util.alert('请先登录');
                    setTimeout(function () {
                        location.href = '/user/login?redirect_url=/activity/details/' + $('#enroll').attr('activity_id');
                    }, 2000);
                }
                break;
            // 回到顶部
            case 'toTop':
                window.scrollTo(0,0);
                break;
            // 取消评论
            case 'cancel':
                $('.reg-shadow').hide();
                $('.shadow-info').removeClass('c-height').addClass('m-height');
                break;
            // 喜欢
            case 'like':
                $('.like').toggleClass('changecolor');
                $('.like').toggleClass('scale');
                $.util.ajax({
                    url: '/activity/artLike/' + $(em).attr('artid'),
                    func: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $('.like').next('span').text(parseInt($('.like').next('span').text())+1);
                                $.util.alert(msg.msg);
                            } else {
                                $('.like').toggleClass('scale');
                                $('.like').toggleClass('changecolor');
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
                
            // 收藏
            case 'collect':
                $.util.ajax({
                    url: '/activity/collect/' + $(em).attr('artid'),
                    func: function (msg) {
                        if (typeof msg === 'object') {
                            if (msg.status === true) {
                                $.util.alert(msg.msg);
                                $(em).toggleClass('active');
                            } else {
                                $.util.alert(msg.msg);
                            }
                        }
                    }
                });
                break;
                
            // 评论文章
            case 'publish_article':
                if (window.article == true)
                {
                    setTimeout(function(){
                        window.article = true;
                    },2000);
                    window.article = false;
                    var data = {};
                    var body = $('textarea[name="comment-content-article"]').val();
                    if (!body) {
                        $.util.alert('内容不可为空');
                        return false;
                    }
                    data.body = body;
                    data.pid = 0;
                    var activity_id = $('#publish_article').attr('activity_id');
                    $.util.ajax({
                        url: '/activity/doComment/' + activity_id,
                        data: data,
                        func: function (msg) {
                            if (typeof msg === 'object') {
                                if (msg.status === true) {
                                    $.util.alert(msg.msg);
                                    var html = $.util.dataToTpl('', 'comment_tpl', msg.data, function (d) {
                                        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                        d.user_truename = d.user.truename; // 名字
                                        d.user_company = d.user.company; // 公司
                                        d.user_position = d.user.position; // 职务
//                                        d.reply = d.pid > 0 ? '@' + d.replyuser.truename : ''; // 是否回复别人的评论
                                        if (d.pid > 0) {
                                            d.body = '回复<span style="color:rgba(31, 27, 206, 0.95);"> ' + d.replyuser.truename + ' </span>：' + d.body;
                                        }
                                        return d;
                                    });
                                    $('#comment').prepend(html);
                                    $('#allComments').prepend(html);
                                    $('.reg-shadow').hide();
                                    $('.shadow-info').removeClass('c-height');
                                    $('.shadow-info').addClass('m-height');
                                } else {
                                    $.util.alert(msg.msg);
                                }
                            }
                        }
                    });
                }
                break;
            // 回复评论
            case 'publish_reply':
                if(window.reply == true)
                {
                    setTimeout(function(){
                        window.reply = true;
                    },2000);
                    window.reply == false;
                    var data = {};
                    var body = $('textarea[name="comment-content-reply"]').val();
                    if (!body) {
                        $.util.alert('内容不可为空');
                        return false;
                    }
                    data.body = body;
                    data.pid = $('#publish_reply').attr('value');
                    var activity_id = $('#publish_reply').attr('activity_id');
                    $.util.ajax({
                        url: '/activity/doComment/' + activity_id,
                        data: data,
                        func: function (msg) {
                            if (typeof msg === 'object') {
                                if (msg.status === true) {
                                    $.util.alert(msg.msg);
                                    var html = $.util.dataToTpl('', 'comment_tpl', msg.data, function (d) {
                                        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                        d.user_truename = d.user.truename; // 名字
                                        d.user_company = d.user.company; // 公司
                                        d.user_position = d.user.position; // 职务
//                                        d.reply = d.pid > 0 ? '@' + d.replyuser.truename : ''; // 是否回复别人的评论
                                        if (d.pid > 0) {
                                            d.body = '回复<span style="color:rgba(31, 27, 206, 0.95);"> ' + d.replyuser.truename + ' </span>：' + d.body;
                                        }
                                        return d;
                                    });
                                    $('#comment').prepend(html);
                                    $('#allComments').prepend(html);
                                    $('.reg-shadow').hide();
                                    $('.shadow-info').removeClass('c-height');
                                    $('.shadow-info').addClass('m-height');
                                } else {
                                    $.util.alert(msg.msg);
                                }
                            }
                        }
                    });
                }
                break;
            case 'enroll':
                if ($(em).attr('user_id')) {
                    location.href = '/activity/enroll/' + $(em).attr('activity_id');
                } else {
                    $.util.alert('请先登录');
                    setTimeout(function () {
                        location.href = '/user/login?redirect_url=/activity/details/' + $(em).attr('activity_id');
                    }, 1000);
                }
                break;
            case 'share':
                if(navigator.userAgent.toLowerCase().indexOf('micromessenger') == -1)
                {
                    LEMON.share.banner();
                }
                else if($.util.isWX)
                {
                    $('#wxshare').show();
                    $('#shadow').show();
                }
                break;
            case 'shadow':case 'wxshare':
                setTimeout(function(){
                    $('#shadow').hide();
                    $('#wxshare').hide();
                },301);
                break;
            case 'reply_shadow':
                setTimeout(function () {
                    $('.reg-shadow').hide();
                    $('.shadow-info').removeClass('c-height').addClass('m-height');
                }, 301);
                break;
            case 'article_shadow':
                setTimeout(function () {
                    $('.reg-shadow').hide();
                    $('.shadow-info').removeClass('c-height').addClass('m-height');
                },301);
                break;
            case 'goTop':
                window.scroll(0, 0);
                e.preventDefault();
                break;
        }
    });
};
(new activity()).init();