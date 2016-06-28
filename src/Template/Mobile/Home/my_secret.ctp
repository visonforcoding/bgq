<link rel="stylesheet" type="text/css" href="/mobile/css/mobiscroll.css"/>
<header class="myhome">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            隐私策略
        </h1>
    </div>
</header>
<div class="wraper">
    <form action="" method="post">
        <ul class="h-info-box e-info-box">
            <li>
                <a href="javascript:void(0)">
                    <span>联系电话：</span>
                    <div>
                        <select name="phone_set" class='choice'>
                            <option value="1" <?php if (isset($secret)): ?><?php if ($secret->phone_set == '1'): ?>selected="selected"<?php endif; ?> <?php endif; ?>>公开</option>
                            <option value="2" <?php if (isset($secret)): ?><?php if ($secret->phone_set == '2'): ?>selected="selected"<?php endif; ?> <?php endif; ?>>不公开</option>
                        </select>
                    </div>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <span>邮箱：</span>
                    <div>
                        <select name="email_set" class='choice'>
                           <option value="1" <?php if (isset($secret)): ?><?php if ($secret->email_set == '1'): ?>selected="selected"<?php endif; ?> <?php endif; ?>>公开</option>
                            <option value="2" <?php if (isset($secret)): ?><?php if ($secret->email_set == '2'): ?>selected="selected"<?php endif; ?> <?php endif; ?>>不公开</option>
                        </select>
                    </div>
                </a>
            </li>
            <li class="nobottom">
                <a href="javascript:void(0)">
                    <span>我的资料：</span>
                    <div>
                        <select name="profile_set" class='choice'>
                            <option value="1" <?php if (isset($secret)): ?><?php if ($secret->profile_set == '1'): ?>selected="selected"<?php endif; ?> <?php endif; ?>>公开</option>
                            <option value="2" <?php if (isset($secret)): ?><?php if ($secret->profile_set == '2'): ?>selected="selected"<?php endif; ?> <?php endif; ?>>不公开</option>
                        </select>
                    </div>
                </a>
            </li>
        </ul>
        <p class="inner f-color-gray">资料包括行业、擅长业务、标签、工作经历、教育经历等</p>
        <a id="submit" href="javascript:void(0);" class="nextstep">保存</a>
    </form>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/jquery.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/mobiscroll.2.13.2.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/util.js" type="text/javascript" charset="utf-8"></script>

<script>
    $('.choice').mobiscroll().select({
        theme: 'mobiscroll',
        display: 'bottom',
        headerText: function (valueText) {
            return "是否公开";
        },
        rows: 2
    });
    $('#submit').click(function () {
        var form = $('form');
        $.util.ajax({
            data: $(form).serialize(),
            func: function (res) {
                $.util.alert(res.msg);
                if (res) {
                    window.location.href = '/home/index';
                }
            }
        });
    });
</script>
<?php
$this->end('script');
