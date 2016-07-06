<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\SecurityComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\SecurityComponent Test Case
 */
class SecurityComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\SecurityComponent
     */
    public $Security;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Security = new SecurityComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Security);

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
