<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BannerFixture
 *
 */
class BannerFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'banner';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '轮播图', 'precision' => null, 'autoIncrement' => null],
        'type' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '类型', 'precision' => null, 'autoIncrement' => null],
        'img' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '图片', 'precision' => null, 'fixed' => null],
        'url' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '链接地址', 'precision' => null, 'fixed' => null],
        'remark' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '备注说明', 'precision' => null, 'fixed' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '创建时间', 'precision' => null],
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
            'type' => 1,
            'img' => 'Lorem ipsum dolor sit amet',
            'url' => 'Lorem ipsum dolor sit amet',
            'remark' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-04-19 10:31:22'
        ],
    ];
}
