<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AlipayComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AlipayComponent Test Case
 */
class AlipayComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\AlipayComponent
     */
    public $Alipay;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Alipay = new AlipayComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Alipay);

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
