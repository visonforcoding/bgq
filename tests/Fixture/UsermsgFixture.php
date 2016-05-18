<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsermsgFixture
 *
 */
class UsermsgFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'usermsg';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '用户', 'precision' => null, 'autoIncrement' => null],
        'type' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '类型', 'precision' => null, 'autoIncrement' => null],
        'table_id' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '记录id', 'precision' => null, 'autoIncrement' => null],
        'title' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => null, 'comment' => '标题', 'precision' => null, 'fixed' => null],
        'msg' => ['type' => 'string', 'length' => 550, 'null' => false, 'default' => null, 'comment' => '内容', 'precision' => null, 'fixed' => null],
        'url' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '跳转链接', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '0未读1已读', 'precision' => null, 'autoIncrement' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
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
            'type' => 1,
            'table_id' => 1,
            'title' => 'Lorem ipsum dolor sit amet',
            'msg' => 'Lorem ipsum dolor sit amet',
            'url' => 'Lorem ipsum dolor sit amet',
            'status' => 1,
            'create_time' => '2016-05-17 15:54:23',
            'update_time' => '2016-05-17 15:54:23'
        ],
    ];
}
