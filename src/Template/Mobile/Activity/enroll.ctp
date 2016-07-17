<body>
    <div class="wraper">
        
        <form action="" method="post">
            <div class="infobox sing-up">
                <ul>
                    <li>活动名称：<span class='infocard'><input type="text" name="title" value="<?= $activity->title; ?>" readonly/></span></li>
                    <li>时间：<span class='infocard'><input type="text" name="time" value="<?= $activity->time; ?>" readonly/></span></li>
                    <li>地点：<span class='infocard'><input type="text" name="address" value="<?= $activity->address; ?>" readonly/></span></li>
                    <li>参与人：<span class='infocard'><input type="text" name="truename" value="<?= $user->truename; ?>" readonly/></span></li>
                    <li>公司：<span class='infocard'><input type="email" name="company" value="<?= $user->company; ?>" readonly/></span></li>
                    <li>职务：<span class='infocard'><input type="text" name="position" value="<?= $user->position; ?>" readonly/></span></li>
                    <li>联系方式：<span class='infocard reg-pass'><input type="text" name="phone" value="<?= $user->phone; ?>" readonly/></span></li>
                    <li class='no-bottom'>费用：<span class='infocard reg-repass'><input type="text" name="apply_fee" placeholder="<?= $activity->apply_fee; ?>元" readonly/></span></li>
                </ul>
            </div>
            <div style="margin: 0.1rem 0 0 0.3rem;font-size: 0.3rem;color:red;">活动报名，费用不可退，请谨慎提交</div>
            <a href="javascript:void(0)" class="nextstep" id="submit">提交</a>
        </form>
    </div>
    <div class='reg-shadow' hidden></div>
    <div class="totips" style="display:none;">
        <h3>活动报名成功</h3>
        <span></span>
        <a href="" class="nextstep" id="comfirm">确认</a>
<!--        <span class='closed'>
            &times;
        </span>-->
    </div>
</body>
<?php $this->start('script'); ?>
<script>
    $('#submit').on('tap', function () {
        $form = $('form');
        $.ajax({
            type: 'post',
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        $.util.alert(msg.msg);
                        if(msg.url.indexOf('/Wx/') != -1){
                            setTimeout(function(){
                                window.location.href = msg.url;
                            },2000);
                        } else {
                            $('.reg-shadow').show('slow');
                            $('.totips').show('slow');
                            $('#comfirm').attr('href', msg.url);
                        }
                    }
                }
            }
        });
        return false;
    });
    $('.closed').on('click', function(){
        $('.reg-shadow').hide('slow');
        $('.totips').hide('slow');
    });
</script>
<?php
$this->end('script');
