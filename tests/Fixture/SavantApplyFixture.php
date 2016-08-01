<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SavantApplyFixture
 *
 */
class SavantApplyFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'savant_apply';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '用户id', 'precision' => null, 'autoIncrement' => null],
        'check_man' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '审核人', 'precision' => null, 'fixed' => null],
        'reason' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => '', 'comment' => '意见', 'precision' => null, 'fixed' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '申请时间', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '更新时间', 'precision' => null],
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
            'check_man' => 'Lorem ipsum dolor sit amet',
            'reason' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-08-01 11:53:01',
            'update_time' => '2016-08-01 11:53:01'
        ],
    ];
}
