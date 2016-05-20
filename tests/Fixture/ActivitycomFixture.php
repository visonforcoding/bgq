<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActivitycomFixture
 *
 */
class ActivitycomFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'activitycom';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '活动评论表', 'autoIncrement' => true, 'precision' => null],
        'pid' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '父id', 'precision' => null, 'autoIncrement' => null],
        'activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '活动id', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '用户id', 'precision' => null, 'autoIncrement' => null],
        'body' => ['type' => 'string', 'length' => 500, 'null' => false, 'default' => null, 'comment' => '评论内容', 'precision' => null, 'fixed' => null],
        'praise_nums' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '点赞数', 'precision' => null, 'autoIncrement' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '评论时间', 'precision' => null],
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
            'pid' => 1,
            'activity_id' => 1,
            'user_id' => 1,
            'body' => 'Lorem ipsum dolor sit amet',
            'praise_nums' => 1,
            'create_time' => '2016-05-11 14:45:02'
        ],
    ];
}
