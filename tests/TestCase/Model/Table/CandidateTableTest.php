<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidateTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidateTable Test Case
 */
class CandidateTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidateTable
     */
    public $Candidate;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.candidate',
        'app.jobs',
        'app.user',
        'app.savant',
        'app.news',
        'app.admins',
        'app.g',
        'app.menu',
        'app.group_menu',
        'app.admin_menu',
        'app.admin_group',
        'app.menus',
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
        'app.my_card_case',
        'app.commentlike',
        'app.activityapply',
        'app.likelogs',
        'app.news_savant',
        'app.praises',
        'app.comments',
        'app.industry'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Candidate') ? [] : ['className' => 'App\Model\Table\CandidateTable'];
        $this->Candidate = TableRegistry::get('Candidate', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Candidate);

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
