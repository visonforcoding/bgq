<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SecretTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SecretTable Test Case
 */
class SecretTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SecretTable
     */
    public $Secret;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.secret',
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
        $config = TableRegistry::exists('Secret') ? [] : ['className' => 'App\Model\Table\SecretTable'];
        $this->Secret = TableRegistry::get('Secret', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Secret);

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
