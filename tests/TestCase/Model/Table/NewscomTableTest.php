<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NewscomTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NewscomTable Test Case
 */
class NewscomTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NewscomTable
     */
    public $Newscom;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.newscom',
        'app.news',
        'app.admins',
        'app.g',
        'app.menu',
        'app.group_menu',
        'app.admin_group',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Newscom') ? [] : ['className' => 'App\Model\Table\NewscomTable'];
        $this->Newscom = TableRegistry::get('Newscom', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Newscom);

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
