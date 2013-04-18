<?php

class ABTestingExtensionTest extends PHPUnit_Framework_TestCase
{
    protected $extension;
    protected function setUp()
    {
        $this->extension = new ABTestingExtension(
            array(
                'a',
                'b'
            )
        );
    }
    public function testGetABTesting()
    {
        $_GET['test'] = 'a';
        $this->assertTrue(
            $this->extension->getABTesting(
                'test',
                'a'
            )
        );
        $this->assertTrue(
            $this->extension->getABTesting(
                'test_a'
            )
        );
        $this->assertFalse(
            $this->extension->getABTesting(
                'test',
                'b'
            )
        );
        $this->assertFalse(
            $this->extension->getABTesting(
                'test_b'
            )
        );
        $this->assertFalse(
            $this->extension->getABTesting(
                'test',
                'c'
            )
        );
        $this->assertFalse(
            $this->extension->getABTesting(
                'notexists',
                'c'
            )
        );
    }
    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Need at least one argument to ABTestingExtension::getABTesting
     */
    public function testGetABTestingException()
    {
        $this->extension->getABTesting();
    }
}