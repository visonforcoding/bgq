<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MeetSubjectTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MeetSubjectTable Test Case
 */
class MeetSubjectTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MeetSubjectTable
     */
    public $MeetSubject;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.meet_subject',
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
        $config = TableRegistry::exists('MeetSubject') ? [] : ['className' => 'App\Model\Table\MeetSubjectTable'];
        $this->MeetSubject = TableRegistry::get('MeetSubject', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MeetSubject);

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
