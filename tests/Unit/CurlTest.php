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
 * Description of CurlTest
 *
 * @author Vania
 */
class CurlTest extends TestCase
{
    /**
     * @group curl
     * @coversNothing
     */
    public function runProvider()
    {
        $data = [
            'get' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'GET',
                'params' => null,
                'json' => null,                
                'expected' => '{
                    "ok": false,
                    "codice errore": 400,
                    "descrizione errore": "Parametri url non presenti"
                }'
            ],
            'post json' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'POST',
                'params' => [
                    "var" => 10230,
                    "type" => 2,
                    "date" => "01/01/2021",
                    "val" => 3.5
                ],
                'json' => true,
                'expected' => '{
                    "ok": true,
                    "method": "create",
                    "response": {
                        "message": "Record @id@ inserito con successo",
                        "link": "/h1/sscp/dati_acquisiti/@id@"
                    }
                }'
            ],
            'put' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700161?val=1.9&date=02/01/2020',
                'method' => 'PUT',
                'params' => null,
                'json' => null,
                'expected' => '{
                    "ok": true,
                    "method": "update",
                    "response": {
                        "message": "Record 101700161 aggiornato con successo",
                        "link": "/h1/sscp/dati_acquisiti/101700161"
                    }
                }'
            ],
            'patch' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700161?val=0.3&date=03/01/2020',
                'method' => 'PATCH',
                'params' => null,
                'json' => null,
                'expected' => '{
                    "ok": true,
                    "method": "update",
                    "response": {
                        "message": "Record 101700161 aggiornato con successo",
                        "link": "/h1/sscp/dati_acquisiti/101700161"
                    }
                }'
            ],
            'delete' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/@id@',
                'method' => 'DELETE',
                'params' => null,
                'json' => null,
                'expected' => '{
                    "ok": true,
                    "method": "delete",
                    "response": {
                        "message": "Record @id@ cancellato con successo"
                    }
                }'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group curl
     * @covers \vaniacarta74\Crud\Curl::run
     * @covers \vaniacarta74\Crud\Curl::exec
     * @dataProvider runProvider     
     */
    public function testRunEqualsJsonString($rawUrl, $method, $params, $json, $rawExpected)
    {
        $jsonId = file_get_contents(__DIR__ . '/../providers/index.json');
        $arrJson = json_decode($jsonId, true);
        $newId = $arrJson['id_dato'];
        
        if ($method === 'DELETE' || $method === 'POST') {            
            $url = str_replace('@id@', $newId, $rawUrl);
            $expected = str_replace('@id@', $newId, $rawExpected);
        } else {
            $url = $rawUrl;
            $expected = $rawExpected;
        }
        
        $actual = Curl::run($url, $method, $params, $json);
        
        $this->assertJsonStringEqualsJsonString($expected, $actual);
        
        if ($method === 'DELETE') {            
            file_put_contents(__DIR__ . '/../providers/index.json','{"id_dato":' . ($newId + 1) . '}');
        }
    }
    
    /**
     * @group curl
     * @coversNothing
     */
    public function runNotJsonProvider()
    {
        $data = [
            'post not json' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'POST',
                'params' => [
                    "var" => 10230,
                    "type" => 2,
                    "date" => "01/01/2021",
                    "val" => 3.5
                ],
                'json' => null,
                'expected' => '{
                    "ok": true,
                    "method": "create",
                    "response": {
                        "message": "Record @id@ inserito con successo",
                        "link": "/h1/sscp/dati_acquisiti/@id@"
                    }
                }'
            ],
            'delete' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/@id@',
                'method' => 'DELETE',
                'params' => null,
                'json' => null,
                'expected' => '{
                    "ok": true,
                    "method": "delete",
                    "response": {
                        "message": "Record @id@ cancellato con successo"
                    }
                }'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group curl
     * @covers \vaniacarta74\Crud\Curl::run
     * @covers \vaniacarta74\Crud\Curl::exec
     * @dataProvider runNotJsonProvider     
     */
    public function testRunNotJsonEqualsJsonString($rawUrl, $method, $params, $json, $rawExpected)
    {
        $jsonId = file_get_contents(__DIR__ . '/../providers/index.json');
        $arrJson = json_decode($jsonId, true);
        $newId = $arrJson['id_dato'];
        
        if ($method === 'DELETE' || $method === 'POST') {            
            $url = str_replace('@id@', $newId, $rawUrl);
            $expected = str_replace('@id@', $newId, $rawExpected);
        } else {
            $url = $rawUrl;
            $expected = $rawExpected;
        }
        
        $actual = Curl::run($url, $method, $params, $json);
        
        $this->assertJsonStringEqualsJsonString($expected, $actual);
        
        if ($method === 'DELETE') {            
            file_put_contents(__DIR__ . '/../providers/index.json','{"id_dato":' . ($newId + 1) . '}');
        }
    }
    
    /**
     * @group curl
     * @covers \vaniacarta74\Crud\Curl::run
     */
    public function testRunException()
    {
        
        $url = 'http://localhost/scarichi/tocsv.php';
        $method = 'POST';
        $params = [];
        
        $this->setExpectedException('Exception');
        
        Curl::run($url, $method, $params);
    }
    
    /**
     * @group curl
     * @coversNothing
     */
    public function setProvider()
    {
        $data = [
            'get' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'GET',
                'params' => null,
                'json' => null
            ],
            'post json' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'POST',
                'params' => [
                    "var" => 10230,
                    "type" => 2,
                    "date" => "01/01/2021",
                    "val" => 3.5
                ],
                'json' => true
            ],
            'post' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'POST',
                'params' => [
                    "var" => 10230,
                    "type" => 2,
                    "date" => "01/01/2021",
                    "val" => 3.5
                ],
                'json' => false
            ],
            'put' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700161?val=1.9&date=02/01/2020',
                'method' => 'PUT',
                'params' => null,
                'json' => null
            ],
            'patch' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700161?val=0.3&date=03/01/2020',
                'method' => 'PATCH',
                'params' => null,
                'json' => null
            ],
            'delete' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/999999999',
                'method' => 'DELETE',
                'params' => null,
                'json' => null
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group curl
     * @covers \vaniacarta74\Crud\Curl::set
     * @dataProvider setProvider     
     */
    public function testSetIsResource($url, $method, $params, $json)
    {
        $actual = is_resource(Curl::set($url, $method, $params, $json));
        
        $this->assertTrue($actual);
    }
    
    /**
     * @group curl
     * @coversNothing
     */
    public function setExceptionProvider()
    {
        $data = [
            'no string url' => [
                'url' => [],
                'method' => 'GET',
                'params' => null,
                'json' => null
            ],
            'no string method' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => [],
                'params' => null,
                'json' => null
            ],
            'wrong method' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'PIPPO',
                'params' => null,
                'json' => null
            ],
            'post no params' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'POST',
                'params' => null,
                'json' => null
            ],
            'post void params' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                'method' => 'POST',
                'params' => [],
                'json' => null
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group curl
     * @covers \vaniacarta74\Crud\Curl::set
     * @dataProvider setExceptionProvider
     */
    public function testSetException($url, $method, $params, $json)
    {
        $this->setExpectedException('Exception');
        
        Curl::set($url, $method, $params, $json);
    }
    
    /**
     * @group curl
     * @covers \vaniacarta74\Crud\Curl::exec
     */
    public function testExecException()
    {
        $ch = null;
        
        $this->setExpectedException('Exception');
        
        Curl::exec($ch);
    }
}
