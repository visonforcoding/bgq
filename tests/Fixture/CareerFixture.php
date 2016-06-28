<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CareerFixture
 *
 */
class CareerFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'career';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '工作经历', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '用户', 'precision' => null, 'autoIncrement' => null],
        'company' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '公司', 'precision' => null, 'fixed' => null],
        'position' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '职位', 'precision' => null, 'fixed' => null],
        'start_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '开始日期', 'precision' => null],
        'end_date' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '结束日期', 'precision' => null],
        'desc' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'comment' => '描述', 'precision' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '创建日期', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '修改日期', 'precision' => null],
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
            'company' => 'Lorem ipsum dolor sit amet',
            'position' => 'Lorem ipsum dolor sit amet',
            'start_date' => '2016-06-26',
            'end_date' => '2016-06-26',
            'desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'create_time' => '2016-06-26 14:29:03',
            'update_time' => '2016-06-26 14:29:03'
        ],
    ];
}
