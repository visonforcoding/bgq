<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EducationFixture
 *
 */
class EducationFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'education';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '教育经历表', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '用户', 'precision' => null, 'autoIncrement' => null],
        'school' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '学校', 'precision' => null, 'fixed' => null],
        'major' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '专业', 'precision' => null, 'fixed' => null],
        'education' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '学历', 'precision' => null, 'fixed' => null],
        'start_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '开始日期', 'precision' => null],
        'end_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '结束日期', 'precision' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '创建时间', 'precision' => null],
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
            'school' => 'Lorem ipsum dolor sit amet',
            'major' => 'Lorem ipsum dolor sit amet',
            'education' => 'Lorem ipsum dolor sit amet',
            'start_date' => '2016-06-26',
            'end_date' => '2016-06-26',
            'create_time' => '2016-06-26 14:28:14',
            'update_time' => '2016-06-26 14:28:14'
        ],
    ];
}
