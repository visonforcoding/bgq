<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IndustryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IndustryTable Test Case
 */
class IndustryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\IndustryTable
     */
    public $Industry;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.industry',
        'app.user'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Industry') ? [] : ['className' => 'App\Model\Table\IndustryTable'];
        $this->Industry = TableRegistry::get('Industry', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Industry);

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
