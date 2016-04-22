<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjrongFixture
 *
 */
class ProjrongFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'projrong';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '融资项目', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '发布人id', 'precision' => null, 'autoIncrement' => null],
        'publisher' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '发布人', 'precision' => null, 'fixed' => null],
        'company' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'comment' => '公司', 'precision' => null, 'fixed' => null],
        'title' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => null, 'comment' => '项目名称', 'precision' => null, 'fixed' => null],
        'rzjd' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '融资阶段', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => null, 'comment' => '地点', 'precision' => null, 'fixed' => null],
        'scale' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '融资规模', 'precision' => null, 'fixed' => null],
        'stock' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '股份', 'precision' => null, 'fixed' => null],
        'read_nums' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '阅读数', 'precision' => null, 'autoIncrement' => null],
        'praise_nums' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '点赞数', 'precision' => null, 'autoIncrement' => null],
        'comment_nums' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '评论数', 'precision' => null, 'autoIncrement' => null],
        'cover' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '封面', 'precision' => null, 'fixed' => null],
        'body' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'comment' => '活动内容', 'precision' => null],
        'summary' => ['type' => 'string', 'length' => 550, 'null' => true, 'default' => null, 'comment' => '项目简介', 'precision' => null, 'fixed' => null],
        'comp_desc' => ['type' => 'string', 'length' => 550, 'null' => true, 'default' => null, 'comment' => '公司简介', 'precision' => null, 'fixed' => null],
        'team' => ['type' => 'string', 'length' => 550, 'null' => true, 'default' => null, 'comment' => '核心团队', 'precision' => null, 'fixed' => null],
        'attach' => ['type' => 'string', 'length' => 350, 'null' => true, 'default' => null, 'comment' => '资料地址', 'precision' => null, 'fixed' => null],
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
            'user_id' => 1,
            'publisher' => 'Lorem ipsum dolor sit amet',
            'company' => 'Lorem ipsum dolor sit amet',
            'title' => 'Lorem ipsum dolor sit amet',
            'rzjd' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'scale' => 'Lorem ipsum dolor sit amet',
            'stock' => 'Lorem ipsum dolor sit amet',
            'read_nums' => 1,
            'praise_nums' => 1,
            'comment_nums' => 1,
            'cover' => 'Lorem ipsum dolor sit amet',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'summary' => 'Lorem ipsum dolor sit amet',
            'comp_desc' => 'Lorem ipsum dolor sit amet',
            'team' => 'Lorem ipsum dolor sit amet',
            'attach' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-04-21 18:35:12',
            'update_time' => '2016-04-21 18:35:12'
        ],
    ];
}
