<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PvlogFixture
 *
 */
class PvlogFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'pvlog';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'ip' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => 'ip', 'precision' => null, 'fixed' => null],
        'screen' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => '', 'comment' => '屏幕尺寸', 'precision' => null, 'fixed' => null],
        'refer' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => '', 'comment' => '访问页', 'precision' => null, 'fixed' => null],
        'act' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => '', 'comment' => '', 'precision' => null, 'fixed' => null],
        'useragent' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => '', 'comment' => '用户头', 'precision' => null, 'fixed' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
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
            'ip' => 'Lorem ipsum dolor sit amet',
            'screen' => 'Lorem ipsum dolor ',
            'refer' => 'Lorem ipsum dolor sit amet',
            'act' => 'Lor',
            'useragent' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-08-03 12:27:00'
        ],
    ];
}
