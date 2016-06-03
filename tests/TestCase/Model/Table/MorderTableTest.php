<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MorderTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MorderTable Test Case
 */
class MorderTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MorderTable
     */
    public $Morder;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.morder',
        'app.relates',
        'app.users',
        'app.sellers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Morder') ? [] : ['className' => 'App\Model\Table\MorderTable'];
        $this->Morder = TableRegistry::get('Morder', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Morder);

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
