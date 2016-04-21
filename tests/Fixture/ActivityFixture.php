<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActivityFixture
 *
 */
class ActivityFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'activity';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '活动表', 'autoIncrement' => true, 'precision' => null],
        'admin_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '作者id', 'precision' => null, 'autoIncrement' => null],
        'industry_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '标签id', 'precision' => null, 'autoIncrement' => null],
        'company' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'comment' => '主办单位', 'precision' => null, 'fixed' => null],
        'title' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => null, 'comment' => '活动名称', 'precision' => null, 'fixed' => null],
        'time' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '活动时间（3.2~4.1）', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => null, 'comment' => '地点', 'precision' => null, 'fixed' => null],
        'scale' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '规模', 'precision' => null, 'fixed' => null],
        'read_nums' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '阅读数', 'precision' => null, 'autoIncrement' => null],
        'praise_nums' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '点赞数', 'precision' => null, 'autoIncrement' => null],
        'comment_nums' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '评论数', 'precision' => null, 'autoIncrement' => null],
        'cover' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '封面', 'precision' => null, 'fixed' => null],
        'body' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '活动内容', 'precision' => null],
        'summary' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '摘要', 'precision' => null, 'fixed' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '创建时间', 'precision' => null],
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
            'admin_id' => 1,
            'industry_id' => 1,
            'company' => 'Lorem ipsum dolor sit amet',
            'title' => 'Lorem ipsum dolor sit amet',
            'time' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'scale' => 'Lorem ipsum dolor sit amet',
            'read_nums' => 1,
            'praise_nums' => 1,
            'comment_nums' => 1,
            'cover' => 'Lorem ipsum dolor sit amet',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'summary' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-04-21 10:51:39',
            'update_time' => '2016-04-21 10:51:39'
        ],
    ];
}
