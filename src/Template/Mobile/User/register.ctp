<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="user form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('phone');
            echo $this->Form->input('pwd');
            echo $this->Form->input('truename');
            echo $this->Form->input('level');
            echo $this->Form->input('idcard');
            echo $this->Form->input('company');
            echo $this->Form->input('position');
            echo $this->Form->input('email');
            echo $this->Form->input('gender');
            echo $this->Form->input('industry_id');
            echo $this->Form->input('goodat');
            echo $this->Form->input('city_id');
            echo $this->Form->input('card_path');
            echo $this->Form->input('ymjy');
            echo $this->Form->input('ywnl');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
