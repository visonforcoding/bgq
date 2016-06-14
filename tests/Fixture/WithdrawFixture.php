<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * WithdrawFixture
 *
 */
class WithdrawFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'withdraw';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '对象id', 'precision' => null, 'autoIncrement' => null],
        'amount' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '提现金额'],
        'cardno' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '银行卡号', 'precision' => null, 'fixed' => null],
        'bank' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '银行', 'precision' => null, 'fixed' => null],
        'truename' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '持卡人姓名', 'precision' => null, 'fixed' => null],
        'fee' => ['type' => 'float', 'length' => null, 'precision' => null, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '手续费'],
        'remark' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => '0', 'comment' => '备注', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '状态,0未审核，1审核通过', 'precision' => null, 'autoIncrement' => null],
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
            'amount' => 1,
            'cardno' => 'Lorem ipsum dolor sit amet',
            'bank' => 'Lorem ipsum dolor sit amet',
            'truename' => 'Lorem ipsum dolor sit amet',
            'fee' => 1,
            'remark' => 'Lorem ipsum dolor sit amet',
            'status' => 1,
            'create_time' => '2016-06-14 16:53:32',
            'update_time' => '2016-06-14 16:53:32'
        ],
    ];
}
