<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Admin'), ['action' => 'edit', $admin->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Admin'), ['action' => 'delete', $admin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $admin->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Admin'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Admin'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Job'), ['controller' => 'Job', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Job'), ['controller' => 'Job', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List News'), ['controller' => 'News', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New News'), ['controller' => 'News', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Withdraw'), ['controller' => 'Withdraw', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Withdraw'), ['controller' => 'Withdraw', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Group'), ['controller' => 'Group', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Group'), ['controller' => 'Group', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Menu'), ['controller' => 'Menu', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menu', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="admin view large-9 medium-8 columns content">
    <h3><?= h($admin->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($admin->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Avatar') ?></th>
            <td><?= h($admin->avatar) ?></td>
        </tr>
        <tr>
            <th><?= __('Truename') ?></th>
            <td><?= h($admin->truename) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($admin->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= h($admin->phone) ?></td>
        </tr>
        <tr>
            <th><?= __('Login Ip') ?></th>
            <td><?= h($admin->login_ip) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($admin->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Ctime') ?></th>
            <td><?= h($admin->ctime) ?></td>
        </tr>
        <tr>
            <th><?= __('Utime') ?></th>
            <td><?= h($admin->utime) ?></td>
        </tr>
        <tr>
            <th><?= __('Login Time') ?></th>
            <td><?= h($admin->login_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Enabled') ?></th>
            <td><?= $admin->enabled ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Activity') ?></h4>
        <?php if (!empty($admin->activity)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Admin Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Publisher') ?></th>
                <th><?= __('Company') ?></th>
                <th><?= __('Org') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Activity Time') ?></th>
                <th><?= __('Time') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('Must Check') ?></th>
                <th><?= __('Scale') ?></th>
                <th><?= __('Read Nums') ?></th>
                <th><?= __('Praise Nums') ?></th>
                <th><?= __('Comment Nums') ?></th>
                <th><?= __('Cover') ?></th>
                <th><?= __('Body') ?></th>
                <th><?= __('Contact') ?></th>
                <th><?= __('Summary') ?></th>
                <th><?= __('Create Time') ?></th>
                <th><?= __('Update Time') ?></th>
                <th><?= __('Apply Nums') ?></th>
                <th><?= __('Apply Fee') ?></th>
                <th><?= __('Is Crowdfunding') ?></th>
                <th><?= __('Is Check') ?></th>
                <th><?= __('Is Top') ?></th>
                <th><?= __('From User') ?></th>
                <th><?= __('Guest') ?></th>
                <th><?= __('Reason') ?></th>
                <th><?= __('Region Id') ?></th>
                <th><?= __('Qrcode') ?></th>
                <th><?= __('Thumb') ?></th>
                <th><?= __('Series Id') ?></th>
                <th><?= __('Apply Start Time') ?></th>
                <th><?= __('Apply End Time') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Is Del') ?></th>
                <th><?= __('Is Show Apply') ?></th>
                <th><?= __('Is Invoice') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($admin->activity as $activity): ?>
            <tr>
                <td><?= h($activity->id) ?></td>
                <td><?= h($activity->admin_id) ?></td>
                <td><?= h($activity->user_id) ?></td>
                <td><?= h($activity->publisher) ?></td>
                <td><?= h($activity->company) ?></td>
                <td><?= h($activity->org) ?></td>
                <td><?= h($activity->title) ?></td>
                <td><?= h($activity->activity_time) ?></td>
                <td><?= h($activity->time) ?></td>
                <td><?= h($activity->address) ?></td>
                <td><?= h($activity->must_check) ?></td>
                <td><?= h($activity->scale) ?></td>
                <td><?= h($activity->read_nums) ?></td>
                <td><?= h($activity->praise_nums) ?></td>
                <td><?= h($activity->comment_nums) ?></td>
                <td><?= h($activity->cover) ?></td>
                <td><?= h($activity->body) ?></td>
                <td><?= h($activity->contact) ?></td>
                <td><?= h($activity->summary) ?></td>
                <td><?= h($activity->create_time) ?></td>
                <td><?= h($activity->update_time) ?></td>
                <td><?= h($activity->apply_nums) ?></td>
                <td><?= h($activity->apply_fee) ?></td>
                <td><?= h($activity->is_crowdfunding) ?></td>
                <td><?= h($activity->is_check) ?></td>
                <td><?= h($activity->is_top) ?></td>
                <td><?= h($activity->from_user) ?></td>
                <td><?= h($activity->guest) ?></td>
                <td><?= h($activity->reason) ?></td>
                <td><?= h($activity->region_id) ?></td>
                <td><?= h($activity->qrcode) ?></td>
                <td><?= h($activity->thumb) ?></td>
                <td><?= h($activity->series_id) ?></td>
                <td><?= h($activity->apply_start_time) ?></td>
                <td><?= h($activity->apply_end_time) ?></td>
                <td><?= h($activity->status) ?></td>
                <td><?= h($activity->is_del) ?></td>
                <td><?= h($activity->is_show_apply) ?></td>
                <td><?= h($activity->is_invoice) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Activity', 'action' => 'view', $activity->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Activity', 'action' => 'edit', $activity->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Activity', 'action' => 'delete', $activity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activity->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Job') ?></h4>
        <?php if (!empty($admin->job)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Company') ?></th>
                <th><?= __('Admin Id') ?></th>
                <th><?= __('Contact') ?></th>
                <th><?= __('Earnings') ?></th>
                <th><?= __('Position') ?></th>
                <th><?= __('Salary') ?></th>
                <th><?= __('Address') ?></th>
                <th><?= __('Summary') ?></th>
                <th><?= __('Is Finish') ?></th>
                <th><?= __('Remark') ?></th>
                <th><?= __('Create Time') ?></th>
                <th><?= __('Update Time') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($admin->job as $job): ?>
            <tr>
                <td><?= h($job->id) ?></td>
                <td><?= h($job->company) ?></td>
                <td><?= h($job->admin_id) ?></td>
                <td><?= h($job->contact) ?></td>
                <td><?= h($job->earnings) ?></td>
                <td><?= h($job->position) ?></td>
                <td><?= h($job->salary) ?></td>
                <td><?= h($job->address) ?></td>
                <td><?= h($job->summary) ?></td>
                <td><?= h($job->is_finish) ?></td>
                <td><?= h($job->remark) ?></td>
                <td><?= h($job->create_time) ?></td>
                <td><?= h($job->update_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Job', 'action' => 'view', $job->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Job', 'action' => 'edit', $job->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Job', 'action' => 'delete', $job->id], ['confirm' => __('Are you sure you want to delete # {0}?', $job->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related News') ?></h4>
        <?php if (!empty($admin->news)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Admin Id') ?></th>
                <th><?= __('Admin Name') ?></th>
                <th><?= __('Title') ?></th>
                <th><?= __('Read Nums') ?></th>
                <th><?= __('Praise Nums') ?></th>
                <th><?= __('Comment Nums') ?></th>
                <th><?= __('Cover') ?></th>
                <th><?= __('Body') ?></th>
                <th><?= __('Is Media') ?></th>
                <th><?= __('Media Pos') ?></th>
                <th><?= __('Video') ?></th>
                <th><?= __('Video Cover') ?></th>
                <th><?= __('Mp3') ?></th>
                <th><?= __('Mp3 Title') ?></th>
                <th><?= __('Summary') ?></th>
                <th><?= __('Create Time') ?></th>
                <th><?= __('Update Time') ?></th>
                <th><?= __('Publish Time') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Source') ?></th>
                <th><?= __('Keywords') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Thumb') ?></th>
                <th><?= __('Is Delete') ?></th>
                <th><?= __('Is Top') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($admin->news as $news): ?>
            <tr>
                <td><?= h($news->id) ?></td>
                <td><?= h($news->admin_id) ?></td>
                <td><?= h($news->admin_name) ?></td>
                <td><?= h($news->title) ?></td>
                <td><?= h($news->read_nums) ?></td>
                <td><?= h($news->praise_nums) ?></td>
                <td><?= h($news->comment_nums) ?></td>
                <td><?= h($news->cover) ?></td>
                <td><?= h($news->body) ?></td>
                <td><?= h($news->is_media) ?></td>
                <td><?= h($news->media_pos) ?></td>
                <td><?= h($news->video) ?></td>
                <td><?= h($news->video_cover) ?></td>
                <td><?= h($news->mp3) ?></td>
                <td><?= h($news->mp3_title) ?></td>
                <td><?= h($news->summary) ?></td>
                <td><?= h($news->create_time) ?></td>
                <td><?= h($news->update_time) ?></td>
                <td><?= h($news->publish_time) ?></td>
                <td><?= h($news->user_id) ?></td>
                <td><?= h($news->source) ?></td>
                <td><?= h($news->keywords) ?></td>
                <td><?= h($news->status) ?></td>
                <td><?= h($news->thumb) ?></td>
                <td><?= h($news->is_delete) ?></td>
                <td><?= h($news->is_top) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'News', 'action' => 'view', $news->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'News', 'action' => 'edit', $news->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'News', 'action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User') ?></h4>
        <?php if (!empty($admin->user)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Phone') ?></th>
                <th><?= __('Pwd') ?></th>
                <th><?= __('User Token') ?></th>
                <th><?= __('Union Id') ?></th>
                <th><?= __('Wx Openid') ?></th>
                <th><?= __('App Wx Openid') ?></th>
                <th><?= __('Truename') ?></th>
                <th><?= __('Level') ?></th>
                <th><?= __('Grade') ?></th>
                <th><?= __('Idcard') ?></th>
                <th><?= __('Company') ?></th>
                <th><?= __('Position') ?></th>
                <th><?= __('Email') ?></th>
                <th><?= __('Gender') ?></th>
                <th><?= __('Agency Id') ?></th>
                <th><?= __('Ext Industry') ?></th>
                <th><?= __('Goodat') ?></th>
                <th><?= __('City') ?></th>
                <th><?= __('Card Path') ?></th>
                <th><?= __('Avatar') ?></th>
                <th><?= __('Money') ?></th>
                <th><?= __('Meet Nums') ?></th>
                <th><?= __('Fans') ?></th>
                <th><?= __('Ymjy') ?></th>
                <th><?= __('Ywnl') ?></th>
                <th><?= __('Gsyw') ?></th>
                <th><?= __('Reason') ?></th>
                <th><?= __('Grbq') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Admin Id') ?></th>
                <th><?= __('Savant Status') ?></th>
                <th><?= __('Enabled') ?></th>
                <th><?= __('Is Del') ?></th>
                <th><?= __('Is Top') ?></th>
                <th><?= __('Is Judge') ?></th>
                <th><?= __('Device') ?></th>
                <th><?= __('Create Time') ?></th>
                <th><?= __('Update Time') ?></th>
                <th><?= __('Subject Update Time') ?></th>
                <th><?= __('Savant Read Nums') ?></th>
                <th><?= __('Homepage Read Nums') ?></th>
                <th><?= __('Guid') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($admin->user as $user): ?>
            <tr>
                <td><?= h($user->id) ?></td>
                <td><?= h($user->phone) ?></td>
                <td><?= h($user->pwd) ?></td>
                <td><?= h($user->user_token) ?></td>
                <td><?= h($user->union_id) ?></td>
                <td><?= h($user->wx_openid) ?></td>
                <td><?= h($user->app_wx_openid) ?></td>
                <td><?= h($user->truename) ?></td>
                <td><?= h($user->level) ?></td>
                <td><?= h($user->grade) ?></td>
                <td><?= h($user->idcard) ?></td>
                <td><?= h($user->company) ?></td>
                <td><?= h($user->position) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->gender) ?></td>
                <td><?= h($user->agency_id) ?></td>
                <td><?= h($user->ext_industry) ?></td>
                <td><?= h($user->goodat) ?></td>
                <td><?= h($user->city) ?></td>
                <td><?= h($user->card_path) ?></td>
                <td><?= h($user->avatar) ?></td>
                <td><?= h($user->money) ?></td>
                <td><?= h($user->meet_nums) ?></td>
                <td><?= h($user->fans) ?></td>
                <td><?= h($user->ymjy) ?></td>
                <td><?= h($user->ywnl) ?></td>
                <td><?= h($user->gsyw) ?></td>
                <td><?= h($user->reason) ?></td>
                <td><?= h($user->grbq) ?></td>
                <td><?= h($user->status) ?></td>
                <td><?= h($user->admin_id) ?></td>
                <td><?= h($user->savant_status) ?></td>
                <td><?= h($user->enabled) ?></td>
                <td><?= h($user->is_del) ?></td>
                <td><?= h($user->is_top) ?></td>
                <td><?= h($user->is_judge) ?></td>
                <td><?= h($user->device) ?></td>
                <td><?= h($user->create_time) ?></td>
                <td><?= h($user->update_time) ?></td>
                <td><?= h($user->subject_update_time) ?></td>
                <td><?= h($user->savant_read_nums) ?></td>
                <td><?= h($user->homepage_read_nums) ?></td>
                <td><?= h($user->guid) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'User', 'action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'User', 'action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'User', 'action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Withdraw') ?></h4>
        <?php if (!empty($admin->withdraw)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Admin Id') ?></th>
                <th><?= __('Amount') ?></th>
                <th><?= __('Cardno') ?></th>
                <th><?= __('Bank') ?></th>
                <th><?= __('Truename') ?></th>
                <th><?= __('Fee') ?></th>
                <th><?= __('Remark') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Create Time') ?></th>
                <th><?= __('Update Time') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($admin->withdraw as $withdraw): ?>
            <tr>
                <td><?= h($withdraw->id) ?></td>
                <td><?= h($withdraw->user_id) ?></td>
                <td><?= h($withdraw->admin_id) ?></td>
                <td><?= h($withdraw->amount) ?></td>
                <td><?= h($withdraw->cardno) ?></td>
                <td><?= h($withdraw->bank) ?></td>
                <td><?= h($withdraw->truename) ?></td>
                <td><?= h($withdraw->fee) ?></td>
                <td><?= h($withdraw->remark) ?></td>
                <td><?= h($withdraw->status) ?></td>
                <td><?= h($withdraw->create_time) ?></td>
                <td><?= h($withdraw->update_time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Withdraw', 'action' => 'view', $withdraw->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Withdraw', 'action' => 'edit', $withdraw->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Withdraw', 'action' => 'delete', $withdraw->id], ['confirm' => __('Are you sure you want to delete # {0}?', $withdraw->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Group') ?></h4>
        <?php if (!empty($admin->group)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Remark') ?></th>
                <th><?= __('Ctime') ?></th>
                <th><?= __('Utime') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($admin->group as $group): ?>
            <tr>
                <td><?= h($group->id) ?></td>
                <td><?= h($group->name) ?></td>
                <td><?= h($group->remark) ?></td>
                <td><?= h($group->ctime) ?></td>
                <td><?= h($group->utime) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Group', 'action' => 'view', $group->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Group', 'action' => 'edit', $group->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Group', 'action' => 'delete', $group->id], ['confirm' => __('Are you sure you want to delete # {0}?', $group->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Menu') ?></h4>
        <?php if (!empty($admin->menu)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Node') ?></th>
                <th><?= __('Pid') ?></th>
                <th><?= __('Class') ?></th>
                <th><?= __('Rank') ?></th>
                <th><?= __('Is Menu') ?></th>
                <th><?= __('Status') ?></th>
                <th><?= __('Remark') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($admin->menu as $menu): ?>
            <tr>
                <td><?= h($menu->id) ?></td>
                <td><?= h($menu->name) ?></td>
                <td><?= h($menu->node) ?></td>
                <td><?= h($menu->pid) ?></td>
                <td><?= h($menu->class) ?></td>
                <td><?= h($menu->rank) ?></td>
                <td><?= h($menu->is_menu) ?></td>
                <td><?= h($menu->status) ?></td>
                <td><?= h($menu->remark) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Menu', 'action' => 'view', $menu->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Menu', 'action' => 'edit', $menu->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Menu', 'action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
