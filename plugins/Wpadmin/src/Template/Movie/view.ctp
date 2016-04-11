<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Movie'), ['action' => 'edit', $movie->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Movie'), ['action' => 'delete', $movie->id], ['confirm' => __('Are you sure you want to delete # {0}?', $movie->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Movie'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Movie'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="movie view large-9 medium-8 columns content">
    <h3><?= h($movie->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Pic') ?></th>
            <td><?= h($movie->pic) ?></td>
        </tr>
        <tr>
            <th><?= __('Movie') ?></th>
            <td><?= h($movie->movie) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($movie->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($movie->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Hits') ?></th>
            <td><?= $this->Number->format($movie->hits) ?></td>
        </tr>
        <tr>
            <th><?= __('Ctime') ?></th>
            <td><?= h($movie->ctime) ?></td>
        </tr>
        <tr>
            <th><?= __('Utime') ?></th>
            <td><?= h($movie->utime) ?></td>
        </tr>
    </table>
</div>
