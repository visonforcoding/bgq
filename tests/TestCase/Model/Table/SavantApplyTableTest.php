<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SavantApplyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SavantApplyTable Test Case
 */
class SavantApplyTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SavantApplyTable
     */
    public $SavantApply;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.savant_apply',
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
        $config = TableRegistry::exists('SavantApply') ? [] : ['className' => 'App\Model\Table\SavantApplyTable'];
        $this->SavantApply = TableRegistry::get('SavantApply', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SavantApply);

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
