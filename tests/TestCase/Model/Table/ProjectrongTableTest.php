<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProjectrongTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProjectrongTable Test Case
 */
class ProjectrongTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProjectrongTable
     */
    public $Projectrong;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.projectrong',
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
        $config = TableRegistry::exists('Projectrong') ? [] : ['className' => 'App\Model\Table\ProjectrongTable'];
        $this->Projectrong = TableRegistry::get('Projectrong', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Projectrong);

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
