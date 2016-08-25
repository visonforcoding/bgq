<head>
    <link rel="stylesheet" type="text/css" href="/wpadmin/lib/zui/css/zui.min.css"/>
</head>
<body>
    <div class="user view large-9 medium-8 columns content">
        <table class="vertical-table table table-hover table-bordered">
            <tbody>
                <tr>
                    <th><?= __('手机号') ?></th>
                    <td><?= h($user->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('姓名') ?></th>
                    <td><?= h($user->truename) ?></td>
                </tr>
                <tr>
                    <th><?= __('等级') ?></th>
                    <td><?= h($user->level) ?></td>
                </tr>
                <tr>
                    <th><?= __('身份证') ?></th>
                    <td><?= h($user->idcard) ?></td>
                </tr>
                <tr>
                    <th><?= __('公司') ?></th>
                    <td><?= h($user->company) ?></td>
                </tr>
                <tr>
                    <th><?= __('职位') ?></th>
                    <td><?= h($user->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('邮箱') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('行业标签') ?></th>
                    <td><?= $user->has('industry') ? $this->Html->link($user->industry->name, ['controller' => 'Industry', 'action' => 'view', $user->industry->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('擅长业务') ?></th>
                    <td><?= h($user->goodat) ?></td>
                </tr>
                <tr>
                    <th><?= __('城市') ?></th>
                    <td><?= h($user->city) ?></td>
                </tr>
                <tr>
                    <th><?= __('名片') ?></th>
                    <td><img style="width:200px;height:100px;" src="<?= $user->card_path ?>"/></td>
                </tr>
                <tr>
                    <th><?= __('头像') ?></th>
                    <td><img src="<?= $user->avatar ?>"/></td>
                </tr>
                <tr>
                    <th><?= __('项目经验') ?></th>
                    <td><?= h($user->ymjy) ?></td>
                </tr>
                <tr>
                    <th><?= __('业务能力') ?></th>
                    <td><?= h($user->ywnl) ?></td>
                </tr>
                <tr>
                    <th><?= __('性别') ?></th>
                    <td><?= $user->gender ?></td>
                </tr>
                <tr>
                    <th><?= __('会员认证状态') ?></th>
                    <td><?= $user->savant_status ?></td>
                </tr>
                <tr>
                    <th><?= __('加入时间') ?></th>
                    <td><?= h($user->create_time) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
