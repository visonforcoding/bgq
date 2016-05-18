<header>
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            编辑话题
        </h1>

    </div>
</header>
<div class="wraper">
    <div class="h20">
    </div>
    <form action="" method="">
    <div class="a-form-box s-form-box">
        <ul>
            <li>
                <span>题目</span>
                <input name="title" type="text" />
            </li>
            <li>
                <i>话题简介</i>
                <textarea name="summary"></textarea>
            </li>
        </ul>
    </div>
    <div class="h20"></div>
    <div class="infobox paytype m-subject">
        <ul>
            <li>一对一面谈：<span class='infocard'><input type="radio" name='type' value="1" checked="checked" /><i class='active'></i></span></li>
            <li>一对多面谈：<span class='infocard reg-repass'><input type="radio" value="2" name='type' /><i></i></span></li>
        </ul>
    </div>
    <div class="infobox m-subject-info">
        <ul>
            <li>地点：<span class='infocard'><input type="text" type="text" name="address" value="深圳是福田区东海国际公寓" /></span></li>
            <li>时间：<span class='infocard reg-repass'><input type="text" name="invite_time" value='2015年5月20日15:00' /></span></li>
        </ul>
    </div>
    <div class="infobox m-subject-info">
        <ul class="s-price">
            <li>所需时间：<span class='infocard'>约<input type="text" name="last_time" value="" />小时</span></li>
            <li>价格：<span class='infocard reg-repass'><input type="text" name="price" value='' />元/次</span></li>
        </ul>
    </div>
    <div class="add-subject">
        <span>添加话题</span>
    </div>
    <div class="a-form-box s-form-box">
        <ul>
            <li>
                <i>专家简介</i>
                <textarea></textarea>
            </li>
        </ul>
    </div>
    </form>
    <a id="submit" href="#this" class="nextstep">提交</a>
</div>
<?php $this->start('script') ?>
<script>
    $('#submit').on('click', function () {
        $form = $('form');
        $.ajax({
            type: 'post',
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
            success: function (msg) {
                if (typeof msg === 'object') {
                    if (msg.status === true) {
                        window.location.href = '/home/index';
                    } else {
                        alert(msg.msg);
                    }
                }
            }
        });
        return false;
    });
</script>
<?php $this->end('script');