<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FlowFixture
 *
 */
class FlowFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'flow';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '用户', 'precision' => null, 'autoIncrement' => null],
        'type' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '交易类型', 'precision' => null, 'autoIncrement' => null],
        'type_msg' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '类型名称', 'precision' => null, 'fixed' => null],
        'income' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '是否收入1:收入2:支出', 'precision' => null],
        'amount' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => '交易金额'],
        'pre_amount' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => '交易前金额'],
        'after_amount' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => '交易后金额'],
        'status' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '交易状态', 'precision' => null, 'autoIncrement' => null],
        'remark' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '备注', 'precision' => null, 'fixed' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '创建时间', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '修改时间', 'precision' => null],
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
            'type_msg' => 'Lorem ipsum dolor sit amet',
            'income' => 1,
            'amount' => 1.5,
            'pre_amount' => 1.5,
            'after_amount' => 1.5,
            'status' => 1,
            'remark' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-06-13 20:13:35',
            'update_time' => '2016-06-13 20:13:35'
        ],
    ];
}
