<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsermsgTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsermsgTable Test Case
 */
class UsermsgTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsermsgTable
     */
    public $Usermsg;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.usermsg',
        'app.users',
        'app.tables'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Usermsg') ? [] : ['className' => 'App\Model\Table\UsermsgTable'];
        $this->Usermsg = TableRegistry::get('Usermsg', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Usermsg);

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
