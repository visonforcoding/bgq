<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CollectTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CollectTable Test Case
 */
class CollectTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CollectTable
     */
    public $Collect;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.collect',
        'app.users',
        'app.relates',
        'app.news',
        'app.admins',
        'app.g',
        'app.menu',
        'app.group_menu',
        'app.admin_group',
        'app.industries',
        'app.user',
        'app.user_industry',
        'app.agencies',
        'app.news_industry',
        'app.comments',
        'app.news_collect'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Collect') ? [] : ['className' => 'App\Model\Table\CollectTable'];
        $this->Collect = TableRegistry::get('Collect', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Collect);

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
