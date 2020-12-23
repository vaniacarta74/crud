<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\tests\classes\Curl;

/**
 * Description of IndexTest
 *
 * @author Vania
 */
class IndexTest extends TestCase
{
    
    /**
     * coversNothing
     */
    public function indexJsonFileProvider()
    {
        $data = [
            'list datetime latin' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=2&datefrom=27/08/2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'provider' => 'sscpList.json'
            ],
            'list datetime anglo' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=2&datefrom=2017-08-27T00:00:00&dateto=2017-08-27T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'provider' => 'sscpList.json'
            ],
            'list datetime mixed' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=2&datefrom=27/08/2017T00:00:00&dateto=2017-08-27T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'provider' => 'sscpList.json'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group main
     * covers index.php
     * @dataProvider indexJsonFileProvider     
     */
    public function testIndexJsonStringEqualsJsonFile($url, $params, $json, $method, $provider)
    {
        $expected = __DIR__ . '/../providers/' . $provider;
        
        $actual = Curl::run($url, $params, $json, $method);
        
        $this->assertJsonStringEqualsJsonFile($expected, $actual);             
    }
    
    /**
     * coversNothing
     */
    public function indexJsonStringProvider()
    {
        $data = [
            'undefined' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok": false,
                    "codice errore": 400,
                    "descrizione errore": "Parametri url non presenti"
                }'
            ],
            'list no data' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=2&datefrom=27/08/2022T00:00:00&dateto=27/08/2022T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":true,
                    "method":"list",
                    "response":{
                        "message":"Nessun record trovato per i parametri indicati",
                        "records":[]
                    }
                }'
            ],
            'list bad date' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=2&datefrom=29/08/2022T00:00:00&dateto=27/08/2022T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":true,
                    "method":"list",
                    "response":{
                        "message":"Nessun record trovato per i parametri indicati",
                        "records":[]
                    }
                }'
            ],
            'list no param' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?type=2&datefrom=27/08/2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Parametro var necessario"
                }'
            ],
            'list no db' => [
                'url' => 'http://localhost/crud/api/pippo/dati_acquisiti?var=10230&type=2&datefrom=27/08/2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Nome db non trovato."
                }'
            ],
            'list bad table' => [
                'url' => 'http://localhost/crud/api/sscp/pippo?var=10230&type=2&datefrom=27/08/2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Nome tabella non trovato."
                }'
            ],
            'list no table' => [
                'url' => 'http://localhost/crud/api/sscp?var=10230&type=2&datefrom=27/08/2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Nome tabella non trovato."
                }'
            ],
            'list no check' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=pippo&type=2&datefrom=27/08/2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Formato parametro var non valido"
                }'
            ],
            'list param error' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?variabile=10230&type=2&datefrom=27/08/2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Parametro var necessario"
                }'
            ],
            'list no enum' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=9999&datefrom=27/08/2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Formato parametro type non valido"
                }'
            ],
            'list no smalldate' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=2&datefrom=27/08/2099T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Formato parametro datefrom non valido"
                }'
            ],
            'list bad date format' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=2&datefrom=27-08-2017T00:00:00&dateto=27/08/2017T01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Formato data non analizzabile. Utilizzare dd/mm/yyyy o yyyy-mm-dd"
                }'
            ],
            'list bad datetime format' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti?var=10230&type=2&datefrom=27/08/2017+00:00:00&dateto=27/08/2017+01:00:00',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok":false,
                    "codice errore":400,
                    "descrizione errore":"Formato data e ora non analizzabile. Utilizzare dd\/mm\/yyyyThh:mm:ss o yyyy-mm-ddThh:mm:ss"
                }'
            ],
            'read standard' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti/101700160',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok": true,
                    "method": "read",
                    "response": {
                        "message": "Record 101700160 caricato con successo",
                        "records": [
                            {
                                "id": "101700160",
                                "variabile": "10230",
                                "valore": "1.779999971389771",
                                "data_e_ora": "01/04/2019 06:16:00",
                                "tipo_dato": "2",
                                "link": "/sscp/dati_acquisiti/101700160"
                            }
                        ]
                    }
                }'
            ],
            'read not exist' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti/999999999999',
                'params' => null,
                'json' => false,
                'method' => 'GET',
                'expected' => '{
                    "ok": true,
                    "method": "read",
                    "response": {
                        "message": "Record 999999999999 non trovato",
                        "records": []
                    }
                }'
            ],
            'create standard' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti',
                'params' => [
                    "var" => 10230,
                    "type" => 2,
                    "date" => "01/01/2021",
                    "val" => 3.5
                ],
                'json' => true,
                'method' => 'POST',
                'expected' => '{
                    "ok": true,
                    "method": "create",
                    "response": {
                        "message": "Record 101700184 inserito con successo",
                        "link": "/sscp/dati_acquisiti/101700184"
                    }
                }'
            ],
            'create no param' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti',
                'params' => [
                    "type" => 2,
                    "date" => "01/01/2021",
                    "val" => 3.5
                ],
                'json' => true,
                'method' => 'POST',
                'expected' => '{
                    "ok": false,
                    "codice errore": 400,
                    "descrizione errore": "Parametro var necessario"
                }'
            ],
            'update put' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti/101700175?val=1.9&date=02/01/2020',
                'params' => null,
                'json' => false,
                'method' => 'PUT',
                'expected' => '{
                    "ok": true,
                    "method": "update",
                    "response": {
                        "message": "Record 101700175 aggiornato con successo",
                        "link": "/sscp/dati_acquisiti/101700175"
                    }
                }'
            ],
            'update patch' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti/101700177?val=0.3&date=03/01/2020',
                'params' => null,
                'json' => false,
                'method' => 'PATCH',
                'expected' => '{
                    "ok": true,
                    "method": "update",
                    "response": {
                        "message": "Record 101700177 aggiornato con successo",
                        "link": "/sscp/dati_acquisiti/101700177"
                    }
                }'
            ],
            'delete standard' => [
                'url' => 'http://localhost/crud/api/sscp/dati_acquisiti/101700184',
                'params' => null,
                'json' => false,
                'method' => 'DELETE',
                'expected' => '{
                    "ok": true,
                    "method": "delete",
                    "response": {
                        "message": "Record 101700184 cancellato con successo"
                    }
                }'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group main
     * covers index.php
     * @dataProvider indexJsonStringProvider     
     */
    public function testIndexJsonStringEqualsJsonString($url, $params, $json, $method, $expected)
    {
        $actual = Curl::run($url, $params, $json, $method);
        
        $this->assertJsonStringEqualsJsonString($expected, $actual);             
    }
}
