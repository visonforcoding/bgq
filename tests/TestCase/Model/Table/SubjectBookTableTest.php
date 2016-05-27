<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubjectBookTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubjectBookTable Test Case
 */
class SubjectBookTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubjectBookTable
     */
    public $SubjectBook;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subject_book',
        'app.subjects',
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
        $config = TableRegistry::exists('SubjectBook') ? [] : ['className' => 'App\Model\Table\SubjectBookTable'];
        $this->SubjectBook = TableRegistry::get('SubjectBook', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SubjectBook);

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
