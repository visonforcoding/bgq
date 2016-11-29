<div class="wraper">
<!--    <div class="m-pos-title">
        <h3>约谈话题：<?= $book->subject->title ?></h3>
    </div>-->
    <div class="dialogue chatlist" style="padding-top:1.2rem">
        <ul id="chat">
            <?php if($book->savant_id == $uid): ?>
                <li class="fl">
                    <div class="flex chatbox">
                        <div class="avatar">
                            <a href="/user/home-page/<?= $user->id ?>">
                                <img src="<?= $user->avatar; ?>"/>
                            </a>
                        </div>
                        <div class="chat_text">
                            <span>我已约见你发布的话题【<?= $book->subject->title ?>】期待您的回应！<br />
                                <?php if($book->summary): ?>
                                    我的需求是：<?= $book->summary ?> <br />
                                <?php endif; ?>
                                <?php if($book->status == 0): ?>
                                    <a href="javascript:bookNo(<?= $book->id ?>);">拒绝</a> <a href="javascript:bookOk(<?= $book->id ?>);">接受</a>
                                <?php else: ?>
                                    <a href="/home/my-book-savant-detail/<?= $book->id ?>">查看详情</a>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </li>
            <?php else: ?>
                <li class="fr">
                    <div class="flex chatbox">
                        <div class="chat_text">
                            <span>我已发出约见，快来确认吧。<br />
                            <a href="/home/my-book-detail/<?= $book->id ?>">查看详情</a></span>
                        </div>
                        <div class="avatar">
                            <a href="/user/home-page/<?= $user->id ?>">
                                <img src="<?= $me->avatar; ?>"/>
                            </a>
                        </div>
                    </div>
                </li>
                <?php if($book->status == 1): ?>
                    <div class="desc"><span>对方已接受你的约见</span></div>
                <?php elseif($book->status == 2): ?>
                    <div class="desc"><span>对方已拒绝你的约见</span></div>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <?php if($book->is_done == 1): ?>
            <?php if($book->user_id == $uid): ?>
                <div class="desc"><span>对方已结束这次对话</span></div>
            <?php else: ?>
                <div class="desc"><span>你已结束这次对话</span></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php if ($book->is_done != 1 && $book->status == 1): ?>
    <!--<div style="height:2.8rem"></div>-->
    <div style="height:1.5rem"></div>
    <div class="chatbottom">
        <div class="chatcon flex flex_jusitify">
            <textarea class="sub-text" id="content" ></textarea>
            <button id="submit">发送</button>
        </div>
    </div>
    <?php if($book->savant_id == $uid): ?>
        <div class="over-meet" id="done">
            <span>约见<br>结束</span>
        </div>
    <?php endif; ?>
<?php endif; ?>
<div class="reg-shadow" ontouchmove="return false;" hidden id="shadow"></div>
<div class="totips" hidden id="is_done" >
    <h3>确定要结束这个对话吗？</h3>
    <span style="display: none"></span>
    <a href="javascript:void(0)" class="tipsbtn bggray" id="no">否</a><a href="javascript:void(0)" class="tipsbtn bgred" id="yes">是</a>
