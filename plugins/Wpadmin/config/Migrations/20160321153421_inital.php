<?php
use Migrations\AbstractMigration;

class Inital extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('cwp_admin');
        $table
            ->addColumn('username', 'string', [
                'comment' => '用户名',
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'comment' => '密码',
                'default' => null,
                'limit' => 150,
                'null' => false,
            ])
            ->addColumn('enabled', 'boolean', [
                'comment' => '1启用0禁用',
                'default' => 1,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('ctime', 'datetime', [
                'comment' => '创建时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('utime', 'datetime', [
                'comment' => '修改时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('login_time', 'datetime', [
                'comment' => '登录时间',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('login_ip', 'string', [
                'comment' => '登录ip',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addIndex(
                [
                    'username',
                ],
                ['unique' => true]
            )
            ->create();

        $table = $this->table('cwp_group_menu');
        $table
            ->addColumn('group_id', 'integer', [
                'comment' => '群组',
                'default' => 0,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('menu_id', 'integer', [
                'comment' => '权限',
                'default' => 0,
                'limit' => 11,
                'null' => false,
            ])
            ->addIndex(
                [
                    'group_id',
                    'menu_id',
                ],
                ['unique' => true]
            )
            ->create();

        $table = $this->table('cwp_group');
        $table
            ->addColumn('name', 'string', [
                'comment' => '群组名称',
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('remark', 'string', [
                'comment' => '备注',
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('ctime', 'datetime', [
                'comment' => '创建时间',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('utime', 'datetime', [
                'comment' => '修改时间',
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'name',
                ],
                ['unique' => true]
            )
            ->create();

        $table = $this->table('cwp_menu');
        $table
            ->addColumn('name', 'string', [
                'comment' => '节点名称',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('node', 'string', [
                'comment' => '路径',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('pid', 'integer', [
                'comment' => '父ID',
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('class', 'string', [
                'comment' => '样式',
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('rank', 'integer', [
                'comment' => '排序',
                'default' => null,
                'limit' => 6,
                'null' => true,
            ])
            ->addColumn('is_menu', 'boolean', [
                'comment' => '是否在菜单显示',
                'default' => 0,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('status', 'boolean', [
                'comment' => '状态',
                'default' => 1,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('remark', 'string', [
                'comment' => '备注',
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->create();

       

    }

    public function down()
    {
        $this->dropTable('cwp_admin');
        $this->dropTable('cwp_group_menu');
        $this->dropTable('cwp_group');
        $this->dropTable('cwp_menu');
    }
}
