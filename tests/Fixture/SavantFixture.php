<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SavantFixture
 *
 */
class SavantFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'savant';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cover' => ['type' => 'string', 'length' => 550, 'null' => false, 'default' => null, 'comment' => '封面', 'precision' => null, 'fixed' => null],
        'summary' => ['type' => 'string', 'length' => 550, 'null' => false, 'default' => null, 'comment' => '简洁', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'user_id' => ['type' => 'unique', 'columns' => ['user_id'], 'length' => []],
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
            'cover' => 'Lorem ipsum dolor sit amet',
            'summary' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
