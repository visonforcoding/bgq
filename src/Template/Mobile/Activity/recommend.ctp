<header>
    <div class='inner'>
        <a href='#this' class='toback' id="toback"></a>
        <h1><?= $pagetitle; ?></h1>

    </div>
</header>

<div class="wraper">
    <div class="h20"></div>
    <h1 class='choose-org-type innerwaper a-choose'>推荐类型</h1>
    <div class="items">

        <div class="orgmark">
            <a href="#guest" class="agency-item" id="agency_item_1" type="1">嘉宾推荐</a><a href="#place" class="agency-item" id="agency_item_2" type="2">场地赞助</a><a href="#cash" class="agency-item" id="agency_item_3" type="3">现金赞助</a><a href="#goods" class="agency-item" id="agency_item_4" type="4">物品赞助</a><a href="#others" class="agency-item" id="agency_item_5" type="5">其它</a>
        </div>
    </div>
    <div class="h20"></div>
    <form method="post" action="">
        <input type="text" name="type" hidden value="" />
        <div class="a-form-box" id="guest">
            <ul>
                <li>
                    <span>姓名</span>
                    <input type="text" name="name"/>
                </li>
                <li>
                    <span>公司/机构</span>
                    <input type="text" name="company"/>
                </li>
                <li>
                    <span>部门</span>
                    <input type="text" name="department" />
                </li>
                <li>
                    <span>职务</span>
                    <input type="text" name="position" />
                </li>
                <li>
                    <i>经验简介</i>
                    <textarea name="description"></textarea>
                </li>
            </ul>
        </div>
        <div class="a-form-box" id="place">
            <ul>
                <li>
                    <span>地址</span>
                    <input type="text" name="address" />
                </li>
                <li>
                    <span>容纳人数</span>
                    <input type="number" name="people" />
                </li>

                <li>
                    <i>其它说明</i>
                    <textarea name="description"></textarea>
                </li>
            </ul>
        </div>
        <div class="a-form-box" id="goods">
            <ul>
                <li>
                    <i>要求描述</i>
                    <textarea name="description"></textarea>
                </li>
            </ul>
        </div>
        <div class="a-form-box" id="cash">
            <ul>
                <li>
                    <i>要求描述</i>
                    <textarea name="description"></textarea>
                </li>
            </ul>
        </div>
        <div class="a-form-box" id="others">
            <ul>
                <li>
                    <i>要求描述</i>
                    <textarea name="description"></textarea>
                </li>
            </ul>
        </div>
    </form>
    <a href="#this" class='nextstep' id="submit" style="margin-bottom:1.7rem;">提交</a>
</div>
<?= $this->element('footer'); ?>
<?php $this->start('script'); ?>
<script src="/mobile/js/activity_recommend.js"></script>
<script>
    $('.a-form-box').hide();
</script>
<?php
$this->end('script');
