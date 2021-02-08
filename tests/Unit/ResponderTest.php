<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Responder;
use vaniacarta74\Crud\tests\classes\Reflections;

/**
 * Description of ResponderTest
 *
 * @author Vania
 */
class ResponderTest extends TestCase
{
    private $responder;
    
    protected function setUp()
    {
        $resource = '';
        $results = ['type' => 'read', 'records' => [], 'id' => ''];
        
        $this->responder = new Responder($resource, $results);
    }
    
    protected function tearDown()
    {
        $this->responder = null;
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function constructorProvider()
    {
        $data = [
            'all' => [
                'args' => [
                    'resource' => '/h1/core/variabili_sync',
                    'results' => [                    
                        'type' => 'all',
                        'records' => [
                            0 => [
                                'n_record' => '44'
                            ]
                        ],
                        'id' => null                    
                    ] 
                ],
                'expected' => [
                    'type' => 'all',
                    'records' => [
                        0 => [
                            'n_record' => '44'
                        ]
                    ],
                    'id' => null,
                    'count' => 1,
                    'resource' => '/h1/core/variabili_sync',
                    'response' => [
                        'ok' => true,
                        'method' => 'all',
                        'response' => [
                            'message' => 'Numero record caricati: 1',
                            'records' => [
                                0 => [
                                    'n_record' => '44'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'read' => [
                'args' => [
                    'resource' => '/h1/spt/dati_acquisiti',
                    'results' => [                    
                        'type' => 'read',
                        'records' => [
                            0 => [
                                'id' => '97047202',
                                'variabile' => '82025',
                                'valore' => '0',
                                'data_e_ora' => '28/10/2018 02:00:00',
                                'tipo_dato' => '2'
                            ]
                        ],
                        'id' => '97047202'                    
                    ] 
                ],
                'expected' => [
                    'type' => 'read',
                    'records' => [
                        0 => [
                            'id' => '97047202',
                            'variabile' => '82025',
                            'valore' => '0',
                            'data_e_ora' => '28/10/2018 02:00:00',
                            'tipo_dato' => '2',
                            'link' => '/h1/spt/dati_acquisiti/97047202'
                        ]
                    ],
                    'id' => '97047202',
                    'count' => 1,
                    'resource' => '/h1/spt/dati_acquisiti',
                    'response' => [
                        'ok' => true,
                        'method' => 'read',
                        'response' => [
                            'message' => 'Record 97047202 caricato con successo',
                            'records' => [
                                0 => [
                                    'id' => '97047202',
                                    'variabile' => '82025',
                                    'valore' => '0',
                                    'data_e_ora' => '28/10/2018 02:00:00',
                                    'tipo_dato' => '2',
                                    'link' => '/h1/spt/dati_acquisiti/97047202'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'list' => [
                'args' => [
                    'resource' => '/h1/spt/dati_acquisiti',                
                    'results' => [
                        'type' => 'list',
                        'records' => [
                            0 => [
                                'id' => '97047200',
                                'variabile' => '82025',
                                'valore' => '0',
                                'data_e_ora' => '28/10/2018 01:00:00',
                                'tipo_dato' => '2'
                            ]
                        ],
                        'id' => null
                    ]
                ],
                'expected' => [
                    'type' => 'list',
                    'records' => [
                        0 => [
                            'id' => '97047200',
                            'variabile' => '82025',
                            'valore' => '0',
                            'data_e_ora' => '28/10/2018 01:00:00',
                            'tipo_dato' => '2',
                            'link' => '/h1/spt/dati_acquisiti/97047200'
                        ]
                    ],
                    'id' => null,
                    'count' => 1,
                    'resource' => '/h1/spt/dati_acquisiti',
                    'response' => [
                        'ok' => true,
                        'method' => 'list',
                        'response' => [
                            'message' => 'Numero record caricati: 1',
                            'records' => [
                                0 => [
                                    'id' => '97047200',
                                    'variabile' => '82025',
                                    'valore' => '0',
                                    'data_e_ora' => '28/10/2018 01:00:00',
                                    'tipo_dato' => '2',
                                    'link' => '/h1/spt/dati_acquisiti/97047200'
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'create' => [
                'args' => [
                    'resource' => '/h1/spt/dati_acquisiti',                
                    'results' => [
                        'type' => 'create',
                        'id' => '999999999'
                    ]
                ],
                'expected' => [
                    'type' => 'create',
                    'records' => [],
                    'id' => '999999999',
                    'count' => 0,
                    'resource' => '/h1/spt/dati_acquisiti',
                    'response' => [
                        'ok' => true,
                        'method' => 'create',
                        'response' => [
                            'message' => 'Record 999999999 inserito con successo',
                            'link' => '/h1/spt/dati_acquisiti/999999999'
                        ]
                    ]
                ]
            ],
            'update' => [
                'args' => [
                    'resource' => '/h1/spt/dati_acquisiti',                
                    'results' => [
                        'type' => 'update',
                        'id' => '101540010'
                    ] 
                ],
                'expected' => [
                    'type' => 'update',
                    'records' => [],
                    'id' => '101540010',
                    'count' => 0,
                    'resource' => '/h1/spt/dati_acquisiti',
                    'response' => [
                        'ok' => true,
                        'method' => 'update',
                        'response' => [
                            'message' => 'Record 101540010 aggiornato con successo',
                            'link' => '/h1/spt/dati_acquisiti/101540010'
                        ]
                    ]
                ]
            ],
            'delete' => [
                'args' => [
                    'resource' => '/h1/spt/dati_acquisiti',                
                    'results' => [
                        'type' => 'delete',
                        'id' => '999999999'
                    ]
                ],
                'expected' => [
                    'type' => 'delete',
                    'records' => [],
                    'id' => '999999999',
                    'count' => 0,
                    'resource' => '/h1/spt/dati_acquisiti',
                    'response' => [
                        'ok' => true,
                        'method' => 'delete',
                        'response' => [
                            'message' => 'Record 999999999 cancellato con successo'
                        ]
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::__construct
     * @dataProvider constructorProvider
     */
    public function testConstructorEquals($args, $expected)
    {
        Reflections::invokeConstructor($this->responder, $args);
        
        $actual['type'] = Reflections::getProperty($this->responder, 'type');
        $actual['id'] = Reflections::getProperty($this->responder, 'id');
        $actual['records'] = Reflections::getProperty($this->responder, 'records');
        $actual['count'] = Reflections::getProperty($this->responder, 'count');
        $actual['resource'] = Reflections::getProperty($this->responder, 'resource');
        $actual['response'] = Reflections::getProperty($this->responder, 'response');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function constructorExceptionProvider()
    {
        $data = [
            'no string resource' => [
                'args' => [
                    'resource' => [],
                    'results' => []
                ]    
            ],
            'no array response' => [
                'args' => [
                    'resource' => '',
                    'results' => ''
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::__construct
     * @dataProvider constructorExceptionProvider
     */
    public function testConstructorException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeConstructor($this->responder, $args);
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setIdProvider()
    {
        $data = [
            'all' => [
                'args' => [
                    'results' => [                    
                        'type' => 'all',
                        'records' => [
                            0 => [
                                'n_record' => '44'
                            ]
                        ],
                        'id' => null                    
                    ] 
                ],
                'expected' => null
            ],
            'read' => [
                'args' => [
                    'results' => [                    
                        'type' => 'read',
                        'records' => [
                            0 => [
                                'id' => '97047202',
                                'variabile' => '82025',
                                'valore' => '0',
                                'data_e_ora' => '28/10/2018 02:00:00',
                                'tipo_dato' => '2'
                            ]
                        ],
                        'id' => '97047202'                    
                    ] 
                ],
                'expected' => '97047202'
            ],
            'list' => [
                'args' => [
                    'results' => [
                        'type' => 'list',
                        'records' => [
                            0 => [
                                'id' => '97047200',
                                'variabile' => '82025',
                                'valore' => '0',
                                'data_e_ora' => '28/10/2018 01:00:00',
                                'tipo_dato' => '2'
                            ]
                        ],
                        'id' => null
                    ]
                ],
                'expected' => null
            ],
            'create' => [
                'args' => [
                    'results' => [
                        'type' => 'create',
                        'id' => '999999999'
                    ]
                ],
                'expected' => '999999999'
            ],
            'update' => [
                'args' => [
                    'results' => [
                        'type' => 'update',
                        'id' => '101540010'
                    ] 
                ],
                'expected' => '101540010'
            ],
            'delete' => [
                'args' => [
                    'results' => [
                        'type' => 'delete',
                        'id' => '999999999'
                    ]
                ],
                'expected' => '999999999'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setId
     * @dataProvider setIdProvider
     */
    public function testSetIdEquals($args, $expected)
    {
        Reflections::invokeMethod($this->responder, 'setId', $args);
        
        $actual = Reflections::getProperty($this->responder, 'id');        
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setIdExceptionProvider()
    {
        $data = [
            'no array results' => [
                'args' => [
                    'results' => ''
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setId
     * @dataProvider setIdExceptionProvider
     */
    public function testSetIdException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->responder, 'setId', $args);
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setRecordsProvider()
    {
        $data = [
            'all' => [
                'args' => [
                    'results' => [                    
                        'type' => 'all',
                        'records' => [
                            0 => [
                                'n_record' => '44'
                            ]
                        ],
                        'id' => null                    
                    ] 
                ],
                'expected' => [
                    0 => [
                        'n_record' => '44'
                    ]
                ]
            ],
            'read' => [
                'args' => [
                    'results' => [                    
                        'type' => 'read',
                        'records' => [
                            0 => [
                                'id' => '97047202',
                                'variabile' => '82025',
                                'valore' => '0',
                                'data_e_ora' => '28/10/2018 02:00:00',
                                'tipo_dato' => '2'
                            ]
                        ],
                        'id' => '97047202'                    
                    ] 
                ],
                'expected' => [
                    0 => [
                        'id' => '97047202',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 02:00:00',
                        'tipo_dato' => '2'
                    ]
                ]
            ],
            'list' => [
                'args' => [
                    'results' => [
                        'type' => 'list',
                        'records' => [
                            0 => [
                                'id' => '97047200',
                                'variabile' => '82025',
                                'valore' => '0',
                                'data_e_ora' => '28/10/2018 01:00:00',
                                'tipo_dato' => '2'
                            ]
                        ],
                        'id' => null
                    ]
                ],
                'expected' => [
                    0 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 01:00:00',
                        'tipo_dato' => '2'
                    ]
                ]
            ],
            'create' => [
                'args' => [
                    'results' => [
                        'type' => 'create',
                        'id' => '999999999'
                    ]
                ],
                'expected' => []
            ],
            'update' => [
                'args' => [
                    'results' => [
                        'type' => 'update',
                        'id' => '101540010'
                    ] 
                ],
                'expected' => []
            ],
            'delete' => [
                'args' => [
                    'results' => [
                        'type' => 'delete',
                        'id' => '999999999'
                    ]
                ],
                'expected' => []
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setRecords
     * @dataProvider setRecordsProvider
     */
    public function testSetRecordsEquals($args, $expected)
    {
        Reflections::invokeMethod($this->responder, 'setRecords', $args);
        
        $actual = Reflections::getProperty($this->responder, 'records');        
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setRecordsExceptionProvider()
    {
        $data = [
            'no array results' => [
                'args' => [
                    'results' => ''
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setRecords
     * @dataProvider setRecordsExceptionProvider
     */
    public function testSetRecordsException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->responder, 'setRecords', $args);
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setTypeProvider()
    {
        $data = [
            'all' => [
                'args' => [
                    'results' => [                    
                        'type' => 'all',
                        'records' => [
                            0 => [
                                'n_record' => '44'
                            ]
                        ],
                        'id' => null                    
                    ] 
                ],
                'expected' => 'all'
            ],
            'read' => [
                'args' => [
                    'results' => [                    
                        'type' => 'read',
                        'records' => [
                            0 => [
                                'id' => '97047202',
                                'variabile' => '82025',
                                'valore' => '0',
                                'data_e_ora' => '28/10/2018 02:00:00',
                                'tipo_dato' => '2'
                            ]
                        ],
                        'id' => '97047202'                    
                    ] 
                ],
                'expected' => 'read'
            ],
            'list' => [
                'args' => [
                    'results' => [
                        'type' => 'list',
                        'records' => [
                            0 => [
                                'id' => '97047200',
                                'variabile' => '82025',
                                'valore' => '0',
                                'data_e_ora' => '28/10/2018 01:00:00',
                                'tipo_dato' => '2'
                            ]
                        ],
                        'id' => null
                    ]
                ],
                'expected' => 'list'
            ],
            'create' => [
                'args' => [
                    'results' => [
                        'type' => 'create',
                        'id' => '999999999'
                    ]
                ],
                'expected' => 'create'
            ],
            'update' => [
                'args' => [
                    'results' => [
                        'type' => 'update',
                        'id' => '101540010'
                    ] 
                ],
                'expected' => 'update'
            ],
            'delete' => [
                'args' => [
                    'results' => [
                        'type' => 'delete',
                        'id' => '999999999'
                    ]
                ],
                'expected' => 'delete'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setType
     * @dataProvider setTypeProvider
     */
    public function testSetTypeEquals($args, $expected)
    {
        Reflections::invokeMethod($this->responder, 'setType', $args);
        
        $actual = Reflections::getProperty($this->responder, 'type');        
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setTypeExceptionProvider()
    {
        $data = [
            'no array results' => [
                'args' => [
                    'results' => ''
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setType
     * @dataProvider setTypeExceptionProvider
     */
    public function testSetTypeException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->responder, 'setType', $args);
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setResourceProvider()
    {
        $data = [
            'read' => [
                'args' => [
                    'resource' => '/h1/spt/dati_acquisiti'                     
                ],
                'expected' => '/h1/spt/dati_acquisiti'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setResource
     * @dataProvider setResourceProvider
     */
    public function testSetResourceEquals($args, $expected)
    {
        Reflections::invokeMethod($this->responder, 'setResource', $args);
        
        $actual = Reflections::getProperty($this->responder, 'resource');        
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setResourceExceptionProvider()
    {
        $data = [
            'no string resource' => [
                'args' => [
                    'resource' => []
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setResource
     * @dataProvider setResourceExceptionProvider
     */
    public function testSetResourceException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->responder, 'setResource', $args);
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setCountProvider()
    {
        $data = [
            'more records' => [
                'records' => [
                    0 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 01:00:00',
                        'tipo_dato' => '2'
                    ],
                    1 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 02:00:00',
                        'tipo_dato' => '2'
                    ]
                ],
                'expected' => 2
            ],
            'one records' => [
                'records' => [
                    0 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 01:00:00',
                        'tipo_dato' => '2'
                    ]
                ],
                'expected' => 1
            ],
            'no records' => [
                'records' => [],
                'expected' => 0
            ],
            'no array' => [
                'records' => null,
                'expected' => 0
            ]
        ];
                
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setCount
     * @dataProvider setCountProvider
     */
    public function testSetCountEquals($records, $expected)
    {
        Reflections::setProperty($this->responder, 'records', $records);
        Reflections::invokeMethod($this->responder, 'setCount');
        
        $actual = Reflections::getProperty($this->responder, 'count');        
        
        $this->assertEquals($expected, $actual);         
    }

    /**
     * @group responder
     * @coversNothing
     */
    public function setLinkProvider()
    {
        $data = [
            'integer' => [
                'args' => [
                    'id' => 999999999                     
                ],
                'resource' => '/h1/spt/dati_acquisiti',
                'expected' => '/h1/spt/dati_acquisiti/999999999'
            ],
            'numeric' => [
                'args' => [
                    'id' => '999999999'                     
                ],
                'resource' => '/h1/spt/dati_acquisiti',
                'expected' => '/h1/spt/dati_acquisiti/999999999'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setLink
     * @dataProvider setLinkProvider
     */
    public function testSetLinkEquals($args, $resource, $expected)
    {
        Reflections::setProperty($this->responder, 'resource', $resource);
        $actual =Reflections::invokeMethod($this->responder, 'setLink', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setLinkExceptionProvider()
    {
        $data = [
            'no numeric id' => [
                'args' => [
                    'id' => []
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setLink
     * @dataProvider setLinkExceptionProvider
     */
    public function testSetLinkException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->responder, 'setLink', $args);
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function addLinksProvider()
    {
        $data = [
            'more records' => [
                'records' => [
                    0 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 01:00:00',
                        'tipo_dato' => '2'
                    ],
                    1 => [
                        'id' => '97047201',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 02:00:00',
                        'tipo_dato' => '2'
                    ]
                ],
                'resource' => '/h1/spt/dati_acquisiti',
                'expected' => [
                    0 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 01:00:00',
                        'tipo_dato' => '2',
                        'link' => '/h1/spt/dati_acquisiti/97047200'
                    ],
                    1 => [
                        'id' => '97047201',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 02:00:00',
                        'tipo_dato' => '2',
                        'link' => '/h1/spt/dati_acquisiti/97047201'
                    ]
                ]
            ],
            'one records' => [
                'records' => [
                    0 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 01:00:00',
                        'tipo_dato' => '2'
                    ]
                ],
                'resource' => '/h1/spt/dati_acquisiti',
                'expected' => [
                    0 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 01:00:00',
                        'tipo_dato' => '2',
                        'link' => '/h1/spt/dati_acquisiti/97047200'
                    ]
                ]
            ],
            'no records' => [
                'records' => [],
                'resource' => '/h1/spt/dati_acquisiti',
                'expected' => []
            ]
        ];
                
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::addLinks
     * @dataProvider addLinksProvider
     */
    public function testAddLinksEquals($records, $resource, $expected)
    {
        Reflections::setProperty($this->responder, 'records', $records);
        Reflections::setProperty($this->responder, 'resource', $resource);
        Reflections::invokeMethod($this->responder, 'addLinks');
        
        $actual = Reflections::getProperty($this->responder, 'records');        
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function addLinksExceptionProvider()
    {
        $data = [
            'no array records' => [
                'records' => ''
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::addLinks
     * @dataProvider addLinksExceptionProvider
     */
    public function testAddLinksException($records)
    {
        $this->setExpectedException('Exception');
        
        Reflections::setProperty($this->responder, 'records', $records);
        Reflections::invokeMethod($this->responder, 'addLinks');
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setResponseProvider()
    {
        $data = [
            'all' => [
                'type' => 'all',
                'records' => [
                    0 => [
                        'n_record' => '44'
                    ]
                ],
                'id' => null,
                'count' => 1,                
                'resource' => '/h1/core/variabili_sync',                
                'expected' => [
                    "ok" => true,
                    "method" => "all",
                    "response" => [
                        "message" => "Numero record caricati: 1",
                        "records" => [
                            0 => [
                                'n_record' => '44'
                            ]
                        ]
                    ]
                ]
            ],
            'read standard' => [
                'type' => 'read',
                'records' => [
                    0 => [
                        'id' => '97047202',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 02:00:00',
                        'tipo_dato' => '2',
                        'link' => '/h1/spt/dati_acquisiti/97047202'
                    ]
                ],
                'id' => '97047202',
                'count' => 1,                
                'resource' => '/h1/spt/dati_acquisiti',                
                'expected' => [
                    "ok" => true,
                    "method" => "read",
                    "response" => [
                        "message" => "Record 97047202 caricato con successo",
                        "records" => [
                            0 => [
                                "id" => "97047202",
                                "variabile" => "82025",
                                "valore" => "0",
                                "data_e_ora" => "28/10/2018 02:00:00",
                                "tipo_dato" => "2",
                                "link" => "/h1/spt/dati_acquisiti/97047202"
                            ]
                        ]
                    ]
                ]
            ],
            'read no record' => [
                'type' => 'read',
                'records' => [],
                'id' => '97047202',
                'count' => 0,                
                'resource' => '/h1/spt/dati_acquisiti',                
                'expected' => [
                    "ok" => true,
                    "method" => "read",
                    "response" => [
                        "message" => "Record 97047202 non trovato",
                        "records" => []
                    ]
                ]
            ],
            'list standard' => [
                'type' => 'list',
                'records' => [
                    0 => [
                        'id' => '97047200',
                        'variabile' => '82025',
                        'valore' => '0',
                        'data_e_ora' => '28/10/2018 01:00:00',
                        'tipo_dato' => '2',
                        "link" => "/h1/spt/dati_acquisiti/97047200"
                    ]
                ],
                'id' => null,
                'count' => 1,
                'resource' => '/h1/spt/dati_acquisiti',              
                'expected' => [
                    "ok" => true,
                    "method" => "list",
                    "response" => [
                        "message" => "Numero record caricati: 1",
                        "records" => [
                            0 => [
                                "id" => "97047200",
                                "variabile" => "82025",
                                "valore" => "0",
                                "data_e_ora" => "28/10/2018 01:00:00",
                                "tipo_dato" => "2",
                                "link" => "/h1/spt/dati_acquisiti/97047200"
                            ]
                        ]
                    ]
                ]
            ],
            'list no record' => [
                'type' => 'list',
                'records' => [],
                'id' => null,
                'count' => 0,
                'resource' => '/h1/spt/dati_acquisiti',              
                'expected' => [
                    "ok" => true,
                    "method" => "list",
                    "response" => [
                        "message" => "Nessun record trovato per i parametri indicati",
                        "records" => []
                    ]
                ]
            ],
            'create' => [
                'type' => 'create',
                'records' => [],
                'id' => '999999999',
                'count' => 0,
                'resource' => '/h1/spt/dati_acquisiti',                
                'expected' => [
                    "ok" => true,
                    "method" => "create",
                    "response" => [
                        "message" => "Record 999999999 inserito con successo",
                        "link" => "/h1/spt/dati_acquisiti/999999999"
                    ]
                ]
            ],
            'update' => [
                'type' => 'update',
                'records' => [],
                'id' => '101540010',
                'count' => 0,
                'resource' => '/h1/spt/dati_acquisiti',                
                'expected' => [
                    "ok" => true,
                    "method" => "update",
                    "response" => [
                        "message" => "Record 101540010 aggiornato con successo",
                        "link" => "/h1/spt/dati_acquisiti/101540010"
                    ]
                ]
            ],
            'delete' => [
                'type' => 'delete',
                'records' => [],
                'id' => '999999999',
                'count' => 0,
                'resource' => '/h1/spt/dati_acquisiti',
                'expected' => [
                    "ok" => true,
                    "method" => "delete",
                    "response" => [
                        "message" => "Record 999999999 cancellato con successo"
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setResponse
     * @dataProvider setResponseProvider
     */
    public function testSetResponseEquals($type, $records, $id, $count, $resource, $expected)
    {
        Reflections::setProperty($this->responder, 'type', $type);        
        Reflections::setProperty($this->responder, 'records', $records);        
        Reflections::setProperty($this->responder, 'id', $id);
        Reflections::setProperty($this->responder, 'count', $count);
        Reflections::setProperty($this->responder, 'resource', $resource);
        
        Reflections::invokeMethod($this->responder, 'setResponse');
        
        $actual = Reflections::getProperty($this->responder, 'response');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group responder
     * @coversNothing
     */
    public function setResponseExceptionProvider()
    {
        $data = [
            'wrong method' => [
                'type' => 'pippo',
                'records' => [],
                'id' => '101540010',
                'count' => 0,
                'resource' => '/h1/spt/dati_acquisiti',    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group responder
     * @covers \vaniacarta74\Crud\Responder::setResponse
     * @dataProvider setResponseExceptionProvider
     */
    public function testSetResponseException($type, $records, $id, $count, $resource)
    {
        $this->setExpectedException('Exception');
        
        Reflections::setProperty($this->responder, 'type', $type);        
        Reflections::setProperty($this->responder, 'records', $records);        
        Reflections::setProperty($this->responder, 'id', $id);
        Reflections::setProperty($this->responder, 'count', $count);
        Reflections::setProperty($this->responder, 'resource', $resource);
        
        Reflections::invokeMethod($this->responder, 'setResponse');
    }
}
