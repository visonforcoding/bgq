<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SavantTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SavantTable Test Case
 */
class SavantTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SavantTable
     */
    public $Savant;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.savant',
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
        $config = TableRegistry::exists('Savant') ? [] : ['className' => 'App\Model\Table\SavantTable'];
        $this->Savant = TableRegistry::get('Savant', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Savant);

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
