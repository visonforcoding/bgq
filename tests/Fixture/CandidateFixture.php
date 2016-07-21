<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CandidateFixture
 *
 */
class CandidateFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'candidate';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'job_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => '0', 'comment' => '招聘信息id', 'precision' => null, 'autoIncrement' => null],
        'truename' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => '姓名', 'precision' => null, 'fixed' => null],
        'birthday' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '生日', 'precision' => null],
        'phone' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => '', 'comment' => '电话', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => '', 'comment' => '邮箱', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => '', 'comment' => '地址', 'precision' => null, 'fixed' => null],
        'career' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'comment' => '工作经历', 'precision' => null],
        'education' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'comment' => '教育经历', 'precision' => null],
        'salary' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '期望薪水', 'precision' => null, 'fixed' => null],
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
            'job_id' => 1,
            'truename' => 'Lorem ipsum dolor sit amet',
            'birthday' => '2016-07-21',
            'phone' => 'Lorem ipsum dolor sit amet',
            'email' => 'Lorem ipsum dolor sit amet',
            'address' => 'Lorem ipsum dolor sit amet',
            'career' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'education' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'salary' => 'Lorem ipsum dolor sit amet',
            'create_time' => '2016-07-21 12:15:41',
            'update_time' => '2016-07-21 12:15:41'
        ],
    ];
}
