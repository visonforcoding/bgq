
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">

    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Need'), ['action' => 'edit', $need->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Need'), ['action' => 'delete', $need->id], ['confirm' => __('Are you sure you want to delete # {0}?', $need->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Need'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Need'), ['action' => 'add']) ?> </li>
    </ul>
</nav> -->
<div class="need view large-9 medium-8 columns content">
    <h3>消息id：<?= h($need->id) ?></h3>
    <table class="vertical-table" width="100%" border="1" cellspacing="0">
        <tr>
            <th><?= __('用户') ?></th>
            <td style="text-align:center"><?= $need->user->truename ?></td>
        </tr>
        <tr>
            <th><?= __('消息') ?></th>
            <td style="text-align:left"><?= h($need->msg) ?></td>
        </tr>
        <tr>
            <th><?= __('创建时间') ?></th>
            <td style="text-align:center"><?= date('Y-m-d H:i:s',strtotime($need->create_time)) ?></td>
        </tr>
        <tr>
            <th><?= __('更新时间') ?></th>
            <td style="text-align:center"><?= date('Y-m-d H:i:s',strtotime($need->update_time)) ?></td>
        </tr>
    </table>
</div>
