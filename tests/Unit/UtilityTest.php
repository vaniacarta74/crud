<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Utility;
use vaniacarta74\Crud\Check;
use vaniacarta74\Crud\Router;

/**
 * Description of UtilityTest
 *
 * @author Vania
 */
class UtilityTest extends TestCase
{
   /**
     * @group utility
     * @covers \vaniacarta74\Crud\Utility::benchmark
     */
    public function testBenchmarkOraEquals()
    {
        $dateTimeOra = new \DateTime('NOW', new \DateTimeZone('Europe/Rome'));
        $dateTimeOra->sub(new \DateInterval('PT2H'));
        $date = $dateTimeOra->format('Y-m-d H:i:s.u');
        
        $actual = Utility::benchmark($date);
        
        $this->assertRegExp('/^([1-9]\s(ora)[,]\s([1-5]?[0-9])\s(min)\s[e]\s([1-5]?[0-9])\s(sec))$/', $actual);
    }
    
    /**
     * @group utility
     * @covers \vaniacarta74\Crud\Utility::benchmark
     */
    public function testBenchmarkMinEquals()
    {
        $dateTimeMin = new \DateTime('NOW', new \DateTimeZone('Europe/Rome'));
        $dateTimeMin->sub(new \DateInterval('PT30M'));
        $date = $dateTimeMin->format('Y-m-d H:i:s.u');
        
        $actual = Utility::benchmark($date);
        
        $this->assertRegExp('/^(([1-9]|[1-5][0-9])\s(min)\s[e]\s([1-5]?[0-9])\s(sec))$/', $actual);
    }
    
    /**
     * @group utility
     * @covers \vaniacarta74\Crud\Utility::benchmark
     */
    public function testBenchmarkSecEquals()
    {
        $dateTimeSec = new \DateTime('NOW', new \DateTimeZone('Europe/Rome'));
        $dateTimeSec->sub(new \DateInterval('PT10S'));
        $date = $dateTimeSec->format('Y-m-d H:i:s.u');
        
        $actual = Utility::benchmark($date);
        
        $this->assertRegExp('/^(([1-5]?[0-9])([,][0-9]{3})?\s(sec))$/', $actual);
    }
    
    /**
     * @group utility
     * @covers \vaniacarta74\Crud\Utility::benchmark
     */
    public function testBenchmarkException()
    {
        $date = '2020-02-31';
        
        $this->setExpectedException('Exception');
        
        Utility::benchmark($date);
    }
    
    /**
     * @group utility
     * @covers \vaniacarta74\Crud\Utility::callback
     */
    public function testCallbackMethodEqualsWithDelta()  
    {        
        $class = 'Check';
        $method = 'isInteger';
        $param = 12345;
        
        $actual = Utility::callback(array($class, $method), array($param));
        
        $this->assertTrue($actual);
    }
    
    /**
     * @group utility
     * @covers \vaniacarta74\Crud\Utility::callback
     */
    public function testCallbackObjectEqualsWithDelta()  
    {        
        $path = 'http://localhost/crud/api/sscp/dati_acquisiti/4000000';
        $method = 'GET';
        $object = new Router($path, $method);
        $method = 'getTable';
        
        $expected = 'dati_acquisiti';
        
        $actual = Utility::callback(array($object, $method), array());
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group utility
     * @covers \vaniacarta74\Crud\Utility::callback
     */
    public function testCallbackException()
    {
        $funzione = 'pippo';
        
        $this->setExpectedException('Exception');
        
        Utility::callback($funzione, array(1,2,3));
    }
}
