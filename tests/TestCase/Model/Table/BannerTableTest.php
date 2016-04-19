<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BannerTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BannerTable Test Case
 */
class BannerTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BannerTable
     */
    public $Banner;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.banner'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Banner') ? [] : ['className' => 'App\Model\Table\BannerTable'];
        $this->Banner = TableRegistry::get('Banner', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Banner);

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
