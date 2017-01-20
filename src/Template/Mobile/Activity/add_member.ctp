<div class="wraper">
    <div class="activity-entroll-more bgff">
        <ul class="outerblock">
            <input type="hidden" name="id" />
            <li class="flex">
                <span class="entroll-items">手机</span>
                <div><input type="text" placeholder="请输入手机号" name="phone" /></div>
            </li>
            <li class="flex">
                <span class="entroll-items">姓名</span>
                <div><input type="text" placeholder="请输入姓名" name="truename" /></div>
            </li>
            <li class="flex">
                <span class="entroll-items">公司</span>
                <div><input type="text" placeholder="请输入公司" name="company" /></div>
            </li>
            <li class="flex">
                <span class="entroll-items">职位</span>
                <div><input type="text" placeholder="请输入职位" name="position" /></div>
            </li>
        </ul>
        <div class="inner">
            <div class="nextstep" id="save">保存</div>
        </div>
    </div>
    <div class="activity-choosed-box mt60">
        <h3 class="choosed-box-title">已选同行人</h3>
        <ul id="member">
        </ul>
    </div>
    <div style="height: 100px;"></div>
    <a class="f-bottom" id="submit">确定</a>
</div>
<div class="reg-shadow" ontouchmove="return false;" hidden id="shadow"></div>
<div class="totips" hidden id="isDel" >
    <h3>确定要删除吗？</h3>
    <span style="display: none"></span>
    <a href="javascript:void(0)" class="tipsbtn bggray" id="no">否</a><a href="javascript:void(0)" class="tipsbtn bgred" id="yes">是</a>
</div>
<script type="text/html" id="tpl">
    <li class="choosed-box-items">
        <div class="chooseplace-info flex flex_jusitify box_start">
            <div class="flex box_start"><span class="user-name">{#truename#}</span> <div class="job position">{#position#}</div></div>
            <div class='r-info del'><i class="iconfont">&#xe67b;</i></div>
        </div>
        <div class="chooseplace-otherinfo flex box_start">
            <span class="l-info">公司</span> <div class="r-info company">{#company#}</div>
        </div>
        <div class="chooseplace-otherinfo">
            <span class="l-info">手机</span> <span class="phone">{#phone#}</span>
        </div>
    </li>
</script>
<?php $this->start('script'); ?>
<script>
    var choose = function (o){
        this.opt = {
            multi_nums: '<?= $activity->multi_nums ?>',
            activity_id: '<?= $activity->id ?>'
        };
        $.extend(this, this.opt, o);
    };
    $.extend(choose.prototype, {
        init: function (){
            this.input();
            this.saveBtn();
            this.delBtn();
            this.submit();
        },
        
        //手机号匹配用户
        input: function (){
            $('input[name="phone"]').on('input.prototypechange', function(){
                var phone = $(this).val();
                if(phone.length == 11){
                    if($.util.isMobile(phone)){
                        $.util.ajax({
                            url: '/activity/match-phone/' + phone,
                            func: function(res){
                                if(res.status){
                                    $('input[name="id"]').val(res.data.id);
                                    $('input[name="truename"]').val(res.data.truename);
                                    $('input[name="company"]').val(res.data.company);
                                    $('input[name="position"]').val(res.data.position);
                                } else {
                                    $.util.alert(res.msg);
                                }
                            }
                        });
                    }
                }
            });
        },
        
        //添加同行人
        saveBtn: function (){
            $('#save').on('tap', function(){
                if(!$.util.trim($('input[name="phone"]').val())){
                    $.util.alert('手机不能为空');
                    return;
                }
                if(!$.util.isMobile($('input[name="phone"]').val())){
                    $.util.alert('请填写合法的手机号码');
                    return;
                }
                if(!$.util.trim($('input[name="truename"]').val())){
                    $.util.alert('姓名不能为空');
                    return;
                }
                if(!$.util.trim($('input[name="company"]').val())){
                    $.util.alert('公司不能为空');
                    return;
                }
                if(!$.util.trim($('input[name="position"]').val())){
                    $.util.alert('职位不能为空');
                    return;
                }
                if($('.phone').length){
                    for(var i=0;i<$('.phone').length;i++){
                        if($('.phone').eq(i).html() == $('input[name="phone"]').val()){
                            $.util.alert('重复的号码');return false;
                        }
                    }
                }
                
                var html = $('#tpl').html();
                html = html.replace('{#truename#}', $('input[name="truename"]').val());
                html = html.replace('{#phone#}', $('input[name="phone"]').val());
                html = html.replace('{#company#}', $('input[name="company"]').val());
                html = html.replace('{#position#}', $('input[name="position"]').val());
                $('#member').prepend(html);
                $('input[name="id"], input[name="truename"], input[name="phone"], input[name="company"], input[name="position"]').val('');
            });
        },
        
        //删除同行人
        delBtn: function (){
            $.util.tap($('#member'), function(e){
                var target = e.srcElement || e.target, em = target, i = 1;
                while (em && !$(em).hasClass('del') && i <= 3) {
                    em = em.parentNode;
                    i++;
                }
                if (!em || !$(em).hasClass('del'))
                    return;
                if($(em).hasClass('del')){
                    $('#isDel, #shadow').show();
                    window.delTarget = $(em).parents('li');
                    return false;
                }
            });
            
            $('#shadow, #no').on('click', function(){
                $('#isDel, #shadow').hide();
            });
            
            $('#yes').on('click', function(){
                window.delTarget.remove();
                $('#isDel, #shadow').hide();
            });
        },
        
        //确定按钮
        submit: function (){
            var obj = this;
            $('#submit').on('click', function(){
                var form = {};
                if($('.phone').length >= (obj.multi_nums-1)){
                    for(var i=0;$('.phone').length>i;i++){
                        var arr = {
                            'truename': $('.user-name').eq(i).html(),
                            'phone': $('.phone').eq(i).html(),
                            'company': $('.company').eq(i).html(),
                            'position': $('.position').eq(i).html()
                        };
                        form['user' + i] = arr;
                    }
                } else {
                    $.util.alert('人数不足，无法确认');
                    return false;
                }
                $.util.ajax({
                    url: '/activity/multi-apply/'+obj.activity_id,
                    data: form,
                    func: function(res){
                        if(res.status){
                            location.href = '/activity/enroll/' + obj.activity_id + '/1';
                        } else {
                            $.util.alert(res.msg);
                        }
                    }
                });
            });
        }

    });
    
    var chooseobj = new choose();
    chooseobj.init();
    
</script>
<?php $this->end('script');
