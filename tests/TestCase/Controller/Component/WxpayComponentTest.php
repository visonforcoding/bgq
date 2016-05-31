<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\WxpayComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\WxpayComponent Test Case
 */
class WxpayComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\WxpayComponent
     */
    public $Wxpay;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Wxpay = new WxpayComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wxpay);

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
