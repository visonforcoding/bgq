<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SponsorFixture
 *
 */
class SponsorFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'sponsor';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '活动赞助表', 'autoIncrement' => true, 'precision' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '用户id', 'precision' => null, 'autoIncrement' => null],
        'activity_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '活动id', 'precision' => null, 'autoIncrement' => null],
        'create_time' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '提交时间', 'precision' => null],
        'type' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '类型值：0：嘉宾推荐；1：场地赞助；2：现金赞助；3：物品赞助；4：其他', 'precision' => null, 'autoIncrement' => null],
        'description' => ['type' => 'string', 'length' => 550, 'null' => true, 'default' => null, 'comment' => '描述', 'precision' => null, 'fixed' => null],
        'name' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'comment' => '姓名', 'precision' => null, 'fixed' => null],
        'company' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'comment' => '公司/机构', 'precision' => null, 'fixed' => null],
        'department' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'comment' => '部门', 'precision' => null, 'fixed' => null],
        'position' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'comment' => '职务', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '地址', 'precision' => null, 'fixed' => null],
        'people' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '容纳人数', 'precision' => null, 'autoIncrement' => null],
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
            'activity_id' => 1,
            'create_time' => '2016-05-19 14:22:25',
            'type' => 1,
            'description' => 'Lorem ipsum dolor sit amet',
            'name' => 'Lorem ipsum dolor ',
            'company' => 'Lorem ipsum dolor sit amet',
            'department' => 'Lorem ipsum dolor ',
            'position' => 'Lorem ipsum dolor ',
            'address' => 'Lorem ipsum dolor sit amet',
            'people' => 1
        ],
    ];
}
