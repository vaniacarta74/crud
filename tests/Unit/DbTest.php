<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Db;

/**
 * Description of CurlTest
 *
 * @author Vania
 */
class DbTest extends TestCase
{
    /**
     * @group db
     * @covers \vaniacarta74\Crud\Db::run
     */
    public function testPrintConnectionStringEquals()
    {
//        $expected = 'mssql://192.168.1.43\SQL_SERVER_SPT@sa:Race14Maggio2016';
//                
//        $actual = Db::printConnectionString();
        
        $this->assertEquals('pippo', 'pluto');
    }
}
