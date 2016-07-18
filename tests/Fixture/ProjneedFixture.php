<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjneedFixture
 *
 */
class ProjneedFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'projneed';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'title' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '标题', 'precision' => null, 'fixed' => null],
        'body' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'comment' => '内容', 'precision' => null],
        'needer' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '需求方', 'precision' => null, 'fixed' => null],
        'follower' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => '跟进人', 'precision' => null, 'fixed' => null],
        'stage_remark' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => '', 'comment' => '进度描述', 'precision' => null, 'fixed' => null],
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
            'title' => 'Lorem ipsum dolor sit amet',
            'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'needer' => 'Lorem ipsum dolor sit amet',
            'follower' => 'Lorem ipsum dolor sit amet',
            'stage_remark' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-07-18 11:38:25',
            'update_time' => '2016-07-18 11:38:25'
        ],
    ];
}
