<?php $this->start('header') ?>
<?= $this->element('header', ['pageHeaderLinkLabel' => '注册', 'pageHeaderLink' => '/mobile/user/register']); ?>
<?php $this->end('header') ?>
<div class="ui-form ui-border-t">
    <form action="#">
        <div class="ui-form-item ui-form-item-l ui-border-b">
            <label class="ui-border-r">
                手机号
            </label>
            <input type="text" placeholder="请输入手机号码">
            <a href="#" class="ui-icon-close">
            </a>
        </div>
        <div class="ui-form-item ui-form-item-r ui-border-b">
            <input type="text" placeholder="请输入验证码">
            <button type="button" class="ui-border-l">
                获取验证码
            </button>
        </div>
    </form>
        <div class="ui-btn-wrap ">
            <button class="ui-btn-lg ui-btn-primary">
                确定
            </button>
        </div>
</div>