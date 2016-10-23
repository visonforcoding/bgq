<div class="wraper">
    <div class="m-pos-title">
        <h3>约谈话题：<?= $book->subject->title ?></h3>
    </div>
    <div class="dialogue" style="padding-top:1.2rem">
        <ul id="chat">
        </ul>
    </div>
</div>
<?php if ($book->is_done != 1): ?>
    <div style="height:2.8rem"></div>
    <div class="todialogue">
        <div class="clearfix b-text">
            <div class="r-input">
                <textarea id="content" placeholder="请在这里输入你想发送的话"></textarea>
            </div>
            <span class="r-submit" >发送</span>
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
    function getChat() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/home/get-chat/" + book_id + '/' + type,
            success: function (res) {
                if (res.status) {
                    $.util.dataToTpl('chat', 'tpl', res.data, function (d) {
                        if (d.user.id == uid) {
                            d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            d.msg = '<li class="fr"><div class="m-online-r"><span>' + d.content + '</span><time>' + d.create_time + '</time></div><a href="/user/home-page/'+ d.user.id +'"><img src="' + d.user_avatar + '" class="m_online-pic" /></a></li>';
                        } else {
                            d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                            d.msg = '<li class="fl"><a href="/user/home-page/'+ d.user.id +'"><img src="' + d.user_avatar + '" class="m_online-pic" /></a><div class="m-online-r"><span>' + d.content + '</span><time>' + d.create_time + '</time></div></li>';
                        }
                        return d;
                    });
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    }

    getChat();
    if (is_done == '0') {
        setInterval(function () {
            getChat();
        }, 8000);
    }

    $('.r-submit').on('tap', function () {
        if (is_done == '1') {
            return false;
        }
        if ($('#content').val() == '') {
            $.util.alert('请填写内容');
            return false;
        }
        var content = $('#content').val();
        $('#content').blur();
        $.ajax({
            type: 'POST',
            data: {content: content},
            dataType: 'json',
            url: "/home/reply-chat/" + book_id + '/' + type,
            success: function (res) {
                if (res.status) {
                    $('#content').val('');
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: "/home/get-chat/" + book_id + '/' + type,
                        success: function (res) {
                            if (res.status) {
                                $.util.dataToTpl('chat', 'tpl', res.data, function (d) {
                                    if (d.user.id == uid) {
                                        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                        d.msg = '<li class="fr"><div class="m-online-r"><span>' + d.content + '</span><time>' + d.create_time + '</time></div><img src="' + d.user_avatar + '" class="m_online-pic" /></li>';
                                    } else {
                                        d.user_avatar = d.user.avatar ? d.user.avatar : '/mobile/images/touxiang.png';
                                        d.msg = '<li class="fl"><img src="' + d.user_avatar + '" class="m_online-pic" /><div class="m-online-r"><span>' + d.content + '</span><time>' + d.create_time + '</time></div></li>';
                                    }
                                    return d;
                                });
                            } else {
                                $.util.alert(res.msg);
                            }
                        }
                    });
                } else {
                    $.util.alert(res.msg);
                }
            }
        });
    });
    
    setTimeout(function () {
        window.scrollTo(0, 99999);
    }, 200);
</script>
<?php
$this->end('script');
