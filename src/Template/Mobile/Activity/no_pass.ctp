<div class="wraper">
    <div class="review-containner">
        <div class='aligncenter'>
            <h3 class="color-items iconfont">&#xe67a;</h3>
            <p class="tip color-items">很遗憾，你提交的审核未通过</p>
        </div>
        <div class='activity_nopassed-box inner'>
            <div class='active-des-pass flex box_start'><span class="bold">活动名称：</span><div class="right-info"><?= $apply->activity->title ?></div></div>
            <div class="active-des-pass flex box_start"><span class="bold">未通过原因：</span><div class='color-items right-info'><?= $apply->reason ?></div></div>
            <div class="activity-nopass-img">
                <img src="/mobile/images/activity_nopass.png" />
            </div>
        </div>
    </div>
</div>
<div class="f-bottom-call">如有疑问，请联系小秘书：<a href="#this">＋86 18576694176<i class='iconfont'>&#xe657;</i></a></div>
