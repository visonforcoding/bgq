<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserMenuTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserMenuTable Test Case
 */
class UserMenuTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UserMenuTable
     */
    public $UserMenu;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.user_menu',
        'app.users',
        'app.menus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UserMenu') ? [] : ['className' => 'App\Model\Table\UserMenuTable'];
        $this->UserMenu = TableRegistry::get('UserMenu', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserMenu);

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
