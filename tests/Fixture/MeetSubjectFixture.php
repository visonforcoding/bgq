<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MeetSubjectFixture
 *
 */
class MeetSubjectFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'meet_subject';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '专家id', 'precision' => null, 'autoIncrement' => null],
        'title' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => '', 'comment' => '标题', 'precision' => null, 'fixed' => null],
        'summary' => ['type' => 'string', 'length' => 550, 'null' => false, 'default' => '', 'comment' => '简介', 'precision' => null, 'fixed' => null],
        'type' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '类型', 'precision' => null, 'autoIncrement' => null],
        'invite_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '约见时间', 'precision' => null],
        'price' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '价格'],
        'address' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '地址', 'precision' => null, 'fixed' => null],
        'last_time' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '持续时间', 'precision' => null, 'autoIncrement' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
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
            'title' => 'Lorem ipsum dolor sit amet',
            'summary' => 'Lorem ipsum dolor sit amet',
            'type' => 1,
            'invite_time' => '2016-05-16 14:08:03',
            'price' => 1.5,
            'address' => 'Lorem ipsum dolor sit amet',
            'last_time' => 1,
            'create_time' => '2016-05-16 14:08:03',
            'update_time' => '2016-05-16 14:08:03'
        ],
    ];
}
