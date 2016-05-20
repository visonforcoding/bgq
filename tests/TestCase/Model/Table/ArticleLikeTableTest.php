<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArticleLikeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArticleLikeTable Test Case
 */
class ArticleLikeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArticleLikeTable
     */
    public $ArticleLike;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.article_like',
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
        $config = TableRegistry::exists('ArticleLike') ? [] : ['className' => 'App\Model\Table\ArticleLikeTable'];
        $this->ArticleLike = TableRegistry::get('ArticleLike', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArticleLike);

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
