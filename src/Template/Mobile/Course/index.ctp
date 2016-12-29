<div class="wraper newswraper">
    <div class="meet_search_box flex flex_center innercon">
        <div class="search-content flex">
            <i class="iconfont">&#xe602;</i>
            <form id="searchForm" method="post">
                <input type="text" placeholder="搜索" name='keyword' />
            </form>
        </div>
    </div>
    <div style="height:68px;"></div>
    <div class="a-banner" >
        <ul class="pic-list-container" id="imgList">
        </ul>
        <div class="yd" id="imgTab">
        </div>
    </div>
    <!--分类--start-->
    <div class="menusort clearfix">
        <div class="allmenu">
            <div class="menulist clearfix" id="allsort">
                <a href="/course/all-course/1/0/0/0">
                    <i class="iconfont">&#xe6ae;</i>
                    <span>付费课程</span>
                </a>
                <a href="/course/all-course/1/0/0/1">
                    <i class="iconfont">&#xe6b1;</i>
                    <span>免费收听</span>
                </a>
                <a href="javascript:$.util.checkLogin('/course/all-mentor')">
                    <i class="iconfont">&#xe6b2;</i>
                    <span>我的订阅</span>
                </a>
                <a href="javascript:$.util.checkLogin('/course/pay-course')">
                    <i class="iconfont">&#xe6b0;</i>
                    <span>已购课程</span>
                </a>
            </div>
        </div>
    </div>
    <!--分类--end-->
    <div class="train-items-box bgff">
        <div class="m_title_des bd1">
            <a class="title" href="/course/all-course/1/0/1">推荐课程
                <span class="fr more">
                    查看更多
                    <i class="more iconfont rmore">&#xe667;</i>
                </span>
            </a>
        </div>
        <div class="con">
            <ul class="outerblock" id="recom_course">
            </ul>
        </div>
    </div>
    <!--d订阅-->
    <div class="train-items-box bgff mt20">
        <div class="m_title_des bd1">
            <a class="title" href="/course/all-course/1/0/0/1">免费试听
                <span class="fr more">
                    查看更多
                    <i class="more iconfont rmore">&#xe667;</i>
                </span>
            </a>
        </div>
        <div class="con">
            <ul class="outerblock" id="free_course">
            </ul>
        </div>
    </div>
    <!--订阅内容-->
    <div class="train-booking-box bgff mt20" id="subscribe">
        <div class="m_title_des bd1">
            <a class="title" href="/course/all_mentor">订阅内容
                <span class="fr more">
                    查看更多
                    <i class="more iconfont rmore">&#xe667;</i>
                </span>
            </a>
        </div>
        <div class="con">
            <ul class="outerblock" id="subscr_mentor">
            </ul>
        </div>
    </div>
    
    <div class="reg-shadow" style="display: none;" id="mentorData"></div>
