<div class="wraper">
    <div class="train-items-box bgff">
        <div class="con">
            <ul class="outerblock" id="mentor">
            </ul>
        </div>
    </div>
</div>
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
<?php $this->start('script') ?>
<script>
    var mentor = function(o){
        this.opt = {
            
        };
        $.extend(this, this.opt, o);
    };
    
    $.extend(mentor.prototype, {
        init: function(){
            this.getSubscrMentor();
        },
        
        getSubscrMentor: function(){
            var obj = this;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/course/get-subscr-mentor/1",
                success: function (res) {
                    if(res.status){
                        $('#mentor').append(obj.dealMentorTpl(res.data));
                    } else {
                        $.util.alert(res.msg);
                    }
                }
            });
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
    });
    
    var mentorobj = new mentor();
    mentorobj.init();
</script>
<?php $this->end('script');