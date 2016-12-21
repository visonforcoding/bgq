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
<?php $this->start('script') ?>
<script>
    var course = function(o){
        this.opt = {
            init_page: '<?= $page ?>',
            init_limit: '<?= $limit ?>',
            init_is_recom: '<?= $is_recom ?>',
            init_is_free: '<?= $is_free ?>'
        };
        $.extend(this, this.opt, o);
    };
    
    $.extend(course.prototype, {
        init: function(){
            this.getCourse();
            this.scroll();
        },
        
        getCourse: function(){
            var obj = this;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/course/get-course/"+obj.init_page+'/'+obj.init_limit+'/'+obj.init_is_recom+'/'+obj.init_is_free,
                success: function (res) {
                    if(res.status){
                        $('#course').append(obj.dealCourseTpl(res.data));
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
                d.fee = d.fee ? d.fee : '免费';
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
                        $.getJSON('/course/get-course/'+obj.init_page+'/'+obj.init_limit+'/'+obj.init_is_recom+'/'+obj.init_is_free,function(res){
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
        }
    });
    
    var courseobj = new course();
    courseobj.init();
</script>
<?php $this->end('script');