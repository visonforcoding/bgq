<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjrongTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjrongTable Test Case
 */
class ProjrongTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjrongTable
     */
    public $Projrong;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projrong',
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
        $config = TableRegistry::exists('Projrong') ? [] : ['className' => 'App\Model\Table\ProjrongTable'];
        $this->Projrong = TableRegistry::get('Projrong', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Projrong);

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
