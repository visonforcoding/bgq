<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SponsorTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SponsorTable Test Case
 */
class SponsorTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SponsorTable
     */
    public $Sponsor;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sponsor',
        'app.users',
        'app.activities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sponsor') ? [] : ['className' => 'App\Model\Table\SponsorTable'];
        $this->Sponsor = TableRegistry::get('Sponsor', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sponsor);

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
