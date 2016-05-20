<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CollectLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CollectLogsTable Test Case
 */
class CollectLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CollectLogsTable
     */
    public $CollectLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.collect_logs',
        'app.users',
        'app.relates'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CollectLogs') ? [] : ['className' => 'App\Model\Table\CollectLogsTable'];
        $this->CollectLogs = TableRegistry::get('CollectLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CollectLogs);

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
