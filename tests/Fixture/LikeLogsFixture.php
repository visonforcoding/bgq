<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LikeLogsFixture
 *
 */
class LikeLogsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '点赞日志表', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '用户id', 'precision' => null, 'autoIncrement' => null],
        'relate_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '关联id（活动id或资讯id）', 'precision' => null, 'autoIncrement' => null],
        'msg' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '日志内容', 'precision' => null, 'fixed' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '记录时间', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '更新时间', 'precision' => null],
        'type' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '类型值：0：活动；1：资讯', 'precision' => null, 'autoIncrement' => null],
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
            'user_id' => 1,
            'relate_id' => 1,
            'msg' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-05-20 11:33:41',
            'update_time' => '2016-05-20 11:33:41',
            'type' => 1
        ],
    ];
}
