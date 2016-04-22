<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RongTagTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RongTagTable Test Case
 */
class RongTagTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RongTagTable
     */
    public $RongTag;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rong_tag',
        'app.projects',
        'app.industries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('RongTag') ? [] : ['className' => 'App\Model\Table\RongTagTable'];
        $this->RongTag = TableRegistry::get('RongTag', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RongTag);

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
