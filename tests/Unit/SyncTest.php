<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Sync;
use vaniacarta74\Crud\tests\classes\Reflections;

/**
 * Description of SyncTest
 *
 * @author Vania
 */
class SyncTest extends TestCase
{
    private $sync;
    
    protected function setUp()
    {
        $this->sync = new Sync();
    }
    
    protected function tearDown()
    {
        $this->sync = null;
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function constructorProvider()
    {
        $data = [
            'standard' => [
                'expecteds' => [
                    'varToSync' => [],
                    'targetLastRecords' => [],
                    'sourceNewRecords' => [],
                    'report' => [],
                    'response' => [
                        'ok' => false,
                        'codice errore' => 400,
                        'descrizione errore' => 'Nessuna variabile da sincronizzare trovata'
                    ]
                ]  
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::__construct
     * @dataProvider constructorProvider
     */
    public function testConstructorEquals($expected)
    {
        Reflections::invokeConstructor($this->sync);
        
        $actual['varToSync'] = Reflections::getProperty($this->sync, 'varToSync');
        $actual['targetLastRecords'] = Reflections::getProperty($this->sync, 'targetLastRecords');
        $actual['sourceNewRecords'] = Reflections::getProperty($this->sync, 'sourceNewRecords');
        $actual['report'] = Reflections::getProperty($this->sync, 'report');
        $actual['response'] = Reflections::getProperty($this->sync, 'response');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function runProvider()
    {
        $data = [
            'standard' => [
                'provider' => 'run.json'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::run
     * @dataProvider runProvider
     */
    public function testRunEquals($provider)
    {
        $this->sync->run();
        
        $properties['varToSync'] = Reflections::getProperty($this->sync, 'varToSync');
        $properties['targetLastRecords'] = Reflections::getProperty($this->sync, 'targetLastRecords');
        $properties['sourceNewRecords'] = Reflections::getProperty($this->sync, 'sourceNewRecords');
        $properties['report'] = Reflections::getProperty($this->sync, 'report');
        $properties['response'] = Reflections::getProperty($this->sync, 'response');
        
        $actual = json_encode($properties);
        
        $json = file_get_contents(__DIR__ . '/../providers/' . $provider);       
        $parts = explode('%', $json);
        
        foreach ($parts as $expected) {
            $position = strpos($actual, $expected);
            $this->assertTrue(is_int($position));
        }        
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function callCrudServiceProvider()
    {
        $data = [
            'read' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700160',
                'method' => 'GET',
                'params' => null,
                'json' => null,                
                'expected' => [
                    'message' => 'Record 101700160 caricato con successo',
                    'records' => [
                        0 => [
                            "id" => "101700160",
                            "variabile" => "10230",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "01/04/2019 06:16:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/sscp/dati_acquisiti/101700160"
                        ]
                    ]
                ]
            ],
            'update' => [
                'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700161?val=0.3&date=03/01/2020',
                'method' => 'PATCH',
                'params' => null,
                'json' => null,                
                'expected' => [
                    'message' => 'Record 101700161 aggiornato con successo',
                    'records' => []
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::callCrudService
     * @dataProvider callCrudServiceProvider     
     */
    public function testCallCrudServiceEquals($rawUrl, $method, $params, $json, $expected)
    {
        $actual = $this->sync->callCrudService($rawUrl, $method, $params, $json);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function callCrudServiceExceptionProvider()
    {
        $data = [
            'read exception' => [
                'url' => 'http://localhost/crud/api/h1/pippo/dati_acquisiti/999999999',
                'method' => 'GET',
                'params' => null,
                'json' => null
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::callCrudService
     * @dataProvider callCrudServiceExceptionProvider     
     */
    public function testCallCrudServiceException($rawUrl, $method, $params, $json)
    {
        $this->setExpectedException('Exception');
        
        $this->sync->callCrudService($rawUrl, $method, $params, $json);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setVarToSyncProvider()
    {
        $data = [
            'all different' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALL',
                'method' => null,
                'params' => null,
                'json' => null,
                'mockReturn' => [
                    'message' => 'Numero record caricati: 2',
                    'records' => [
                        0 => [
                            'codice' => 'SPT.9999.2'
                        ],
                        1 => [
                            'codice' => 'SPT.99999.2'
                        ]
                    ]
                ],
                'expected' => [
                    0 => 'SPT.9999.2',
                    1 => 'SPT.99999.2'
                ]
            ],
            'equal' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALL',
                'method' => null,
                'params' => null,
                'json' => null,
                'mockReturn' => [
                    'message' => 'Numero record caricati: 2',
                    'records' => [
                        0 => [
                            'codice' => 'SPT.99999.2'
                        ],
                        1 => [
                            'codice' => 'SPT.99999.2'
                        ]
                    ]
                ],
                'expected' => [
                    0 => 'SPT.99999.2'
                ]
            ],
            'no records' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALL',
                'method' => null,
                'params' => null,
                'json' => null,
                'mockReturn' => [
                    'message' => 'Numero record caricati: 0',
                    'records' => []
                ],
                'expected' => []
            ],
            'no records key' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALL',
                'method' => null,
                'params' => null,
                'json' => null,
                'mockReturn' => [
                    'message' => 'Numero record caricati: 2',
                    'dati' => [
                        0 => [
                            'codice' => 'SPT.99999.2'
                        ],
                        1 => [
                            'codice' => 'SPT.99999.2'
                        ]
                    ]
                ],
                'expected' => []
            ],
            'error' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALLs',
                'method' => null,
                'params' => null,
                'json' => null,
                'mockReturn' => [
                    'ok' => false,
                    'codice errore' => 400,
                    'descrizione errore' => 'Id non definito correttamente.'
                ],
                'expected' => []
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setVarToSync
     * @dataProvider setVarToSyncProvider     
     */
    public function testSetVarToSyncEquals($rawUrl, $method, $params, $json, $mockReturn, $expected)
    {
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('callCrudService'))
                     ->getMock();
        
        $stub->expects($this->any())
             ->method('callCrudService')
             ->with($rawUrl, $method, $params, $json)
             ->will($this->returnValue($mockReturn));
        
        $stub->setVarToSync();
        $actual = $stub->getVarToSync();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setVarToSyncExceptionProvider()
    {
        $data = [            
            'no codie key' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALL',
                'method' => null,
                'params' => null,
                'json' => null,
                'mockReturn' => [
                    'message' => 'Numero record caricati: 2',
                    'records' => [
                        0 => [
                            'pippo' => 'SPT.99999.2'
                        ],
                        1 => [
                            'codice' => 'SPT.99999.2'
                        ]
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setVarToSync
     * @dataProvider setVarToSyncExceptionProvider     
     */
    public function testSetVarToSyncException($rawUrl, $method, $params, $json, $mockReturn)
    {
        $this->setExpectedException('Exception');
        
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('callCrudService'))
                     ->getMock();
        
        $stub->expects($this->any())
             ->method('callCrudService')
             ->with($rawUrl, $method, $params, $json)
             ->will($this->returnValue($mockReturn));
        
        $stub->setVarToSync();
    } 
    
    /**
     * @group sync
     * @coversNothing
     */
    public function getTargetAllMaxDatesProvider()
    {
        $data = [
            'all standard' => [
                'params' => [
                    'spt' => [
                        'url' => 'http://localhost/crud/api/h2/spt/vista_variabili_maxdata/ALL',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 2',
                            'records' => [
                                0 => [
                                    'codice' => 'SPT.100025.2',
                                    'data_e_ora' => '29/05/2020 22:00:00'
                                ],
                                1 => [
                                    'codice' => 'SPT.10020.2',
                                    'data_e_ora' => '18/02/2020 11:45:00'
                                ]
                            ]
                        ]
                    ],
                    'sscp' => [
                        'url' => 'http://localhost/crud/api/h2/sscp/vista_variabili_maxdata/ALL',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 2',
                            'records' => [
                                0 => [
                                    'codice' => 'SSCP_data.1.2',
                                    'data_e_ora' => '30/01/2007 08:12:00'
                                ],
                                1 => [
                                    'codice' => 'SSCP_data.10.2',
                                    'data_e_ora' => '16/04/2015 12:23:00'
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    0 => [
                        'codice' => 'SPT.100025.2',
                        'data_e_ora' => '29/05/2020 22:00:00'
                    ],
                    1 => [
                        'codice' => 'SPT.10020.2',
                        'data_e_ora' => '18/02/2020 11:45:00'
                    ],
                    2 => [
                        'codice' => 'SSCP_data.1.2',
                        'data_e_ora' => '30/01/2007 08:12:00'
                    ],
                    3 => [
                        'codice' => 'SSCP_data.10.2',
                        'data_e_ora' => '16/04/2015 12:23:00'
                    ]
                ]
            ],
            'spt wrong' => [
                'params' => [
                    'spt' => [
                        'url' => 'http://localhost/crud/api/h2/spt/vista_variabili_maxdata/ALL',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 2',
                            'pippo' => [
                                0 => [
                                    'codice' => 'SPT.100025.2',
                                    'data_e_ora' => '29/05/2020 22:00:00'
                                ],
                                1 => [
                                    'codice' => 'SPT.10020.2',
                                    'data_e_ora' => '18/02/2020 11:45:00'
                                ]
                            ]
                        ]
                    ],
                    'sscp' => [
                        'url' => 'http://localhost/crud/api/h2/sscp/vista_variabili_maxdata/ALL',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 2',
                            'records' => [
                                0 => [
                                    'codice' => 'SSCP_data.1.2',
                                    'data_e_ora' => '30/01/2007 08:12:00'
                                ],
                                1 => [
                                    'codice' => 'SSCP_data.10.2',
                                    'data_e_ora' => '16/04/2015 12:23:00'
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    0 => [
                        'codice' => 'SSCP_data.1.2',
                        'data_e_ora' => '30/01/2007 08:12:00'
                    ],
                    1 => [
                        'codice' => 'SSCP_data.10.2',
                        'data_e_ora' => '16/04/2015 12:23:00'
                    ]
                ]
            ],
            'sscp wrong' => [
                'params' => [
                    'spt' => [
                        'url' => 'http://localhost/crud/api/h2/spt/vista_variabili_maxdata/ALL',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 2',
                            'records' => [
                                0 => [
                                    'codice' => 'SPT.100025.2',
                                    'data_e_ora' => '29/05/2020 22:00:00'
                                ],
                                1 => [
                                    'codice' => 'SPT.10020.2',
                                    'data_e_ora' => '18/02/2020 11:45:00'
                                ]
                            ]
                        ]
                    ],
                    'sscp' => [
                        'url' => 'http://localhost/crud/api/h2/sscp/vista_variabili_maxdata/ALL',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 2',
                            'pippo' => [
                                0 => [
                                    'codice' => 'SSCP_data.1.2',
                                    'data_e_ora' => '30/01/2007 08:12:00'
                                ],
                                1 => [
                                    'codice' => 'SSCP_data.10.2',
                                    'data_e_ora' => '16/04/2015 12:23:00'
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    0 => [
                        'codice' => 'SPT.100025.2',
                        'data_e_ora' => '29/05/2020 22:00:00'
                    ],
                    1 => [
                        'codice' => 'SPT.10020.2',
                        'data_e_ora' => '18/02/2020 11:45:00'
                    ]
                ]
            ],
            'all wrong' => [
                'params' => [
                    'spt' => [
                        'url' => 'http://localhost/crud/api/h2/spt/vista_variabili_maxdata/ALL',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 2',
                            'pippo' => [
                                0 => [
                                    'codice' => 'SPT.100025.2',
                                    'data_e_ora' => '29/05/2020 22:00:00'
                                ],
                                1 => [
                                    'codice' => 'SPT.10020.2',
                                    'data_e_ora' => '18/02/2020 11:45:00'
                                ]
                            ]
                        ]
                    ],
                    'sscp' => [
                        'url' => 'http://localhost/crud/api/h2/sscp/vista_variabili_maxdata/ALL',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 2',
                            'pippo' => [
                                0 => [
                                    'codice' => 'SSCP_data.1.2',
                                    'data_e_ora' => '30/01/2007 08:12:00'
                                ],
                                1 => [
                                    'codice' => 'SSCP_data.10.2',
                                    'data_e_ora' => '16/04/2015 12:23:00'
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => []
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::getTargetAllMaxDates
     * @dataProvider getTargetAllMaxDatesProvider     
     */
    public function testGetTargetAllMaxDatesEquals($params, $expected)
    {
        $spt = $params['spt'];
        $sscp = $params['sscp'];
        
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('callCrudService'))
                     ->getMock();
        
        $stub->expects($this->at(0))
             ->method('callCrudService')
             ->with($spt['url'], $spt['method'], $spt['params'], $spt['json'])
             ->will($this->returnValue($spt['mockReturn']));
        
        $stub->expects($this->at(1))
             ->method('callCrudService')
             ->with($sscp['url'], $sscp['method'], $sscp['params'], $sscp['json'])
             ->will($this->returnValue($sscp['mockReturn']));
        
        $actual = $stub->getTargetAllMaxDates();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function getTargetVarMaxDatesProvider()
    {
        $data = [
            'standard' => [
                'distinct' => [
                    0 => 'SPT.100025.2',
                    1 => 'SSCP_data.10.2'
                ],
                'maxData' => [
                    0 => [
                        'codice' => 'SPT.100025.2',
                        'data_e_ora' => '29/05/2020 22:00:00'
                    ],
                    1 => [
                        'codice' => 'SPT.10020.2',
                        'data_e_ora' => '18/02/2020 11:45:00'
                    ],
                    2 => [
                        'codice' => 'SSCP_data.1.2',
                        'data_e_ora' => '30/01/2007 08:12:00'
                    ],
                    3 => [
                        'codice' => 'SSCP_data.10.2',
                        'data_e_ora' => '16/04/2015 12:23:00'
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ]
            ],
            'no distinct' => [
                'distinct' => [],
                'maxData' => [
                    0 => [
                        'codice' => 'SPT.100025.2',
                        'data_e_ora' => '29/05/2020 22:00:00'
                    ],
                    1 => [
                        'codice' => 'SPT.10020.2',
                        'data_e_ora' => '18/02/2020 11:45:00'
                    ],
                    2 => [
                        'codice' => 'SSCP_data.1.2',
                        'data_e_ora' => '30/01/2007 08:12:00'
                    ],
                    3 => [
                        'codice' => 'SSCP_data.10.2',
                        'data_e_ora' => '16/04/2015 12:23:00'
                    ]
                ],
                'expected' => []
            ],
            'no maxdata' => [
                'distinct' => [
                    0 => 'SPT.100025.2',
                    1 => 'SSCP_data.10.2'
                ],
                'maxData' => [],
                'expected' => []
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::getTargetVarMaxDates
     * @dataProvider getTargetVarMaxDatesProvider     
     */
    public function testGetTargetVarMaxDatesEquals($distinct, $maxData, $expected)
    {
        $actual = $this->sync->getTargetVarMaxDates($distinct, $maxData);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function getTargetVarMaxDatesExceptionProvider()
    {
        $data = [
            'no codice maxdata' => [
                'distinct' => [
                    0 => 'SPT.100025.2',
                    1 => 'SSCP_data.10.2'
                ],
                'maxData' => [
                    0 => [
                        'codice' => 'SPT.100025.2',
                        'data_e_ora' => '29/05/2020 22:00:00'
                    ],
                    1 => [
                        'pippo' => 'SPT.10020.2',
                        'data_e_ora' => '18/02/2020 11:45:00'
                    ],
                    2 => [
                        'codice' => 'SSCP_data.1.2',
                        'data_e_ora' => '30/01/2007 08:12:00'
                    ],
                    3 => [
                        'codice' => 'SSCP_data.10.2',
                        'data_e_ora' => '16/04/2015 12:23:00'
                    ]
                ]
            ],
            'no data maxdata' => [
                'distinct' => [
                    0 => 'SPT.100025.2',
                    1 => 'SSCP_data.10.2'
                ],
                'maxData' => [
                    0 => [
                        'codice' => 'SPT.100025.2',
                        'pippo' => '29/05/2020 22:00:00'
                    ],
                    1 => [
                        'pippo' => 'SPT.10020.2',
                        'data_e_ora' => '18/02/2020 11:45:00'
                    ],
                    2 => [
                        'codice' => 'SSCP_data.1.2',
                        'data_e_ora' => '30/01/2007 08:12:00'
                    ],
                    3 => [
                        'codice' => 'SSCP_data.10.2',
                        'data_e_ora' => '16/04/2015 12:23:00'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::getTargetVarMaxDates
     * @dataProvider getTargetVarMaxDatesExceptionProvider     
     */
    public function testGetTargetVarMaxDatesException($distinct, $maxData)
    {
        $this->setExpectedException('Exception');
        
        $this->sync->getTargetVarMaxDates($distinct, $maxData);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function listSourceNewRecordsProvider()
    {
        $data = [
            'all standard' => [
                'distData' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ],
                'params' => [
                    0 => [
                        'url' => 'http://localhost/crud/api/h1/spt/dati_acquisiti?var=100025&type=2&datefrom=29/05/2020T22:00:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 1',
                            'records' => [
                                0 => [
                                    "id" => "101700160",
                                    "variabile" => "100025",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "29/05/2020 23:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/spt/dati_acquisiti/101700160"
                                ]
                            ]
                        ]
                    ],
                    1 => [
                        'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti?var=10&type=2&datefrom=16/04/2015T12:23:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 1',
                            'records' => [
                                0 => [
                                    "id" => "101500160",
                                    "variabile" => "10",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "16/04/2015 13:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/sscp/dati_acquisiti/101500160"
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [
                        0 => [
                            "id" => "101700160",
                            "variabile" => "100025",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "29/05/2020 23:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/spt/dati_acquisiti/101700160"
                        ]
                    ],
                    'SSCP_data.10.2' => [
                        0 => [
                            "id" => "101500160",
                            "variabile" => "10",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "16/04/2015 13:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/sscp/dati_acquisiti/101500160"
                        ]
                    ]
                ]
            ],
            'no spt data' => [
                'distData' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ],
                'params' => [
                    0 => [
                        'url' => 'http://localhost/crud/api/h1/spt/dati_acquisiti?var=100025&type=2&datefrom=29/05/2020T22:00:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 0',
                            'records' => []
                        ]
                    ],
                    1 => [
                        'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti?var=10&type=2&datefrom=16/04/2015T12:23:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 1',
                            'records' => [
                                0 => [
                                    "id" => "101500160",
                                    "variabile" => "10",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "16/04/2015 13:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/sscp/dati_acquisiti/101500160"
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [],
                    'SSCP_data.10.2' => [
                        0 => [
                            "id" => "101500160",
                            "variabile" => "10",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "16/04/2015 13:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/sscp/dati_acquisiti/101500160"
                        ]
                    ]
                ]
            ],
            'no sscp data' => [
                'distData' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ],
                'params' => [
                    0 => [
                        'url' => 'http://localhost/crud/api/h1/spt/dati_acquisiti?var=100025&type=2&datefrom=29/05/2020T22:00:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 1',
                            'records' => [
                                0 => [
                                    "id" => "101700160",
                                    "variabile" => "100025",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "29/05/2020 23:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/spt/dati_acquisiti/101700160"
                                ]
                            ]
                        ]
                    ],
                    1 => [
                        'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti?var=10&type=2&datefrom=16/04/2015T12:23:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 0',
                            'records' => []
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [
                        0 => [
                            "id" => "101700160",
                            "variabile" => "100025",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "29/05/2020 23:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/spt/dati_acquisiti/101700160"
                        ]
                    ],
                    'SSCP_data.10.2' => []
                ]
            ],
            'no data' => [
                'distData' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ],
                'params' => [
                    0 => [
                        'url' => 'http://localhost/crud/api/h1/spt/dati_acquisiti?var=100025&type=2&datefrom=29/05/2020T22:00:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 0',
                            'records' => []
                        ]
                    ],
                    1 => [
                        'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti?var=10&type=2&datefrom=16/04/2015T12:23:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 0',
                            'records' => []
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [],
                    'SSCP_data.10.2' => []
                ]
            ],
            'wrong response' => [
                'distData' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ],
                'params' => [
                    0 => [
                        'url' => 'http://localhost/crud/api/h1/spt/dati_acquisiti?var=100025&type=2&datefrom=29/05/2020T22:00:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 1',
                            'pippo' => [
                                0 => [
                                    "id" => "101700160",
                                    "variabile" => "100025",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "29/05/2020 23:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/spt/dati_acquisiti/101700160"
                                ]
                            ]
                        ]
                    ],
                    1 => [
                        'url' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti?var=10&type=2&datefrom=16/04/2015T12:23:00&dateto=',
                        'method' => null,
                        'params' => null,
                        'json' => null,
                        'mockReturn' => [
                            'message' => 'Numero record caricati: 1',
                            'records' => [
                                0 => [
                                    "id" => "101500160",
                                    "variabile" => "10",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "16/04/2015 13:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/sscp/dati_acquisiti/101500160"
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [],
                    'SSCP_data.10.2' => [
                        0 => [
                            "id" => "101500160",
                            "variabile" => "10",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "16/04/2015 13:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/sscp/dati_acquisiti/101500160"
                        ]
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::listSourceNewRecords
     * @dataProvider listSourceNewRecordsProvider     
     */
    public function testListSourceNewRecordsEquals($distData, $params, $expected)
    {
        $index0 = $params[0];
        $index1 = $params[1];
        $data_finale = str_replace(' ', 'T', date('Y-m-d H:i:s'));
        
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('callCrudService'))
                     ->getMock();
        
        $stub->expects($this->at(0))
             ->method('callCrudService')
             ->with($index0['url'] . $data_finale, $index0['method'], $index0['params'], $index0['json'])
             ->will($this->returnValue($index0['mockReturn']));
        
        $stub->expects($this->at(1))
             ->method('callCrudService')
             ->with($index1['url'] . $data_finale, $index1['method'], $index1['params'], $index1['json'])
             ->will($this->returnValue($index1['mockReturn']));
        
        $actual = $stub->listSourceNewRecords($distData);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function insertTargetRecordsProvider()
    {
        $data = [
            'inserted' => [
                'newData' => [
                    'SPT.100025.2' => [
                        0 => [
                            "id" => "101700160",
                            "variabile" => "100025",
                            "valore" => "1.8",
                            "data_e_ora" => "29/05/2020 23:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/spt/dati_acquisiti/101700160"
                        ]
                    ],
                    'SSCP_data.10.2' => []
                ],
                'params' => [                    
                    'url' => 'http://localhost/crud/api/h2/spt/dati_acquisiti',
                    'method' => 'POST',
                    'params' => [
                        "var" => "100025",
                        "type" => "2",                        
                        "date" => "29/05/2020T23:00:00",
                        "val" => "1.8"                        
                    ],
                    'json' => null,
                    'mockReturn' => [
                        "message" => "Record 999999999 inserito con successo",
                        'records' => []
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [
                        'inserted' => 1,
                        'failed' => 0
                    ],
                    'SSCP_data.10.2' => [
                        'inserted' => 0,
                        'failed' => 0
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::insertTargetRecords
     * @dataProvider insertTargetRecordsProvider     
     */
    public function testInsertTargetRecordsEquals($newData, $params, $expected)
    {
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('callCrudService'))
                     ->getMock();
        
        $stub->expects($this->once())
             ->method('callCrudService')
             ->with($params['url'], $params['method'], $params['params'], $params['json'])
             ->will($this->returnValue($params['mockReturn']));
        
        $actual = $stub->insertTargetRecords($newData);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function insertTargetRecordsExceptionProvider()
    {
        $data = [
            'failed' => [
                'newData' => [
                    'SPT.100025.2' => [
                        0 => [
                            "id" => "101700160",
                            "variabile" => "100025",
                            "valore" => "1.8",
                            "data_e_ora" => "32/05/2020 23:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/spt/dati_acquisiti/101700160"
                        ]
                    ],
                    'SSCP_data.10.2' => []
                ],
                'params' => [                    
                    'url' => 'http://localhost/crud/api/h2/spt/dati_acquisiti',
                    'method' => 'POST',
                    'params' => [
                        "var" => "100025",
                        "type" => "2",                        
                        "date" => "32/05/2020T23:00:00",
                        "val" => "1.8"                        
                    ],
                    'json' => null
                ],
                'expected' => [
                    'SPT.100025.2' => [
                        'inserted' => 0,
                        'failed' => 1
                    ],
                    'SSCP_data.10.2' => [
                        'inserted' => 0,
                        'failed' => 0
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::insertTargetRecords
     * @dataProvider insertTargetRecordsExceptionProvider     
     */
    public function testInsertTargetRecordsExceptionEquals($newData, $params, $expected)
    {
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('callCrudService'))
                     ->getMock();
        
        $stub->expects($this->once())
             ->method('callCrudService')
             ->with($params['url'], $params['method'], $params['params'], $params['json'])
             ->will($this->throwException(new \Exception()));
        
        $actual = $stub->insertTargetRecords($newData);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setResponseProvider()
    {
        $data = [
            'standard' => [
                'param' => [
                    'SPT.100025.2' => [
                        'inserted' => 1,
                        'failed' => 0
                    ],
                    'SSCP_data.10.2' => [
                        'inserted' => 0,
                        'failed' => 0
                    ]
                ],
                'resInsertData' => [
                    'SPT.100025.2' => [
                        'inserted' => 1,
                        'failed' => 0
                    ],
                    'SSCP_data.10.2' => [
                        'inserted' => 0,
                        'failed' => 0
                    ]
                ],
                'expected' => [
                    'ok' => true,
                    'message' => 'Sincronizzazione ' . MSSQL_HOST . ' => ' . MSSQL_HOST2 . ' avvenuta con successo in: % sec. Record inseriti: 1',
                    'variabili' => [
                        'SPT.100025.2' => 'records 1 | riusciti 1 | falliti 0',
                        'SSCP_data.10.2' => 'records 0 | riusciti 0 | falliti 0'
                    ]
                ]
            ],
            'no param' => [
                'param' => null,
                'resInsertData' => [
                    'SPT.100025.2' => [
                        'inserted' => 1,
                        'failed' => 0
                    ],
                    'SSCP_data.10.2' => [
                        'inserted' => 0,
                        'failed' => 0
                    ]
                ],
                'expected' => [
                    'ok' => true,
                    'message' => 'Sincronizzazione ' . MSSQL_HOST . ' => ' . MSSQL_HOST2 . ' avvenuta con successo in: % sec. Record inseriti: 1',
                    'variabili' => [
                        'SPT.100025.2' => 'records 1 | riusciti 1 | falliti 0',
                        'SSCP_data.10.2' => 'records 0 | riusciti 0 | falliti 0'
                    ]
                ]
            ],
            'failed' => [
                'param' => null,
                'resInsertData' => [],
                'expected' => [
                    'ok' => false,
                    'codice errore' => 400,
                    'descrizione errore' => 'Nessuna variabile da sincronizzare trovata'
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setResponse
     * @dataProvider setResponseProvider     
     */
    public function testSetResponseEquals($param, $resInsertData, $expecteds)
    {
        Reflections::setProperty($this->sync, 'report', $resInsertData);
        $this->sync->setResponse($param);
        $actuals = $this->sync->getResponse();
        
        foreach ($expecteds as $key => $responsePart) {
            if ($key === 'message') {
                $parts = explode('%', $responsePart);
                foreach ($parts as $expected) {
                    $actual = strpos($actuals[$key], $expected);
                    $this->assertTrue(is_int($actual));
                }
            } else {
                $this->assertEquals($responsePart, $actuals[$key]);
            }
        }        
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setResponseExceptionProvider()
    {
        $data = [
            'wrong param' => [
                'param' => 'pippo',
                'resInsertData' => [
                    'SPT.100025.2' => [
                        'inserted' => 1,
                        'failed' => 0
                    ],
                    'SSCP_data.10.2' => [
                        'inserted' => 0,
                        'failed' => 0
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setResponse
     * @dataProvider setResponseExceptionProvider     
     */
    public function testSetResponseException($param, $resInsertData)
    {
        $this->setExpectedException('Exception');
        
        Reflections::setProperty($this->sync, 'report', $resInsertData);
        $this->sync->setResponse($param);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function getVariabiliProvider()
    {
        $data = [
            'standard' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALL',
                'method' => null,
                'params' => null,
                'json' => null,
                'mockReturn' => [
                    'message' => 'Numero record caricati: 2',
                    'records' => [
                        0 => [
                            'codice' => 'SPT.9999.2'
                        ],
                        1 => [
                            'codice' => 'SPT.99999.2'
                        ]
                    ]
                ],
                'expected' => [
                    0 => [
                        'codice' => 'SPT.9999.2'
                    ],
                    1 => [
                        'codice' => 'SPT.99999.2'
                    ]
                ]
            ],
            'wrong response' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALL',
                'method' => null,
                'params' => null,
                'json' => null,
                'mockReturn' => [
                    'message' => 'Numero record caricati: 2',
                    'pippo' => [
                        0 => [
                            'codice' => 'SPT.9999.2'
                        ],
                        1 => [
                            'codice' => 'SPT.99999.2'
                        ]
                    ]
                ],
                'expected' => []
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::getVariabili
     * @dataProvider getVariabiliProvider     
     */
    public function testGetVariabiliEquals($rawUrl, $method, $params, $json, $mockReturn, $expected)
    {
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('callCrudService'))
                     ->getMock();
        
        $stub->expects($this->any())
             ->method('callCrudService')
             ->with($rawUrl, $method, $params, $json)
             ->will($this->returnValue($mockReturn));
        
        $actual = $stub->getVariabili($rawUrl);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function getVariabiliExceptionProvider()
    {
        $data = [            
            'exception' => [
                'url' => 'http://localhost/crud/api/h1/core/variabili_sync/ALL',
                'method' => null,
                'params' => null,
                'json' => null,
                'expected' => []
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::getVariabili
     * @dataProvider getVariabiliExceptionProvider     
     */
    public function testGetVariabiliExceptionEquals($rawUrl, $method, $params, $json, $expected)
    {
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('callCrudService'))
                     ->getMock();
        
        $stub->expects($this->any())
             ->method('callCrudService')
             ->with($rawUrl, $method, $params, $json)
             ->will($this->throwException(new \Exception()));
        
        $actual = $stub->getVariabili($rawUrl);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function getDistinctVarProvider()
    {
        $data = [
            'standard' => [
                'variabili' => [
                    0 => [
                        'codice' => 'SPT.9999.2'
                    ],
                    1 => [
                        'codice' => 'SPT.99999.2'
                    ]
                ],
                'expected' => [
                    0 => 'SPT.9999.2',
                    1 => 'SPT.99999.2'
                ]
            ],
            'no variabili' => [
                'variabili' => [],
                'expected' => []
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::getDistinctVar
     * @dataProvider getDistinctVarProvider     
     */
    public function testGetDistinctVarEquals($variabili, $expected)
    {
        $actual = $this->sync->getDistinctVar($variabili);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function getDistinctVarExceptionProvider()
    {
        $data = [            
            'no codice key' => [
                'variabili' => [
                    0 => [
                        'pippo' => 'SPT.9999.2'
                    ],
                    1 => [
                        'codice' => 'SPT.99999.2'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::getDistinctVar
     * @dataProvider getDistinctVarExceptionProvider     
     */
    public function testGetDistinctVarException($variabili)
    {
        $this->setExpectedException('Exception');
        
        $this->sync->getDistinctVar($variabili);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setTargetLastRecordsProvider()
    {
        $data = [
            'standard' => [
                'param' => null,
                'mockParams' => [
                    'all' => [
                        'mockReturn' => [                            
                            0 => [
                                'codice' => 'SPT.100025.2',
                                'data_e_ora' => '29/05/2020 22:00:00'
                            ],
                            1 => [
                                'codice' => 'SPT.10020.2',
                                'data_e_ora' => '18/02/2020 11:45:00'
                            ],
                            2 => [
                                'codice' => 'SSCP_data.1.2',
                                'data_e_ora' => '30/01/2007 08:12:00'
                            ],
                            3 => [
                                'codice' => 'SSCP_data.10.2',
                                'data_e_ora' => '16/04/2015 12:23:00'
                            ]                
                        ]
                    ],
                    'var' => [
                        'varToSync' => [
                            0 => 'SPT.100025.2',
                            1 => 'SSCP_data.10.2'
                        ],
                        'maxData' => [                            
                            0 => [
                                'codice' => 'SPT.100025.2',
                                'data_e_ora' => '29/05/2020 22:00:00'
                            ],
                            1 => [
                                'codice' => 'SPT.10020.2',
                                'data_e_ora' => '18/02/2020 11:45:00'
                            ],
                            2 => [
                                'codice' => 'SSCP_data.1.2',
                                'data_e_ora' => '30/01/2007 08:12:00'
                            ],
                            3 => [
                                'codice' => 'SSCP_data.10.2',
                                'data_e_ora' => '16/04/2015 12:23:00'
                            ]                
                        ],
                        'mockReturn' => [
                            'SPT.100025.2' => '29/05/2020 22:00:00',
                            'SSCP_data.10.2' => '16/04/2015 12:23:00'
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ]
            ],
            'no var to sync' => [
                'param' => null,
                'mockParams' => [
                    'all' => [
                        'mockReturn' => [                            
                            0 => [
                                'codice' => 'SPT.100025.2',
                                'data_e_ora' => '29/05/2020 22:00:00'
                            ],
                            1 => [
                                'codice' => 'SPT.10020.2',
                                'data_e_ora' => '18/02/2020 11:45:00'
                            ],
                            2 => [
                                'codice' => 'SSCP_data.1.2',
                                'data_e_ora' => '30/01/2007 08:12:00'
                            ],
                            3 => [
                                'codice' => 'SSCP_data.10.2',
                                'data_e_ora' => '16/04/2015 12:23:00'
                            ]                
                        ]
                    ],
                    'var' => [
                        'varToSync' => [],
                        'maxData' => [                            
                            0 => [
                                'codice' => 'SPT.100025.2',
                                'data_e_ora' => '29/05/2020 22:00:00'
                            ],
                            1 => [
                                'codice' => 'SPT.10020.2',
                                'data_e_ora' => '18/02/2020 11:45:00'
                            ],
                            2 => [
                                'codice' => 'SSCP_data.1.2',
                                'data_e_ora' => '30/01/2007 08:12:00'
                            ],
                            3 => [
                                'codice' => 'SSCP_data.10.2',
                                'data_e_ora' => '16/04/2015 12:23:00'
                            ]                
                        ],
                        'mockReturn' => [
                            'SPT.100025.2' => '29/05/2020 22:00:00',
                            'SSCP_data.10.2' => '16/04/2015 12:23:00'
                        ]
                    ]
                ],
                'expected' => []
            ],
            'param not null' => [
                'param' => [
                    0 => 'SPT.100025.2',
                    1 => 'SSCP_data.10.2'
                ],
                'mockParams' => [
                    'all' => [
                        'mockReturn' => [                            
                            0 => [
                                'codice' => 'SPT.100025.2',
                                'data_e_ora' => '29/05/2020 22:00:00'
                            ],
                            1 => [
                                'codice' => 'SPT.10020.2',
                                'data_e_ora' => '18/02/2020 11:45:00'
                            ],
                            2 => [
                                'codice' => 'SSCP_data.1.2',
                                'data_e_ora' => '30/01/2007 08:12:00'
                            ],
                            3 => [
                                'codice' => 'SSCP_data.10.2',
                                'data_e_ora' => '16/04/2015 12:23:00'
                            ]                
                        ]
                    ],
                    'var' => [
                        'varToSync' => [
                            0 => 'SPT.100025.2',
                            1 => 'SSCP_data.10.2'
                        ],
                        'maxData' => [                            
                            0 => [
                                'codice' => 'SPT.100025.2',
                                'data_e_ora' => '29/05/2020 22:00:00'
                            ],
                            1 => [
                                'codice' => 'SPT.10020.2',
                                'data_e_ora' => '18/02/2020 11:45:00'
                            ],
                            2 => [
                                'codice' => 'SSCP_data.1.2',
                                'data_e_ora' => '30/01/2007 08:12:00'
                            ],
                            3 => [
                                'codice' => 'SSCP_data.10.2',
                                'data_e_ora' => '16/04/2015 12:23:00'
                            ]                
                        ],
                        'mockReturn' => [
                            'SPT.100025.2' => '29/05/2020 22:00:00',
                            'SSCP_data.10.2' => '16/04/2015 12:23:00'
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setTargetLastRecords
     * @dataProvider setTargetLastRecordsProvider     
     */
    public function testSetTargetLastRecordsEquals($param, $mockParams, $expected)
    {
        $all = $mockParams['all'];
        $var = $mockParams['var'];
        
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('getTargetAllMaxDates', 'getTargetVarMaxDates'))
                     ->getMock();
        
        $stub->expects($this->any())
             ->method('getTargetAllMaxDates')
             ->will($this->returnValue($all['mockReturn']));
        
        $stub->expects($this->any())
             ->method('getTargetVarMaxDates')
             ->with($var['varToSync'], $var['maxData'])
             ->will($this->returnValue($var['mockReturn']));
        
        Reflections::setProperty($stub, 'varToSync', $var['varToSync']);
        $stub->setTargetLastRecords($param);
        $actual = $stub->getTargetLastRecords();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setTargetLastRecordsExceptionProvider()
    {
        $data = [            
            'wrong param' => [
                'param' => 'pippo'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setTargetLastRecords
     * @dataProvider setTargetLastRecordsExceptionProvider     
     */
    public function testSetTargetLastRecordsException($param)
    {
        $this->setExpectedException('Exception');
        
        $this->sync->setTargetLastRecords($param);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setSourceNewRecordsProvider()
    {
        $data = [
            'standard' => [
                'param' => null,
                'mockParams' => [
                    'list' => [
                        'targetLastRecords' => [
                            'SPT.100025.2' => '29/05/2020 22:00:00',
                            'SSCP_data.10.2' => '16/04/2015 12:23:00'
                        ],
                        'mockReturn' => [
                            'SPT.100025.2' => [],
                            'SSCP_data.10.2' => [
                                0 => [
                                    "id" => "101500160",
                                    "variabile" => "10",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "16/04/2015 13:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/sscp/dati_acquisiti/101500160"
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [],
                    'SSCP_data.10.2' => [
                        0 => [
                            "id" => "101500160",
                            "variabile" => "10",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "16/04/2015 13:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/sscp/dati_acquisiti/101500160"
                        ]
                    ]
                ]
            ],
            'array void' => [
                'param' => null,
                'mockParams' => [
                    'list' => [
                        'targetLastRecords' => [],
                        'mockReturn' => []
                    ]
                ],
                'expected' => []
            ],
            'param no null' => [
                'param' => [
                    'SPT.100025.2' => '29/05/2020 22:00:00',
                    'SSCP_data.10.2' => '16/04/2015 12:23:00'
                ],
                'mockParams' => [
                    'list' => [
                        'targetLastRecords' => [
                            'SPT.100025.2' => '29/05/2020 22:00:00',
                            'SSCP_data.10.2' => '16/04/2015 12:23:00'
                        ],
                        'mockReturn' => [
                            'SPT.100025.2' => [],
                            'SSCP_data.10.2' => [
                                0 => [
                                    "id" => "101500160",
                                    "variabile" => "10",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "16/04/2015 13:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/sscp/dati_acquisiti/101500160"
                                ]
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [],
                    'SSCP_data.10.2' => [
                        0 => [
                            "id" => "101500160",
                            "variabile" => "10",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "16/04/2015 13:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/sscp/dati_acquisiti/101500160"
                        ]
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setSourceNewRecords
     * @dataProvider setSourceNewRecordsProvider     
     */
    public function testSetSourceNewRecordsEquals($param, $mockParams, $expected)
    {
        $list = $mockParams['list'];
        
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('listSourceNewRecords'))
                     ->getMock();
        
        $stub->expects($this->any())
             ->method('listSourceNewRecords')
             ->with($list['targetLastRecords'])
             ->will($this->returnValue($list['mockReturn']));
        
        Reflections::setProperty($stub, 'targetLastRecords', $list['targetLastRecords']);
        $stub->setSourceNewRecords($param);
        $actual = $stub->getSourceNewRecords();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setSourceNewRecordsExceptionProvider()
    {
        $data = [            
            'wrong param' => [
                'param' => 'pippo'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setSourceNewRecords
     * @dataProvider setSourceNewRecordsExceptionProvider     
     */
    public function testSetSourceNewRecordsException($param)
    {
        $this->setExpectedException('Exception');
        
        $this->sync->setSourceNewRecords($param);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setReportProvider()
    {
        $data = [
            'standard' => [
                'param' => null,
                'mockParams' => [
                    'insert' => [
                        'sourceNewRecords' => [
                            'SPT.100025.2' => [],
                            'SSCP_data.10.2' => [
                                0 => [
                                    "id" => "101500160",
                                    "variabile" => "10",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "16/04/2015 13:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/sscp/dati_acquisiti/101500160"
                                ]
                            ]
                        ],
                        'mockReturn' => [
                            'SPT.100025.2' => [
                                'inserted' => 0,
                                'failed' => 0
                            ],
                            'SSCP_data.10.2' => [
                                'inserted' => 1,
                                'failed' => 0
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [
                        'inserted' => 0,
                        'failed' => 0
                    ],
                    'SSCP_data.10.2' => [
                        'inserted' => 1,
                        'failed' => 0
                    ]
                ]
            ],
            'array void' => [
                'param' => null,
                'mockParams' => [
                    'insert' => [
                        'sourceNewRecords' => [],
                        'mockReturn' => []
                    ]
                ],
                'expected' => []
            ],
            'param no null' => [
                'param' => [
                    'SPT.100025.2' => [],
                    'SSCP_data.10.2' => [
                        0 => [
                            "id" => "101500160",
                            "variabile" => "10",
                            "valore" => "1.779999971389771",
                            "data_e_ora" => "16/04/2015 13:00:00",
                            "tipo_dato" => "2",
                            "link" => "/h1/sscp/dati_acquisiti/101500160"
                        ]
                    ]
                ],
                'mockParams' => [
                    'insert' => [
                        'sourceNewRecords' => [
                            'SPT.100025.2' => [],
                            'SSCP_data.10.2' => [
                                0 => [
                                    "id" => "101500160",
                                    "variabile" => "10",
                                    "valore" => "1.779999971389771",
                                    "data_e_ora" => "16/04/2015 13:00:00",
                                    "tipo_dato" => "2",
                                    "link" => "/h1/sscp/dati_acquisiti/101500160"
                                ]
                            ]
                        ],
                        'mockReturn' => [
                            'SPT.100025.2' => [
                                'inserted' => 0,
                                'failed' => 0
                            ],
                            'SSCP_data.10.2' => [
                                'inserted' => 1,
                                'failed' => 0
                            ]
                        ]
                    ]
                ],
                'expected' => [
                    'SPT.100025.2' => [
                        'inserted' => 0,
                        'failed' => 0
                    ],
                    'SSCP_data.10.2' => [
                        'inserted' => 1,
                        'failed' => 0
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setReport
     * @dataProvider setReportProvider     
     */
    public function testSetReportEquals($param, $mockParams, $expected)
    {
        $insert = $mockParams['insert'];
        
        $stub = $this->getMockBuilder('\vaniacarta74\Crud\Sync')        
                     ->setMethods(array('listSourceNewRecords'))
                     ->getMock();
        
        $stub->expects($this->any())
             ->method('listSourceNewRecords')
             ->with($insert['sourceNewRecords'])
             ->will($this->returnValue($insert['mockReturn']));
        
        Reflections::setProperty($stub, 'sourceNewRecords', $insert['sourceNewRecords']);
        $stub->setReport($param);
        $actual = $stub->getReport();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group sync
     * @coversNothing
     */
    public function setReportExceptionProvider()
    {
        $data = [            
            'wrong param' => [
                'param' => 'pippo'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group sync
     * @covers \vaniacarta74\Crud\Sync::setReport
     * @dataProvider setReportExceptionProvider     
     */
    public function testSetReportException($param)
    {
        $this->setExpectedException('Exception');
        
        $this->sync->setReport($param);
    }
}
