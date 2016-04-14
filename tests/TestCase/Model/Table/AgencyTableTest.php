<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AgencyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AgencyTable Test Case
 */
class AgencyTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AgencyTable
     */
    public $Agency;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.agency'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Agency') ? [] : ['className' => 'App\Model\Table\AgencyTable'];
        $this->Agency = TableRegistry::get('Agency', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Agency);

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