</div>
<script type="text/html" id="courseTpl">
    <li class="con-items">
        <a href="/course/detail/{#id#}">
            <div class="train-items">
                <div class="pic-news">
                    <img src="{#cover#}" class="responseimg"/>
                </div>
                <div class="con-right-info">
                    <h3 class="nav-title line2">{#title#}</h3>
                    <div class="nav-desc line1"><p>{#abstract#}</p></div>
                    <div class="foot flex flex_jusitify">
                        <div class="price color-items">{#fee#}</div>
                        <!--<div class="marks">并购重组</div>-->
                    </div>
                </div>
            </div>
        </a>
    </li>
</script>
<script type="text/html" id="mentorSubTpl">
    <li class="tab-con-box tab-booking">
        <div class="booking-items">
            <div class="nav-title flex" id="mentor_{#id#}">
                <div class="avatar">
                    <img src='{#avatar#}' class="responseimg"/>
                </div>
                <div class="avatar-info">
                    <span>{#name#}</span> | 
                    <span>{#company#}</span> | 
                    <span>{#position#}</span>
                </div>
                <div class="price color-items">{#fee#}</div>
            </div>
            <a href="/course/detail/{#course_id#}">
                <div class="con">
                    <h3 class="title">{#course_title#}</h3>
                    <p class="line2">{#course_abstract#}</p>
                </div>
            </a>
        </div>
    </li>
</script>
<script type="text/html" id="bannerTpl">
    <li><a href="{#url#}"><img src="{#img#}"/></a></li>
</script>
<script type="text/html" id="mentorTpl">
    <div class="flex flex_center fullwraper">
        <div class="alert-booking">
            <div class="tab-con-box tab-booking">
                <div class="booking-items">
                    <div class="nav-title flex">
                        <div class="avatar">
                            <img src='{#avatar#}' class="responseimg"/>
                        </div>
                        <div class="avatar-info">
                            <h3 class="user-name"><span>{#name#}</span></h3>
                            <div class="company-info">
                                <span>{#company#}</span> | 
                                <span>{#position#}</span>
                            </div>
                        </div>
                        <div class="btn-booking color-items" id="subscr_{#id#}" mentor_id="{#id#}">{#subscr_msg#}</div>
                    </div>
                    <div class="pro">
                        <p>{#introduce#}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<?= $this->element('footer') ?>
<?php $this->start('script'); ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    var course = function(o){
        this.opt = {
            init_banner: LEMON.db.get('course_banner'),
        };
        $.extend(this, this.opt, o);
    };
    
    $.extend(course.prototype, {
        init: function(){
            this.getBanner();
            this.getRecomCourse();
            this.getFreeCourse();
            this.getSubscrMentor();
            this.search();
            this.bodyTap();
        },
        
        getBanner: function(){
            var obj = this;
            $.getJSON('/course/get-banner', function (res) {
                if (res.status) {
                    obj.staticBanner(res.data);
                }
            });
        },
        
        staticBanner: function (netBanner){
            var obj = this;
            var str = JSON.stringify(netBanner);
            if(str == obj.init_banner){
                this.setHeader(JSON.parse(obj.init_banner));
            } else {
                LEMON.db.set('course_banner', str);
                this.setHeader(JSON.parse(str));
            }
        },
        
        setHeader: function (data){
            var tab = [], html = $.util.dataToTpl('', 'bannerTpl', data, function (d) {
                tab.push('<span></span>');
                return d;
            });
            $('#imgList').html(html);
            $('#imgTab').html(tab.join(''));
            var loop = $.util.loopImg($('#imgList'), $('#imgList li'), $('#imgTab span'), $('.a-banner'));
        },
        
        getRecomCourse: function(){
            var obj = this;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/course/get-course/1/3/1",
                success: function (res) {
                    if(res.status){
                        $('#recom_course').append(obj.dealCourseTpl(res.data));
                    }
                }
            });
        },
        
        getFreeCourse: function(){
            var obj = this;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/course/get-course/1/3/0/1",
                success: function (res) {
                    if(res.status){
                        $('#free_course').append(obj.dealCourseTpl(res.data));
                    }
                }
            });
        },
        
        dealCourseTpl: function(data){
            var html = $.util.dataToTpl('', 'courseTpl', data, function(d){
                d.fee = d.fee ? '￥'+d.fee : '免费';
                return d;
            });
            return html;
        },
        
        dealMentorTpl: function(data){
            var html = $.util.dataToTpl('', 'mentorSubTpl', data, function(d){
                d.course = d.classes[0].course;
                d.course_title = d.course.title;
                d.course_abstract = d.course.abstract;
                d.course_id = d.course.id;
                return d;
            });
            return html;
        },
        
        getSubscrMentor: function(){
            if($.util.isLogin()){
                var obj = this;
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "/course/get-subscr-mentor/1/3",
                    success: function (res) {
                        if(res.status){
                            $('#subscribe').show();
                            $('#subscr_mentor').append(obj.dealMentorTpl(res.data));
                        } else {
                            $('#subscribe').hide();
                        }
                    }
                });
            } else {
                $('#subscribe').hide();
            }
        },
        
        search: function(){
            $('#searchForm').on('submit', function(){
                if($('input[name="keyword"]').val() == ''){
                    return false;
                } else {
                    location.href = encodeURI('/course/search/'+$('input[name="keyword"]').val());
                    return false;
                }
            });
        },
        
        bodyTap: function(){
            var obj = this;
            $.util.tap($('body'), function(e){
                var target = e.srcElement || e.target, em = target, i = 1;
                while (em && !em.id && i <= 3) {
                    em = em.parentNode;
                    i++;
                }
                if (!em || !em.id)
                    return;
                if(em.id.indexOf('mentor_') != -1){
                    var tapObj = $(em);
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "/course/get-mentor-data/"+tapObj.attr('mentor_id'),
                        success: function (res) {
                            if(res.status){
                                $('#mentorData').html(obj.dealMentor(res.data)).show();
                            }
                        }
                    });
                }
                if(em.id.indexOf('subscr_') != -1){
                    if(!$.util.isLogin()){
                        $.util.alert('请先登录');
                        setTimeout(function(){location.href = '/user/login?redirect_url='+document.URL;}, 500);
                        return;
                    }
                    var tapObj = $(em);
                    $.util.ajax({
                        url: '/course/subscr-mentor/'+$(em).attr('mentor_id'),
                        func: function(res){
                            $.util.alert(res.msg);
                            if(res.data){
//                                $('#subscr_'+tapObj.attr('mentor_id')).html('订阅');
                                $('#mentorData').hide();
                                $('#mentor_'+$(em).attr('mentor_id')).parents('li').remove();
                            } else {
                                $('#subscr_'+tapObj.attr('mentor_id')).html('取消订阅');
                            }
                        }
                    });
                }
                switch(em.id){
                    case 'mentorData':
                        setTimeout(function(){
                            $('#mentorData').hide();
                        }, 301);
                        break;
                }
            });
        },
        
        dealMentor: function(data){
            var html = $.util.dataToTpl('', 'mentorTpl', data, function(d){
                if(d.mentor_subscribe){
                    d.subscr_msg = d.mentor_subscribe.is_del ? '订阅' : '取消订阅';
                } else {
                    d.subscr_msg = '订阅';
                }
                return d;
            });
            return html;
        }
    });
    
    var courseobj = new course();
    courseobj.init();
    

</script>
<?php
$this->end('script');
