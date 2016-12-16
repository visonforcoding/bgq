<div class="wraper">
    <div class="train-items-box bgff">
        <div class="con">
            <ul class="outerblock" id="course">
            </ul>
        </div>
    </div>
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
    });
    
    var courseobj = new course();
    courseobj.init();
</script>
<?php $this->end('script');