<div class="wraper">
    <div class="h20">
    </div>
    <div id='elite'></div>
</div>
<script type='text/html' id='biggie_tpl'>
    <section class="internet-v-info">
        <div class="innercon">
            <a href="/user/home-page/{#id#}"><span class="head-img"><img init_src="{#avatar#}"><i></i></span></a>
            <div class="vipinfo bd1">
                <div class="fl c_info_list">
                    <a href="/user/home-page/{#id#}">
                        <h3><div class="l-name">{#truename#}</div><div class="job line1">{#position#}</div></h3>
                        <span class="job">{#company#}</span>
                    </a>
                    <div class="mark line1">
                        {#subjects#}
                    </div>
                </div>
                <div class="m_focus_r r_focus_num fl {#focus_class#}" user_id="{#id#}" {#focus_id_str#}>
                    <span class="meetnum">{#meet_nums#}人聊过</span>
                    <i class="iconfont">&#xe614;</i>
                    <span class="msg">{#focus_msg#}</span>
                </div>
            </div>
        </div>
    </section>
</script>
<script type='text/html' id='subTpl'>
    <a href="javascript:$.util.checkLogin('/meet/subject-detail/{#id#}/#index')" class="line1 w7"><i class="iconfont color-items">&#xe6aa;</i>{#title#}</a>
</script>
<script type='text/html' id='mySubTpl'>
    <a href="/meet/subject/{#id#}" class="line1 w7"><i class="iconfont color-items">&#xe6aa;</i>{#title#}</a>
</script>
<?php $this->start('script'); ?>
<script>
    var meet = function(o){
        this.opt = {
            no_cache: true,
            init_data: LEMON.db.get('vip'), // 页面初始直接获取的数据
            init_elite: LEMON.db.get('elite'),
            init_banner: LEMON.db.get('banner'),
            init_biggieAd: LEMON.db.get('biggieAd')
        };
        $.extend(this, this.opt, o);
    };
    
    $.extend(meet.prototype, {
        init:function(){
            this.getElite();
        },
        
        getElite: function(){
            var obj = this;
            if(!obj.init_elite || obj.no_cache){
                $.getJSON('/meet/get-elite', function (res) {
                    if (res.status) {
                        obj.staticElite(res.data);
                    }
                });
            } else {
                var html = $.util.dataToTpl('', 'biggie_tpl', JSON.parse(obj.init_elite), tpldate);
                $('#elite').append(html);
            }
        },
        staticElite: function (netData){
            var str = JSON.stringify(netData);
            if(str == this.init_elite){
                $.util.dataToTpl('elite', 'biggie_tpl', JSON.parse(this.init_elite), tpldate);
            } else {
                LEMON.db.set('elite', str);
                $.util.dataToTpl('elite', 'biggie_tpl', JSON.parse(str), tpldate);
            }
        }
    });
    var meetobj = new meet();
    meetobj.init();
    
    function tpldate(d) {
        d.id = d.id ? d.id : '';
        d.avatar = d.avatar ? d.avatar : '/mobile/images/touxiang.png';
        //        d.city = d.city ? '<div class="l-place"><i class="iconfont">&#xe660;</i>' + d.city + '</div>' : '';
        d.city = '';
        var subject = d.subjects.length ? d.subjects[0] : '';
        if (window.user_id == d.id) {
            d.subjects = subject ? '<a href="/meet/subject/' + subject.id + '"><i class="iconfont color-items">&#xe6aa;</i>' + subject.title + '</a>' : '';
        } else {
            d.subjects = subject ? '<a href="javascript:$.util.checkLogin(\'/meet/subject-detail/' + subject.id + '/#index\')"><i class="iconfont color-items">&#xe6aa;</i>' + subject.title + '</a>' : '';
        }
        d.focus_msg = d.followers ? '已关注' : '加关注';
        d.focus_class = d.followers ? '' : 'color-items';
        d.focus_id_str = d.followers ? '' : 'id="focus_' + d.id + '"';
        return d;
    }
    
    $('body').on('tap', function (e) {
        var target = e.srcElement || e.target, em = target, i = 1;
        while (em && !em.id && i <= 3) {
            em = em.parentNode;
            i++;
        }
        if (!em || !em.id)
            return;
        if (em.id.indexOf('focus_') != -1) {
            var obj = $(em);
            if (obj.hasClass('notap')) {
                return false;
            }
            obj.addClass('notap');
            var user_id = obj.attr('user_id');
            $.util.ajax({
                url: '/user/follow',
                data: {id: user_id},
                func: function (res) {
                    $.util.alert(res.msg);
                    if (res.status) {
                        if (res.msg.indexOf('取消关注') != '') {
                            obj.removeClass('color-items').find('span.msg').html('已关注');
                        } else {
                            obj.find('span.msg').html('加关注');
                            obj.removeClass('notap');
                        }
                    }
                }
            });
        }
    });
</script>
<?php $this->end('script');
