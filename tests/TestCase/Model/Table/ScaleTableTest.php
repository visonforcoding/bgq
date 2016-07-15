<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScaleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScaleTable Test Case
 */
class ScaleTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ScaleTable
     */
    public $Scale;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.scale',
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
        $config = TableRegistry::exists('Scale') ? [] : ['className' => 'App\Model\Table\ScaleTable'];
        $this->Scale = TableRegistry::get('Scale', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scale);

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