</div>
<script type="text/html" id="tpl">
    {#msg#}
</script>
<?php $this->start('script'); ?>
<script>
    var uid = '<?= $uid ?>';
    var book_id = '<?= $book->id ?>';
    var type = '<?= $type ?>';
    var is_done = '<?= $book->is_done ?>';
</script>
<script type="text/javascript">
    window.bookOk_noTap = false;
    window.bookNo_noTap = false;
    if($.util.isAPP){
        if($.util.getParam('book')){
            LEMON.sys.back('/meet/index');
        }
    }
    
    window.is_circle = false;
    function getChat(stat) {
        var url;
        if(stat == 1){
            url = "/home/get-chat/" + book_id;
        } else {
            url = "/home/get-new-chat/" + book_id + '/' + type
        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: url,
            success: function (res) {
                if (res.status) {
                    var html = $.util.topDataToTpl('', 'tpl', res.data, function (d) {
                        var msg = '';
                        if(d.is_show_time == 1){
                            msg = '<div class="desc"><span>'+d.create_time+'</span></div>';
                        }
                        if (d.user.id == uid) {
                            d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            msg += '<li><div class="flex chatbox fr"><div class="chat_text"><span>'+d.content+'</span></div><a class="avatar ablock" href="/user/home-page/'+ d.user.id +'"><img src="'+d.user_avatar+'"/></a></div></li>';
                        } else {
                            d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            msg += '<li><div class="flex chatbox fl"><a class="avatar ablock" href="/user/home-page/'+d.user.id+'"><img src="'+d.user_avatar+'"/></a><div class="chat_text"><span>' + d.content + '</span></div></div></li>';
                        }
                        d.msg = msg;
                        return d;
                    });
                    $('#chat').append(html);
                    window.scrollTo(0, 99999);
                    window.is_circle = true;
                }
            }
        });
    }
    getChat(1);
    if (is_done == '0') {
        setInterval(function () {
            if(window.is_circle) getChat(2);
        }, 8000);
    }

    $('#submit').on('tap', function () {
        var obj = $(this);
        if (is_done == '1') {
            return false;
        }
        if(obj.hasClass('noTap')){
            return false;
        }
        obj.addClass('noTap');
        if ($('#content').val() == '') {
            $.util.alert('请填写内容');
            obj.removeClass('noTap');
            return false;
        }
        var content = $('#content').val();
        $('#content').blur();
        $('#content').val('');
        $.ajax({
            type: 'POST',
            data: {content: content},
            dataType: 'json',
            url: "/home/reply-chat/" + book_id + '/' + type,
            success: function (res) {
                if (res.status) {
                    var html = $.util.topDataToTpl('', 'tpl', res.data, function (d) {
                        var msg = '';
                        if(d.is_show_time){
                            msg = '<div class="desc"><span>'+d.create_time+'</span></div>';
                        }
                        if (d.user.id == uid) {
                            d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            msg += '<li class="fr"><div class="flex chatbox"><div class="chat_text"><span>'+d.content+'</span></div><div class="avatar"><a href="/user/home-page/'+ d.user.id +'"><img src="'+d.user_avatar+'"></a></div></div></li>';
                        } else {
                            d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            msg += '<li class="fl"><div class="flex chatbox"><div class="avatar"><img src="'+d.user_avatar+'"></div><div class="chat_text"><span>' + d.content + '</span></div></div></li>';
                        }
                        d.msg = msg;
                        return d;
                    });
                    $('#chat').append(html);
                    window.scrollTo(0, 99999);
                } else {
                    $.util.alert(res.msg);
                }
                obj.removeClass('noTap');
            }
        });
    });
    
    function bookOk(id){
        if(window.bookOk_noTap){
            return;
        }
        window.bookOk_noTap = true;
        $.util.ajax({
            url:'/home/book-ok',
            data:{id:id},
            func:function(res){
                $.util.alert(res.msg);
                if(res.status){
                    setTimeout(function(){
                        location.reload();
                    }, 500);
                } else {
                    window.bookOk_noTap = false;
                }
            }
         });
    }
    
    function bookNo(id){
        if(window.bookNo_noTap){
            return;
        }
        window.bookNo_noTap = true;
        $.util.ajax({
            url:'/home/book-no/'+id,
            func:function(res){
              $.util.alert(res.msg);
              if(res.stauts){
                setTimeout(function(){
                     location.reload();
                  }, 500);
              } else {
                  window.bookNo_noTap = false;
              }
            }
         });
    }
    
    $('#done').on('click', function(){
        $('#shadow').show();
        $('.totips').show();
    });
    
    $('#yes').on('click', function(){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/change-subject-status/" + book_id,
            success: function (res) {
                $.util.alert(res.msg);
                if (res.status) {
                    location.reload();
                }
            }
        });
    });
    
    $('#no, #shadow').on('click', function(){
        $('#shadow').hide();
        $('.totips').hide();
    });
</script>
<?php
$this->end('script');
