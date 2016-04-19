<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UtilComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UtilComponent Test Case
 */
class UtilComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\UtilComponent
     */
    public $Util;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Util = new UtilComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Util);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
