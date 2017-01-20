<div class="wraper">
    <form action="" method="post">
        <div class="infobox sing-up">
            <ul>
                <li>活动名称：<span class='infocard'><input type="text" name="title" value="<?= $activity->title; ?>" readonly/></span></li>
                <li>时间：<span class='infocard'><input type="text" name="time" value="<?= $activity->time->format('Y-m-d'); ?>" readonly/></span></li>
                <li>地点：<span class='infocard'><input type="text" name="address" value="<?= $activity->address; ?>" readonly/></span></li>
                <li>参与人：<span class='infocard'><input type="text" name="truename" value="<?= $user->truename; ?>" readonly/></span></li>
                <li>公司：<span class='infocard'><input type="text" name="company" value="<?= $user->company; ?>" readonly/></span></li>
                <li>职务：<span class='infocard'><input type="text" name="position" value="<?= $user->position; ?>" readonly/></span></li>
                <li>联系方式：<span class='infocard reg-pass'><input type="text" name="phone" value="<?= $user->phone; ?>" readonly/></span></li>
                <?php if ($activity->bonus_start_time < Cake\I18n\Time::now() && $activity->bonus_end_time > Cake\I18n\Time::now()): ?>
                    <li <?php if (!$triple): ?>class='no-bottom'<?php endif; ?>>费用：
                        <span class='infocard reg-repass'>
                            <input 
                                type="text"
                                name="apply_fee"
                                placeholder="<?= $triple ? $activity->bonus_triple_fee . '*' . $multi_nums . '=' . ($triple ? $activity->bonus_triple_fee : $activity->bonus_fee) * $multi_nums : $activity->bonus_fee; ?>元"
                                readonly/>
                        </span>
                    </li>
                <?php else: ?>
                    <li <?php if (!$triple): ?>class='no-bottom'<?php endif; ?>>费用：
                        <span class='infocard reg-repass'>
                            <input
                                type="text"
                                name="apply_fee"
                                placeholder="<?= $triple ? $activity->triple_fee . '*' . $multi_nums . '=' . ($triple ? $activity->triple_fee : $activity->apply_fee) * $multi_nums : $activity->apply_fee; ?>元"
                                readonly/>
                        </span>
                    </li>
                <?php endif; ?>
                <?php if ($triple): ?>
                    <li class='no-bottom'>同行人：<span class='infocard reg-repass'><input type="text" name="triple" placeholder="" readonly value="<?= $uname ?>"/></span></li>
                <?php endif; ?>
            </ul>
        </div>
        <a href="javascript:void(0)" class="nextstep" id="submit">提交</a>
        <!--<div class="line"><span class="mistips">活动费用不可退哦</span></div>-->
    </form>
</div>
<div class='reg-shadow' hidden id="shadow"></div>
<div class="totips suc" style="display:none;">
    <h3>活动报名成功</h3>
    <span></span>
    <a href="" class="nextstep comfirm">确认</a>
</div>
<div class="totips check" style="display:none;">
    <h3>活动申请已提交</h3>
    <span>秘书会在三个工作日内审核</span>
    <a href="" class="nextstep checkComfirm">确认</a>
</div>
<?php $this->start('script'); ?>
<script>
    window.must_check = <?= $activity->must_check; ?>;
</script>
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
                        setTimeout(function () {
                            if (window.must_check) {
                                $('.check').show('slow');
                                $('.checkComfirm').attr('href', msg.url);
                            } else {
                                $('.suc').show('slow');
                                $('.comfirm').attr('href', msg.url);
                            }
                            $('#shadow').show('slow');
                        }, 400);
                    } else {
                        $.util.alert(msg.msg);
                    }
                }
            }
        });
        return false;
    });
</script>
<?php
$this->end('script');
