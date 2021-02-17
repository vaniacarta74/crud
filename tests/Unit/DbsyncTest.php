<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Curl;

/**
 * Description of DbsyncTest
 *
 * @author Vania
 */
class DbsyncTest extends TestCase
{
    /**
     * coversNothing
     */
    public function dbsyncJsonFileProvider()
    {
        $data = [
            'standard' => [
                'url' => 'http://localhost/sviluppo/crud/github/src/dbsync.php',
                'provider' => 'dbsync.json'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group main
     * covers dbsync.php
     * @dataProvider dbsyncJsonFileProvider     
     */
    public function testDbsyncJsonStringEqualsJsonFile($url, $provider)
    {
        $json = file_get_contents(__DIR__ . '/../providers/' . $provider);        
        $actual = Curl::run($url);
        
        $parts = explode('%', $json);
        foreach ($parts as $expected) {
            $position = strpos($actual, $expected);
            $this->assertTrue(is_int($position));
        }
    }
}
