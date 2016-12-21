<div class="wraper">
    <div class="train-items-box bgff">
        <div class="con">
            <ul class="outerblock" id="course">
            </ul>
        </div>
    </div>
    <div id="buttonLoading" class="loadingbox"></div>
</div>
<script type="text/html" id="tpl">
    <li class="con-items">
        <!--<a href="/course/detail/{#id#}">-->
            <div class="train-items course" course_id="{#id#}">
                <div class="pic-news">
                    <img src="{#cover#}" class="responseimg"/>
                </div>
                <div class="con-right-info">
                    <h3 class="nav-title line2">{#title#}</h3>
                    <div class="nav-desc line1"><p>{#abstract#}</p></div>
                    <div class="foot flex flex_jusitify">
                        <div class="price color-items">{#fee#}</div>
                        <div class="iconfont color-gray del" course_id="{#id#}">&#xe6b3;</div>
                    </div>
                </div>
            </div>
        <!--</a>-->
    </li>
</script>
<?php $this->start('script') ?>
<script>
    var course = function(o){
        this.opt = {
            init_page: 1,
        };
        $.extend(this, this.opt, o);
    };
    
    $.extend(course.prototype, {
        init: function(){
            this.getCourse();
            this.scroll();
            this.btn();
        },
        
        getCourse: function(){
            var obj = this;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/course/get-pay-course/"+obj.init_page,
                success: function (res) {
                    if(res.status){
                        $('#course').append(obj.dealCourseTpl(res.data));
                        obj.btn();
                        if(res.data.length < 10){
                            obj.init_page = 9999;
//                            $('#buttonLoading').html('亲，没有更多条目了，请看看其他的栏目吧');
                        } else {
                            obj.init_page++;
                        }
                    }
                }
            });
        },
        
        dealCourseTpl: function(data){
            var html = $.util.dataToTpl('', 'tpl', data, function(d){
                d.cover = d.course.cover;
                d.title = d.course.title;
                d.abstract = d.course.abstract;
                d.fee = d.course.fee ? '￥'+d.course.fee : '免费';
                d.id = d.course.id;
                return d;
            });
            return html;
        },
        
        scroll: function(){
            var obj = this;
            setTimeout(function(){
                $(window).on("scroll", function () {
                    $.util.listScroll('items', function () {
                        if(obj.init_page == 9999){
                            $('#buttonLoading').html('亲，没有更多条目了，请看看其他的栏目吧');
                            return;
                        }
                        $.util.showLoading('buttonLoading');
                        $.getJSON('/course/get-pay-course/'+obj.init_page,function(res){
                            console.log('page~~~'+obj.init_page);
                            $.util.hideLoading('buttonLoading');
                            window.holdLoad = false;  //打开加载锁  可以开始再次加载

                            if(!res.status) {  //拉不到数据了  到底了
                                obj.init_page = 9999;
                                return;
                            }

                            if(res.status){
                                var html = obj.dealCourseTpl(res.data);
                                $('#course').append(html);
                                if(res.data.length < 10){
                                    obj.init_page = 9999;
                                    $('#buttonLoading').html('亲，没有更多条目了，请看看其他的栏目吧');
                                } else {
                                    obj.init_page++;
                                }
                            }
                        });
                    });
                });
            }, 2000);
        },
        
        btn: function(){
            $('.del').on('tap', function(e){
                var obj = $(this);
                e.stopPropagation();
                var course_id = obj.attr('course_id');
                $.util.ajax({
                    url: '/course/del-pay-course/'+course_id,
                    func: function(res){
                        if(res.status){
                            obj.parents('li').remove();
                        }
                    }
                });
            });
            
            $('.course').on('tap', function(){
                var course_id = $(this).attr('course_id');
                location.href = '/course/detail/'+course_id;
            });
        },
        
    });
    
    var courseobj = new course();
    courseobj.init();
</script>
<?php $this->end('script');