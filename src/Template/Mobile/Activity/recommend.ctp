<div class="wraper">
    <div class="h20"></div>
    <h1 class='choose-org-type innerwaper a-choose'>推荐类型</h1>
    <div class="items">
        <div class="orgmark">
            <a box_id="#guest" class="agency-item" id="agency_item_1" type="1">嘉宾推荐</a><a box_id="#place" class="agency-item" id="agency_item_2" type="2">场地赞助</a><a box_id="#cash" class="agency-item" id="agency_item_3" type="3">现金赞助</a><a box_id="#goods" class="agency-item" id="agency_item_4" type="4">物品赞助</a><a box_id="#others" class="agency-item" id="agency_item_5" type="5">其它</a>
        </div>
    </div>
    <div class="h20"></div>
    <form method="post" action="">
        <input type="text" name="type" hidden value="" />
        <input type="text" name="activity_id" hidden value="<?= $activity_id ?>" />
        <div class="a-form-box">
            <ul>
                <li>
                    <i>描述</i>
                    <textarea name="description"></textarea>
                </li>
            </ul>
        </div>
    </form>
    <a href="javascript:void(0);" class='nextstep' id="submit">提交</a>
    <div class="line">
        <span class="mistips">我们会在三个工作日内处理您的申请</span>
    </div>
    <p class='inner areap' >如果您有媒体或者赞助资源需要可以直接联系我们的小秘书
电话：13806868688&nbsp;&nbsp;邮箱：xms@chinamatop.com
</p>
    <div class='reg-shadow' hidden></div>
    <div class="totips" style="display:none;">
        <h3>非常感谢你的推荐或赞助</h3>
        <span></span>
        <a href="/activity/details/<?= $activity_id ?>" class="nextstep" id="comfirm">确认</a>
<!--        <span class='closed' id='closed'>
            &times;
        </span>-->
    </div>
</div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script src="/mobile/js/activity_recommend.js"></script>
<script>
</script>
<?php
$this->end('script');
