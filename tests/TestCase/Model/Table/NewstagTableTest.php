<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NewstagTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NewstagTable Test Case
 */
class NewstagTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NewstagTable
     */
    public $Newstag;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.newstag'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Newstag') ? [] : ['className' => 'App\Model\Table\NewstagTable'];
        $this->Newstag = TableRegistry::get('Newstag', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Newstag);

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
