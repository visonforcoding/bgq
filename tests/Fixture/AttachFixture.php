<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttachFixture
 *
 */
class AttachFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'attach';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'proj_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '项目id', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => '', 'comment' => '名称', 'precision' => null, 'fixed' => null],
        'path' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => '', 'comment' => '路径', 'precision' => null, 'fixed' => null],
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
            'proj_id' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'path' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-08-18 12:25:15'
        ],
    ];
}
