<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NeedTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NeedTable Test Case
 */
class NeedTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NeedTable
     */
    public $Need;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.need',
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
        $config = TableRegistry::exists('Need') ? [] : ['className' => 'App\Model\Table\NeedTable'];
        $this->Need = TableRegistry::get('Need', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Need);

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
