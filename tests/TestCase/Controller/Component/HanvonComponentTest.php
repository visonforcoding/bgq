<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\HanvonComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\HanvonComponent Test Case
 */
class HanvonComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\HanvonComponent
     */
    public $Hanvon;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Hanvon = new HanvonComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Hanvon);

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
