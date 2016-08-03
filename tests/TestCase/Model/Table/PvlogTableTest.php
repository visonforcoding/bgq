<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PvlogTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PvlogTable Test Case
 */
class PvlogTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PvlogTable
     */
    public $Pvlog;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.pvlog'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Pvlog') ? [] : ['className' => 'App\Model\Table\PvlogTable'];
        $this->Pvlog = TableRegistry::get('Pvlog', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Pvlog);

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
