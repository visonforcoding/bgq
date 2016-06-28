<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EducationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EducationTable Test Case
 */
class EducationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EducationTable
     */
    public $Education;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.education',
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
        $config = TableRegistry::exists('Education') ? [] : ['className' => 'App\Model\Table\EducationTable'];
        $this->Education = TableRegistry::get('Education', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Education);

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
