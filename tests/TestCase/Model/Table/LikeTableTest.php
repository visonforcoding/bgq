<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LikeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LikeTable Test Case
 */
class LikeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LikeTable
     */
    public $Like;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.like',
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
        $config = TableRegistry::exists('Like') ? [] : ['className' => 'App\Model\Table\LikeTable'];
        $this->Like = TableRegistry::get('Like', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Like);

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
