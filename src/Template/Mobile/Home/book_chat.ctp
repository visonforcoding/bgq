<div class="wraper">
<!--    <div class="m-pos-title">
        <h3>约谈话题：<?= $book->subject->title ?></h3>
    </div>-->
    <div class="dialogue" style="padding-top:1.2rem">
        <ul id="chat">
            <?php if($book->savant_id == $uid): ?>
                <li class="fl">
                    <div class="flex chatbox">
                        <div class="avatar">
                            <img src="../images/nv05.png"/>
                        </div>
                        <div class="chat_text">
                            <span>我已约见你发布的话题【<?= $book->subject->title ?>】期待您的回应！<br />
                                <?php if($book->status == 0): ?>
                                    <a href="javascript:bookNo(<?= $book->id ?>);">拒绝</a> <a href="javascript:bookOk(<?= $book->id ?>);">接受</a>
                                <?php else: ?>
                                    <a href="/home/my-book-savant-detail/<?= $book->id ?>">查看详情</a>
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </li>
                <div class="desc"><span><?= $book->summary ?></span></div>
            <?php else: ?>
                <li class="fr">
                    <div class="flex chatbox">
                        <div class="chat_text">
                            <span>我已发出约见，快来确认吧。<br />
                            <a href="/home/my-book-detail/<?= $book->id ?>">查看详情</a></span>
                        </div>
                        <div class="avatar">
                            <img src="<?= $user->avatar ?>"/>
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
    </div>
</div>
<?php if ($book->is_done != 1 && $book->status == 1): ?>
    <!--<div style="height:2.8rem"></div>-->
    <div style="height:1.5rem"></div>
    <div class="chatbottom">
        <div class="chatcon flex flex_jusitify">
            <input type="text" placeholder="请在这里输入你想发送的话" id="content" />
            <button id="submit">发送</button>
        </div>
    </div>
<?php endif; ?>
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
        $.util.ajax({
            url:'/home/book-ok',
            data:{id:id},
            func:function(res){
                $.util.alert(res.msg);
                setTimeout(function(){
                    location.reload();
                },1500);
            }
         });
    }
    
    function bookNo(id){
        $.util.ajax({
            url:'/home/book-no/'+id,
            func:function(res){
              $.util.alert(res.msg);
              setTimeout(function(){
                   location.reload();
                },1500);
            }
         });
    }
</script>
<?php
$this->end('script');
