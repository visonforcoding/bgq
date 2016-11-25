<div class="wraper">
    <ul class="chatinfo_list">
        <?php foreach ($subjectBook as $k=>$v): ?>
        <li>
            <a link="/home/book-chat/<?= $v['id'] ?>/<?php if($v['user_id'] == $uid): ?>1<?php else: ?>2<?php endif; ?>" class="flex flex_jusitify subjectBook" table_id='<?= $v['id'] ?>'>
                <div class="l_info">
                    <div class="avatar">
                        <img src="../images/home-pic.png" alt="" />
                        <?php if($v['unReadMsg']): ?>
                            <i class="num"><?= $v['unReadMsg'] ?></i>
                        <?php endif; ?>
                    </div>
                    <div class='l_text'>
                        <?php if($v['user_id'] == $uid): ?>
                            <h3 class="title flex"><i><?= $v['savant']['truename'] ?></i> <span class="job line1"><?= $v['savant']['company'] ?> / <?= $v['savant']['position'] ?></span></h3>
                        <?php else: ?>
                            <h3 class="title flex"><i><?= $v['user']['truename'] ?></i> <span class="job line1"><?= $v['user']['company'] ?> / <?= $v['user']['position'] ?></span></h3>
                        <?php endif; ?>
                        <span class="cont"><i class='iconfont'>&#xe6aa;</i><?= $v['subject']['title'] ?></span>
                    </div>
                </div>
                <div class="r_info">
                    <time><?= $v['last_msg_time'] ?></time>
                </div>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<script>
    window.onBackView = function(){
        location.reload();
    };
    
    $('.subjectBook').on('click', function(){
        var obj = $(this);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/meet/read-msg/" + obj.attr('table_id'),
            success: function (res) {
                location.href = obj.attr('link');
//                if (res.status) {
//                    
//                } else {
//                    $.util.alert(res.msg);
//                }
            }
        });
    });
</script>