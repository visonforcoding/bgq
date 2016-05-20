<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LikeLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LikeLogsTable Test Case
 */
class LikeLogsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LikeLogsTable
     */
    public $LikeLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.like_logs',
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
        $config = TableRegistry::exists('LikeLogs') ? [] : ['className' => 'App\Model\Table\LikeLogsTable'];
        $this->LikeLogs = TableRegistry::get('LikeLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LikeLogs);

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
