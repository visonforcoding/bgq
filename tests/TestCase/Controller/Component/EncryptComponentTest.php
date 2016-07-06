<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\EncryptComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\EncryptComponent Test Case
 */
class EncryptComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\EncryptComponent
     */
    public $Encrypt;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Encrypt = new EncryptComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Encrypt);

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
