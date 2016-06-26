<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SavantRecoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SavantRecoTable Test Case
 */
class SavantRecoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SavantRecoTable
     */
    public $SavantReco;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.savant_reco',
        'app.savants',
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
        $config = TableRegistry::exists('SavantReco') ? [] : ['className' => 'App\Model\Table\SavantRecoTable'];
        $this->SavantReco = TableRegistry::get('SavantReco', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SavantReco);

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
