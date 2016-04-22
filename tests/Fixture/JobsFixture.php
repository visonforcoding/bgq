<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JobsFixture
 *
 */
class JobsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '招聘表', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '用户id', 'precision' => null, 'autoIncrement' => null],
        'company' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'comment' => '公司', 'precision' => null, 'fixed' => null],
        'num' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '招聘人数', 'precision' => null, 'autoIncrement' => null],
        'offer_range' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'comment' => '薪资范围，逗号分隔', 'precision' => null, 'fixed' => null],
        'industry_id' => ['type' => 'string', 'length' => 200, 'null' => true, 'default' => null, 'comment' => '行业id,用逗号分隔', 'precision' => null, 'fixed' => null],
        'offer_addr' => ['type' => 'string', 'length' => 200, 'null' => false, 'default' => null, 'comment' => '工作地点', 'precision' => null, 'fixed' => null],
        'job_desc' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '招聘简介', 'precision' => null],
        'job_status' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => true, 'default' => '1', 'comment' => '招聘状态：1.提交，2.通过，3.拒绝', 'precision' => null, 'autoIncrement' => null],
        'job_order' => ['type' => 'integer', 'length' => 6, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '排序', 'precision' => null, 'autoIncrement' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '创建时间', 'precision' => null],
        'update_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '更新时间', 'precision' => null],
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
            'num' => 1,
            'offer_range' => 'Lorem ipsum dolor ',
            'industry_id' => 'Lorem ipsum dolor sit amet',
            'offer_addr' => 'Lorem ipsum dolor sit amet',
            'job_desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'job_status' => 1,
            'job_order' => 1,
            'create_time' => '2016-04-22 17:15:32',
            'update_time' => '2016-04-22 17:15:32'
        ],
    ];
}
