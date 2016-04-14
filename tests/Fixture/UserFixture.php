<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserFixture
 *
 */
class UserFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'user';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '用户表', 'autoIncrement' => true, 'precision' => null],
        'phone' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'comment' => '手机号', 'precision' => null, 'fixed' => null],
        'pwd' => ['type' => 'string', 'length' => 120, 'null' => false, 'default' => null, 'comment' => '密码', 'precision' => null, 'fixed' => null],
        'truename' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => null, 'comment' => '姓名', 'precision' => null, 'fixed' => null],
        'level' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => '1', 'comment' => '等级,1:普通2:专家', 'precision' => null, 'fixed' => null],
        'idcard' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => '', 'comment' => '身份证', 'precision' => null, 'fixed' => null],
        'company' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '公司', 'precision' => null, 'fixed' => null],
        'position' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '职位', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '邮箱', 'precision' => null, 'fixed' => null],
        'gender' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '1,男，2女', 'precision' => null, 'autoIncrement' => null],
        'industry_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '行业', 'precision' => null, 'autoIncrement' => null],
        'goodat' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '擅长业务', 'precision' => null, 'fixed' => null],
        'city_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '常驻城市', 'precision' => null, 'autoIncrement' => null],
        'card_path' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => '', 'comment' => '名片路径', 'precision' => null, 'fixed' => null],
        'avatar' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => '', 'comment' => '头像', 'precision' => null, 'fixed' => null],
        'ymjy' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => '', 'comment' => '项目经验', 'precision' => null, 'fixed' => null],
        'ywnl' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => '', 'comment' => '业务能力', 'precision' => null, 'fixed' => null],
        'reason' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => '', 'comment' => '审核意见', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '审核状态：1.正常2.认证不同通过3.黑名单', 'precision' => null, 'autoIncrement' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '创建时间', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '修改时间', 'precision' => null],
        '_indexes' => [
            'phone' => ['type' => 'index', 'columns' => ['phone'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'phone' => 'Lorem ipsum dolor ',
            'pwd' => 'Lorem ipsum dolor sit amet',
            'truename' => 'Lorem ipsum dolor ',
            'level' => 'Lorem ipsum dolor ',
            'idcard' => 'Lorem ipsum dolor ',
            'company' => 'Lorem ipsum dolor sit amet',
            'position' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'gender' => 1,
            'industry_id' => 1,
            'goodat' => 'Lorem ipsum dolor sit amet',
            'city_id' => 1,
            'card_path' => 'Lorem ipsum dolor sit amet',
            'avatar' => 'Lorem ipsum dolor sit amet',
            'ymjy' => 'Lorem ipsum dolor sit amet',
            'ywnl' => 'Lorem ipsum dolor sit amet',
            'reason' => 'Lorem ipsum dolor sit amet',
            'status' => 1,
            'create_time' => '2016-04-14 16:30:37',
            'update_time' => '2016-04-14 16:30:37'
        ],
    ];
}
