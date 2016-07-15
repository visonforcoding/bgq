<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StageTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StageTable Test Case
 */
class StageTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StageTable
     */
    public $Stage;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stage',
        'app.projrong',
        'app.users',
        'app.savant',
        'app.news',
        'app.admins',
        'app.g',
        'app.menu',
        'app.group_menu',
        'app.admin_menu',
        'app.menus',
        'app.admin_group',
        'app.industries',
        'app.user',
        'app.subjects',
        'app.user_industry',
        'app.savants',
        'app.news_savant',
        'app.agencies',
        'app.educations',
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
        'app.news_industry',
        'app.praises',
        'app.comments',
        'app.tags',
        'app.rong_tag',
        'app.projects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Stage') ? [] : ['className' => 'App\Model\Table\StageTable'];
        $this->Stage = TableRegistry::get('Stage', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stage);

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
