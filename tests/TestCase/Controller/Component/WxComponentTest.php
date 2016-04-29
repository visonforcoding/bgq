<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\WxComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\WxComponent Test Case
 */
class WxComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\WxComponent
     */
    public $Wx;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Wx = new WxComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wx);

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
