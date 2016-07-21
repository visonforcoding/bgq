<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JobFixture
 *
 */
class JobFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'job';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'company' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => '公司', 'precision' => null, 'fixed' => null],
        'admin_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '负责人id', 'precision' => null, 'autoIncrement' => null],
        'contact' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => '', 'comment' => '联系方式', 'precision' => null, 'fixed' => null],
        'earnings' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '分成方式', 'precision' => null, 'autoIncrement' => null],
        'position' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => '招聘职位', 'precision' => null, 'fixed' => null],
        'salary' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => '薪资范围', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => '', 'comment' => '工作地点', 'precision' => null, 'fixed' => null],
        'summary' => ['type' => 'string', 'length' => 750, 'null' => false, 'default' => '', 'comment' => '招聘简介', 'precision' => null, 'fixed' => null],
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
            'company' => 'Lorem ipsum dolor sit amet',
            'admin_id' => 1,
            'contact' => 'Lorem ipsum dolor sit amet',
            'earnings' => 1,
            'position' => 'Lorem ipsum dolor sit amet',
            'salary' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'summary' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-07-21 10:56:55',
            'update_time' => '2016-07-21 10:56:55'
        ],
    ];
}
