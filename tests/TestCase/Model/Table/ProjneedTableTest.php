<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjneedTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjneedTable Test Case
 */
class ProjneedTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjneedTable
     */
    public $Projneed;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projneed',
        'app.industry',
        'app.user',
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
        'app.projneed_industry'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Projneed') ? [] : ['className' => 'App\Model\Table\ProjneedTable'];
        $this->Projneed = TableRegistry::get('Projneed', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Projneed);

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
