<div class="wraper newswraper">
    <div class="meet_search_box flex flex_center innercon">
        <div class="search-content">
            <i class="iconfont">&#xe602;</i>
            <input type="text" placeholder="搜索" />
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
<script type="text/html" id="mentorTpl">
    <li class="tab-con-box tab-booking">
        <div class="booking-items">
            <div class="nav-title flex">
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
                    <p>{#course_abstract#}</p>
                </div>
            </a>
        </div>
    </li>
</script>
<script type="text/html" id="bannerTpl">
    <li><a href="{#url#}"><img src="{#img#}"/></a></li>
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
        },
        
        getBanner: function(){
            var obj = this;
            if(!obj.init_banner || obj.no_cache){
                $.getJSON('/course/get-banner', function (res) {
                    if (res.status) {
                        obj.staticBanner(res.data);
                    }
                });
            } else {
                this.setHeader(JSON.parse(obj.init_banner));
            }
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
            var html = $.util.dataToTpl('', 'mentorTpl', data, function(d){
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
        }
    });
    
    var courseobj = new course();
    courseobj.init();
    

</script>
<?php
$this->end('script');
