<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CareerTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CareerTable Test Case
 */
class CareerTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CareerTable
     */
    public $Career;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.career',
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
        $config = TableRegistry::exists('Career') ? [] : ['className' => 'App\Model\Table\CareerTable'];
        $this->Career = TableRegistry::get('Career', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Career);

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
