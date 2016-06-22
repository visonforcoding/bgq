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
        <div class="a-form-box">
            <ul>
                <li>
                    <i>描述</i>
                    <textarea name="description"></textarea>
                </li>
            </ul>
        </div>
    </form>
    <a href="javascript:void(0);" class='nextstep' id="submit" style="margin-bottom:1.7rem;">提交</a>
</div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script src="/mobile/js/activity_recommend.js"></script>
<script>
</script>
<?php
$this->end('script');
