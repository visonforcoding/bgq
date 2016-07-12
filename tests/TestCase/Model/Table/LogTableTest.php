<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogTable Test Case
 */
class LogTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LogTable
     */
    public $Log;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.log',
        'app.card_box',
        'app.other_card',
        'app.savant',
        'app.news',
        'app.admins',
        'app.g',
        'app.menu',
        'app.group_menu',
        'app.admin_group',
        'app.industries',
        'app.user',
        'app.subjects',
        'app.user_industry',
        'app.savants',
        'app.news_savant',
        'app.activity',
        'app.users',
        'app.agencies',
        'app.educations',
        'app.careers',
        'app.user_fans',
        'app.followings',
        'app.card_boxes',
        'app.my_card_case',
        'app.collect',
        'app.activities',
        'app.activity_industry',
        'app.activity_savant',
        'app.regions',
        'app.activitycom',
        'app.replyusers',
        'app.reco_users',
        'app.secret',
        'app.likes',
        'app.newscom',
        'app.reply',
        'app.commentlike',
        'app.activityapply',
        'app.likelogs',
        'app.news_industry',
        'app.praises',
        'app.comments',
        'app.card_box_log'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Log') ? [] : ['className' => 'App\Model\Table\LogTable'];
        $this->Log = TableRegistry::get('Log', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Log);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
