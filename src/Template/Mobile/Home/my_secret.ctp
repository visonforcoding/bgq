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
                    <span class="choice">所有人</span>
                </div>
            </a>
        </li>
        <li>
            <a href="javascript:void(0)">
                <span>邮箱：</span>
                <div>
                    <span class="choice">所有人</span>
                </div>
            </a>
        </li>
        <li class="nobottom">
            <a href="javascript:void(0)">
                <span>我的资料：</span>
                <div>
                    <span class="choice">所有人</span>
                </div>
            </a>
        </li>
    </ul>
    <p class="inner f-color-gray">资料包括行业、擅长业务、标签、工作经历、教育经历等</p>
    <a href="#this" class="nextstep">保存</a>
</div>
<div class='reg-shadow' style="display: none;"></div>
<div class="checked-sex shadow-info" style="display: none;">
    <div class="h-checked-sex">
        <a id="cancel" href="javascript:void(0);">取消</a>
        <a id="submit" href="javascript:void(0);">完成</a>
    </div>
    <span class="f-color-gray">关注我的</span>
    <span>所有人</span>
    <span class="f-color-gray">我关注的</span>
</div>
<?php $this->start('script') ?>
<script src="/mobile/js/loopScroll.js"></script>
<script>
    $('.choice').on('click',function(){
        $('.reg-shadow,.shadow-info').show();
    });
</script>
<?php $this->end('script');