<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Accessor;
use vaniacarta74\Crud\Router;
use vaniacarta74\Crud\tests\classes\Reflections;

/**
 * Description of AccessorTest
 *
 * @author Vania
 */
class AccessorTest extends TestCase
{
    private $router;
    
    protected function setUp()
    {
        $path = 'http://localhost/crud/api/h1/sscp/dati_acquisiti/4000000';
        $method = 'GET';
        $this->router = new Router($path, $method);
    }
    
    protected function tearDown()
    {
        $this->router = null;
    }
    
    /**
     * @group accessor
     * @coversNothing
     */
    public function callProvider()
    {
        $data = [
            'set' => [
                'args' => [
                    'name' => 'setAlias',
                    'arguments' => [
                        'pippo'
                    ]
                ],
                'expected' => [
                    true,
                    'pippo'
                ]
            ],
            'get' => [
                'args' => [
                    'name' => 'getAlias',
                    'arguments' => []
                ],
                'expected' => [
                    'sscp',
                    'sscp'
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group accessor
     * @covers \vaniacarta74\Crud\Accessor::__call
     * @covers \vaniacarta74\Crud\Accessor::setAccessor
     * @covers \vaniacarta74\Crud\Accessor::getAccessor
     * @dataProvider callProvider
     */
    public function testCallEquals($args, $expected)
    {        
        $actual = Reflections::invokeMethod($this->router, '__call', $args);
        
        $this->assertEquals($expected[0], $actual); 

        $actual = Reflections::getProperty($this->router, 'alias');
        
        $this->assertEquals($expected[1], $actual);
    }
    
    /**
     * @group accessor
     * @coversNothing
     */
    public function callExceptionProvider()
    {
        $data = [
            'no method' => [
                'args' => [
                    'name' => 'getPippo',
                    'arguments' => [
                        'pippo'
                    ]
                ]
            ],
            'wrong method' => [
                'args' => [
                    'name' => 'alias',
                    'arguments' => []
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group accessor
     * @covers \vaniacarta74\Crud\Accessor::__call
     * @covers \vaniacarta74\Crud\Accessor::setAccessor
     * @covers \vaniacarta74\Crud\Accessor::getAccessor
     * @dataProvider callExceptionProvider
     */
    public function testCallException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, '__call', $args);
    }
}
