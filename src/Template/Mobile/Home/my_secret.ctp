<header class="myhome">
    <div class='inner'>
        <a href='javascript:history.go(-1);' class='toback'></a>
        <h1>
            隐私策略
        </h1>
    </div>
</header>
<div class="wraper">
    <ul class="h-info-box e-info-box">
        <li>
            <a href="javascript:void(0)">
                <span>联系电话：</span>
                <div>
                    <select name="" class='choice'>
                        <option value="1">公开</option>
                        <option value="2">不公开</option>
                    </select>
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <span>邮箱：</span>
                <div>
                    <select name="" class='choice'>
                        <option value="1">公开</option>
                        <option value="2">不公开</option>
                    </select>
                </div>
            </a>
        </li>
        <li class="nobottom">
            <a href="javascript:void(0)">
                <span>我的资料：</span>
                <div>
                    <select name="" class='choice'>
                        <option value="1">公开</option>
                        <option value="2">不公开</option>
                    </select>
                </div>
            </a>
        </li>
    </ul>
    <p class="inner f-color-gray">资料包括行业、擅长业务、标签、工作经历、教育经历等</p>
    <a href="#this" class="nextstep">保存</a>
</div>
<!-- <div class='reg-shadow' style="display: none;"></div>
<div class="checked-sex shadow-info" style="display: none;">
    <div class="h-checked-sex">
        <a id="cancel" href="javascript:void(0);">取消</a>
        <a id="submit" href="javascript:void(0);">完成</a>
    </div>
    <span class="f-color-gray">关注我的</span>
    <span>所有人</span>
    <span class="f-color-gray">我关注的</span>
</div> -->
<?php $this->start('script') ?>
<script src="/mobile/js/jquery-1.9.1.js" type="text/javascript" charset="utf-8"></script>
<script src="/mobile/js/mobiscroll.2.13.2.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="/mobile/css/mobiscroll.css"/>

<script>
    $('.choice').mobiscroll().select({
        theme: 'mobiscroll',
        display: 'bottom',
        headerText: function (valueText) { return "是否公开"; },
        rows:2
        
       
    });
</script>
<?php $this->end('script');