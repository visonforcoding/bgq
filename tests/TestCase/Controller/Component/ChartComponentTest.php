<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ChartComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ChartComponent Test Case
 */
class ChartComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ChartComponent
     */
    public $Chart;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Chart = new ChartComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Chart);

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
