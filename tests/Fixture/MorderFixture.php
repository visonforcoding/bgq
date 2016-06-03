<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MorderFixture
 *
 */
class MorderFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'morder';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'type' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '订单类型', 'precision' => null, 'autoIncrement' => null],
        'relate_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '关联id', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '用户id(买家id)', 'precision' => null, 'autoIncrement' => null],
        'seller_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '卖家id', 'precision' => null, 'autoIncrement' => null],
        'order_no' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => '', 'comment' => '订单号', 'precision' => null, 'fixed' => null],
        'price' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '定价'],
        'fee' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '实际支付'],
        'remark' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '备注', 'precision' => null, 'fixed' => null],
        'stauts' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '订单状态', 'precision' => null, 'autoIncrement' => null],
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
            'type' => 1,
            'relate_id' => 1,
            'user_id' => 1,
            'seller_id' => 1,
            'order_no' => 'Lorem ipsum dolor ',
            'price' => 1.5,
            'fee' => 1.5,
            'remark' => 'Lorem ipsum dolor sit amet',
            'stauts' => 1,
            'create_time' => '2016-06-01 18:16:01',
            'update_time' => '2016-06-01 18:16:01'
        ],
    ];
}
