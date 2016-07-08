<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\PushComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\PushComponent Test Case
 */
class PushComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\PushComponent
     */
    public $Push;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Push = new PushComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Push);

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
