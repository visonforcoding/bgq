<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttachTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttachTable Test Case
 */
class AttachTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttachTable
     */
    public $Attach;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attach',
        'app.projs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Attach') ? [] : ['className' => 'App\Model\Table\AttachTable'];
        $this->Attach = TableRegistry::get('Attach', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Attach);

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
