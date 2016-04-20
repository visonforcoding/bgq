<?php
namespace Wpadmin\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActionlogFixture
 *
 */
class ActionlogFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'actionlog';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '主键，自增', 'autoIncrement' => true, 'precision' => null],
        'module' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'comment' => '模块名称', 'precision' => null, 'fixed' => null],
        'url' => ['type' => 'string', 'length' => 1000, 'null' => false, 'default' => null, 'comment' => '请求地址', 'precision' => null, 'fixed' => null],
        'type' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '请求类型', 'precision' => null, 'fixed' => null],
        'browse' => ['type' => 'string', 'length' => 1000, 'null' => false, 'default' => null, 'comment' => '浏览器信息', 'precision' => null, 'fixed' => null],
        'ip' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'comment' => '客户端IP', 'precision' => null, 'fixed' => null],
        'filename' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '脚本名称', 'precision' => null, 'fixed' => null],
        'msg' => ['type' => 'string', 'length' => 150, 'null' => false, 'default' => null, 'comment' => '日志内容', 'precision' => null, 'fixed' => null],
        'param' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '请求参数', 'precision' => null, 'fixed' => null],
        'user' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'comment' => '操作者', 'precision' => null, 'fixed' => null],
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
            'module' => 'Lorem ipsum dolor sit amet',
            'url' => 'Lorem ipsum dolor sit amet',
            'type' => 'Lorem ipsum dolor sit amet',
            'browse' => 'Lorem ipsum dolor sit amet',
            'ip' => 'Lorem ipsum dolor sit amet',
            'filename' => 'Lorem ipsum dolor sit amet',
            'msg' => 'Lorem ipsum dolor sit amet',
            'param' => 'Lorem ipsum dolor sit amet',
            'user' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-04-20 14:55:47'
        ],
    ];
}
