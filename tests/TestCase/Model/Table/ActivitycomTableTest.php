<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActivitycomTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActivitycomTable Test Case
 */
class ActivitycomTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActivitycomTable
     */
    public $Activitycom;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activitycom',
        'app.activities',
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
        $config = TableRegistry::exists('Activitycom') ? [] : ['className' => 'App\Model\Table\ActivitycomTable'];
        $this->Activitycom = TableRegistry::get('Activitycom', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Activitycom);

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
