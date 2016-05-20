<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivityapplyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivityapplyTable Test Case
 */
class ActivityapplyTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivityapplyTable
     */
    public $Activityapply;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activityapply',
        'app.users',
        'app.activities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Activityapply') ? [] : ['className' => 'App\Model\Table\ActivityapplyTable'];
        $this->Activityapply = TableRegistry::get('Activityapply', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Activityapply);

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
