<script src="/mobile/js/view.js"></script>
<div class="wraper">
    <div class="entroll-search flex mt20">
        <div class="search—input"><input name="keyword" type="text" placeholder="请输入姓名或者手机号码" /></div>
        <input type="hidden" name="user_id1" />
        <input type="hidden" name="user_id2" />
        <span class="seachbtn" id="search">搜索</span>
    </div>
    <div class="enrolled innercon">
        <span id="choose_name">已选：<span class="chosen_user"></span> <span class="chosen_user"></span></span>
    </div>
    <div class="enrolled_choose">
        <ul class="ulblock" id="user">
        </ul>
    </div>
    <a href="javascript:void(0);" class="f-bottom" id="submit">确认</a>
</div>
<script type='text/html' id='tpl'>
    <li class="flex" user_id="{#id#}">
        <i class="iconfont ico choose_status">{#choose_status#}</i>
        <div class="r_info flex">
            <div class="avatar">
                <img src="{#avatar#}"/>
                {#v#}
            </div>
            <div class="userinfo">
                <h3 class="name"><span class="truename">{#truename#}</span> <span class="job">{#position#}</span></h3>
                <div class="commpany">{#company#}</div>
                <!--<div class="bominfo"><i class="iconfont color-items">&#xe6aa;</i>已选：习大大、奥巴马</div>-->
            </div>
        </div>
    </li>
</script>
<script>
    var user = function(o){
        this.opt = {
            activity_id: '<?= $activity_id; ?>',
            page: 1
        };
        $.extend(this, this.opt, o);
    };
    
    $.extend(user.prototype, {
        init: function(){
            this.getUser(this.page);
            this.choose();
            this.submit();
        },
        
        getUser: function(page){
            var obj = this;
            $('#search').on('click', function(){
                var keyword = $('input[name="keyword"]').val();
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "/activity/get-member/" + page,
                    data: {keyword:keyword},
                    success: function (res) {
                        if(res.status){
                            $.util.dataToTpl('user', 'tpl', res.data, function(d){
                                if(d.id == $('.chosen_user').eq(0).attr('user_id') || d.id == $('.chosen_user').eq(1).attr('user_id')){
                                    d.choose_status = '&#xe6a9;';
                                } else {
                                    d.choose_status = '&#xe6a8;';
                                }
                                if(d.level == 2){
                                    d.v = '<i class="v"></i>';
                                }
                                return d;
                            });
                            obj.page++;
                            obj.choose();
                        } else {
                            $('#user').html('');
                            $.util.alert(res.msg);
                        }
                    }
                });
            });
        },
        
        choose: function(){
            $('.flex').on('click', function(){
                var user_id = $(this).attr('user_id');
                var i = $(this).find('i.choose_status');
                i.toggleClass('chosen');
                if(i.hasClass('chosen')){
                    i.html('&#xe6a9;');
                    if($('.chosen_user').eq(0).html() == ''){
                        $('.chosen_user').eq(0).html($(this).find('span.truename').html());
                        $('.chosen_user').eq(0).addClass('user_'+user_id);
                        $('.chosen_user').eq(0).attr('user_id', user_id);
                    } else if($('.chosen_user').eq(1).html() == '') {
                        $('.chosen_user').eq(1).html($(this).find('span.truename').html());
                        $('.chosen_user').eq(1).addClass('user_'+user_id);
                        $('.chosen_user').eq(1).attr('user_id', user_id);
                    } else {
                        $.util.alert('最多选择两位同行人');
                        i.toggleClass('chosen');
                        i.html('&#xe6a8;');
                    }
                } else {
                    i.html('&#xe6a8;');
                    $('.user_'+user_id).html('').attr('user_id', '').removeClass('user_'+user_id);
                }
            });
        },
        
        scroll: function(page){
            
        },
        
        submit: function(){
            var obj = this;
            $('#submit').on('click', function(){
                if($('.chosen_user').eq(0).html == '' || $('.chosen_user').eq(0).html == ''){
                    $.util.alert('请继续选择同行人');
                    return;
                }
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "/activity/check-member/"+obj.activity_id,
                    data: {user1:$('.chosen_user').eq(0).attr('user_id'), user2:$('.chosen_user').eq(1).attr('user_id')},
                    success: function (res) {
                        if(res.status){
                            $.util.setCookie('acti_1_id', $('.chosen_user').eq(0).attr('user_id'));
                            $.util.setCookie('acti_1_name', $('.chosen_user').eq(0).html());
                            $.util.setCookie('acti_2_id', $('.chosen_user').eq(1).attr('user_id'));
                            $.util.setCookie('acti_2_name', $('.chosen_user').eq(1).html());
                            location.href = '/activity/enroll/'+obj.activity_id + '/' + '1';
                        } else {
                            $.util.alert(res.msg);
                        }
                    }
                });
            });
        }
    });
    
    var userobj = new user();
    userobj.init();
</script>