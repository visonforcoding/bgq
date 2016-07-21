<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\JobTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\JobTable Test Case
 */
class JobTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\JobTable
     */
    public $Job;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.job',
        'app.admins',
        'app.industry',
        'app.user',
        'app.savant',
        'app.news',
        'app.industries',
        'app.news_industry',
        'app.savants',
        'app.subjects',
        'app.user_industry',
        'app.agencies',
        'app.educations',
        'app.users',
        'app.careers',
        'app.activity',
        'app.activity_industry',
        'app.activity_savant',
        'app.regions',
        'app.collect',
        'app.activities',
        'app.activitycom',
        'app.replyusers',
        'app.user_fans',
        'app.followings',
        'app.focus',
        'app.followers',
        'app.newscoms',
        'app.reply',
        'app.activitycoms',
        'app.likes',
        'app.newscom',
        'app.card_boxes',
        'app.other_card',
        'app.reco_users',
        'app.secret',
        'app.customer',
        'app.g',
        'app.menu',
        'app.group_menu',
        'app.admin_menu',
        'app.admin_group',
        'app.menus',
        'app.my_card_case',
        'app.commentlike',
        'app.activityapply',
        'app.likelogs',
        'app.news_savant',
        'app.praises',
        'app.comments',
        'app.job_industry'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Job') ? [] : ['className' => 'App\Model\Table\JobTable'];
        $this->Job = TableRegistry::get('Job', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Job);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
