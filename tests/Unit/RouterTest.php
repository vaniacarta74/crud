<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Router;
use vaniacarta74\Crud\tests\classes\Reflections;

/**
 * Description of RouterTest
 *
 * @author Vania
 */
class RouterTest extends TestCase
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
     * @group router
     * @coversNothing
     */
    public function constructorProvider()
    {
        $data = [
            'read' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/4000000',
                    'method' => 'GET',
                    'input' => null
                ],
                'request' => [],
                'expecteds' => [
                    'input' => null,
                    'host' => 'h1',
                    'db' => 'SSCP_data',
                    'alias' => 'sscp',
                    'table' => 'dati_acquisiti',
                    'resource' => '/h1/sscp/dati_acquisiti',
                    'id' => '4000000',
                    'queryType' => 'read',
                    'queryParams' => [
                        'fields' => [
                            0 => [
                                'name' => 'id_dato',
                                'alias' => 'id',
                                'type' => 'integer'
                            ],
                            1 => [
                                'name' => 'variabile',
                                'alias' => null,
                                'type' => 'integer'
                            ],
                            2 => [
                                'name' => 'valore',
                                'alias' => null,
                                'type' => 'float'
                            ],
                            3 => [
                                'name' => 'CONVERT(varchar, data_e_ora, 20)',
                                'alias' => 'data_e_ora',
                                'type' => 'dateTime'
                            ],
                            4 => [
                                'name' => 'tipo_dato',
                                'alias' => null,
                                'type' => 'integer'
                            ]
                        ],
                        'table' => 'dati_acquisiti',
                        'where' => [
                            'and' => [
                                0 => [
                                    'field' => 'id_dato',
                                    'operator' => '=',
                                    'value' => [
                                        'param' => 'id',
                                        'bind' => ':id_dato',
                                        'type' => 'int',
                                        'null' => false,
                                        'check' => [
                                            'type' => 'integer',
                                            'params' => []
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'order' => [],
                        'type' => 'read'
                    ],
                    'urlParams' => [
                        'id' => '4000000'
                    ]
                ]    
            ],
            'list' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                    'method' => 'GET',
                    'input' => null
                ], 
                'request' => [
                    'var' => 10230,
                    'type' => 2,
                    'datefrom' => '27/08/2017T00:00:00',
                    'dateto' => '27/08/2017T01:00:00'
                ],
                'expecteds' => [
                    'input' => [
                        'var' => 10230,
                        'type' => 2,
                        'datefrom' => '27/08/2017T00:00:00',
                        'dateto' => '27/08/2017T01:00:00'
                    ],
                    'host' => 'h1',
                    'db' => 'SSCP_data',
                    'alias' => 'sscp',
                    'table' => 'dati_acquisiti',
                    'resource' => '/h1/sscp/dati_acquisiti',
                    'id' => null,
                    'queryType' => 'list',
                    'queryParams' => [
                        'fields' => [
                            0 => [
                                'name' => 'id_dato',
                                'alias' => 'id',
                                'type' => 'integer'
                            ],
                            1 => [
                                'name' => 'variabile',
                                'alias' => null,
                                'type' => 'integer'
                            ],
                            2 => [
                                'name' => 'valore',
                                'alias' => null,
                                'type' => 'float'
                            ],
                            3 => [
                                'name' => 'CONVERT(varchar, data_e_ora, 20)',
                                'alias' => 'data_e_ora',
                                'type' => 'dateTime'
                            ],
                            4 => [
                                'name' => 'tipo_dato',
                                'alias' => null,
                                'type' => 'integer'
                            ]
                        ],
                        'table' => 'dati_acquisiti',
                        'where' => [
                            'and' => [
                                0 => [
                                    'field' => 'variabile',
                                    'operator' => '=',
                                    'value' => [
                                        'param' => 'var',
                                        'bind' => ':variabile',
                                        'type' => 'int',
                                        'null' => false,
                                        'check' => [
                                            'type' => 'integer',
                                            'params' => []
                                        ]
                                    ]
                                ],
                                1 => [
                                    'field' => 'tipo_dato',
                                    'operator' => '=',
                                    'value' => [
                                        'param' => 'type',
                                        'bind' => ':tipoDato',
                                        'type' => 'int',
                                        'null' => false,
                                        'check' => [
                                            'type' => 'enum',
                                            'params' => [
                                                0 => [
                                                    0 => 1,
                                                    1 => 2
                                                ]
                                            ]
                                        ]
                                    ]
                                ],
                                2 => [
                                    'field' => 'data_e_ora',
                                    'operator' => '>=',
                                    'value' => [
                                        'param' => 'datefrom',
                                        'bind' => ':dataIniziale',
                                        'type' => 'str',
                                        'null' => false,
                                        'check' => [
                                            'type' => 'dateTime',
                                            'params' => [
                                                0 => true
                                            ]
                                        ]
                                    ]
                                ],
                                3 => [
                                    'field' => 'data_e_ora',
                                    'operator' => '<',
                                    'value' => [
                                        'param' => 'dateto',
                                        'bind' => ':dataFinale',
                                        'type' => 'str',
                                        'null' => false,
                                        'check' => [
                                            'type' => 'dateTime',
                                            'params' => [
                                                0 => true
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        'order' => [
                            0 => [
                                'field' => 'data_e_ora',
                                'type' => 'asc'
                            ]
                        ],
                        'type' => 'list'
                    ],
                    'urlParams' => [
                        'var' => 10230,
                        'type' => 2,
                        'datefrom' => '27/08/2017T00:00:00',
                        'dateto' => '27/08/2017T01:00:00'
                    ]
                ]    
            ],
            'create' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                    'method' => 'POST',
                    'input' => __DIR__ . '/../providers/phpInput.json'
                ], 
                'request' => null,
                'expecteds' => [
                    'input' => [
                        'var' => 10230,
                        'type' => 2,
                        'date' => '01/01/2021',
                        'val' => 3.5
                    ],
                    'host' => 'h1',
                    'db' => 'SSCP_data',
                    'alias' => 'sscp',
                    'table' => 'dati_acquisiti',
                    'resource' => '/h1/sscp/dati_acquisiti',
                    'id' => null,
                    'queryType' => 'create',
                    'queryParams' => [                        
                        'table' => 'dati_acquisiti',
                        'type' => 'create',
                        'values' => [
                            0 => [
                                'field' => 'variabile',
                                'value' => [
                                    'param' => 'var',
                                    'bind' => ':variabile',
                                    'type' => 'int',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'integer',
                                        'params' => []
                                    ]
                                ]
                            ],
                            1 => [
                                'field' => 'tipo_dato',
                                'value' => [
                                    'param' => 'type',
                                    'bind' => ':tipoDato',
                                    'type' => 'int',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'enum',
                                        'params' => [
                                            0 => [
                                                0 => 1,
                                                1 => 2
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            2 => [
                                'field' => 'data_e_ora',
                                'value' => [
                                    'param' => 'date',
                                    'bind' => ':data_e_ora',
                                    'type' => 'str',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'dateTime',
                                        'params' => [
                                            0 => true
                                        ]
                                    ]
                                ]
                            ],
                            3 => [
                                'field' => 'valore',
                                'value' => [
                                    'param' => 'val',
                                    'bind' => ':valore',
                                    'type' => 'int',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'float',
                                        'params' => []
                                    ]
                                ]
                            ],
                            4 => [
                                'field' => 'unita_misura',
                                'value' => [
                                    'param' => 'unit',
                                    'bind' => ':unita_misura',
                                    'type' => 'str',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'str',
                                        'params' => []
                                    ]
                                ]
                            ],
                            5 => [
                                'field' => 'impianto',
                                'value' => [
                                    'param' => 'imp',
                                    'bind' => ':impianto',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'int',
                                        'params' => []
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'urlParams' => [
                        'var' => 10230,
                        'type' => 2,
                        'date' => '01/01/2021',
                        'val' => 3.5
                    ]
                ]    
            ],
            'update put' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700175',
                    'method' => 'PUT',
                    'input' => null
                ], 
                'request' => [
                    'val' => 1.9,                    
                    'date' => '02/01/2020'
                ],
                'expecteds' => [
                    'input' => [
                        'val' => 1.9,                    
                        'date' => '02/01/2020'
                    ],
                    'host' => 'h1',
                    'db' => 'SSCP_data',
                    'alias' => 'sscp',
                    'table' => 'dati_acquisiti',
                    'resource' => '/h1/sscp/dati_acquisiti',
                    'id' => '101700175',
                    'queryType' => 'update',
                    'queryParams' => [                        
                        'table' => 'dati_acquisiti',
                        'type' => 'update',
                        'set' => [
                            0 => [
                                'field' => 'variabile',
                                'value' => [
                                    'param' => 'var',
                                    'bind' => ':variabile',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'integer',
                                        'params' => []
                                    ]
                                ]
                            ],
                            1 => [
                                'field' => 'tipo_dato',
                                'value' => [
                                    'param' => 'type',
                                    'bind' => ':tipoDato',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'enum',
                                        'params' => [
                                            0 => [
                                                0 => 1,
                                                1 => 2
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            2 => [
                                'field' => 'data_e_ora',
                                'value' => [
                                    'param' => 'date',
                                    'bind' => ':data_e_ora',
                                    'type' => 'str',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'dateTime',
                                        'params' => [
                                            0 => true
                                        ]
                                    ]
                                ]
                            ],
                            3 => [
                                'field' => 'valore',
                                'value' => [
                                    'param' => 'val',
                                    'bind' => ':valore',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'float',
                                        'params' => []
                                    ]
                                ]
                            ],
                            4 => [
                                'field' => 'unita_misura',
                                'value' => [
                                    'param' => 'unit',
                                    'bind' => ':unita_misura',
                                    'type' => 'str',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'str',
                                        'params' => []
                                    ]
                                ]
                            ],
                            5 => [
                                'field' => 'impianto',
                                'value' => [
                                    'param' => 'imp',
                                    'bind' => ':impianto',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'int',
                                        'params' => []
                                    ]
                                ]
                            ]
                        ],
                        'where' => [
                            'and' => [
                                0 => [
                                    'field' => 'id_dato',
                                    'operator' => '=',
                                    'value' => [
                                        'param' => 'id',
                                        'bind' => ':id_dato',
                                        'type' => 'int',
                                        'null' => false,
                                        'check' => [
                                            'type' => 'integer',
                                            'params' => []
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'urlParams' => [
                        'date' => '02/01/2020',
                        'val' => 1.9,
                        'id' => '101700175'
                    ]
                ]    
            ],
            'update patch' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700175',
                    'method' => 'PATCH',
                    'input' => null
                ], 
                'request' => [
                    'val' => 1.9,                    
                    'date' => '02/01/2020'
                ],
                'expecteds' => [
                    'input' => [
                        'val' => 1.9,                    
                        'date' => '02/01/2020'
                    ],
                    'host' => 'h1',
                    'db' => 'SSCP_data',
                    'alias' => 'sscp',
                    'table' => 'dati_acquisiti',
                    'resource' => '/h1/sscp/dati_acquisiti',
                    'id' => '101700175',
                    'queryType' => 'update',
                    'queryParams' => [                        
                        'table' => 'dati_acquisiti',
                        'type' => 'update',
                        'set' => [
                            0 => [
                                'field' => 'variabile',
                                'value' => [
                                    'param' => 'var',
                                    'bind' => ':variabile',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'integer',
                                        'params' => []
                                    ]
                                ]
                            ],
                            1 => [
                                'field' => 'tipo_dato',
                                'value' => [
                                    'param' => 'type',
                                    'bind' => ':tipoDato',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'enum',
                                        'params' => [
                                            0 => [
                                                0 => 1,
                                                1 => 2
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            2 => [
                                'field' => 'data_e_ora',
                                'value' => [
                                    'param' => 'date',
                                    'bind' => ':data_e_ora',
                                    'type' => 'str',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'dateTime',
                                        'params' => [
                                            0 => true
                                        ]
                                    ]
                                ]
                            ],
                            3 => [
                                'field' => 'valore',
                                'value' => [
                                    'param' => 'val',
                                    'bind' => ':valore',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'float',
                                        'params' => []
                                    ]
                                ]
                            ],
                            4 => [
                                'field' => 'unita_misura',
                                'value' => [
                                    'param' => 'unit',
                                    'bind' => ':unita_misura',
                                    'type' => 'str',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'str',
                                        'params' => []
                                    ]
                                ]
                            ],
                            5 => [
                                'field' => 'impianto',
                                'value' => [
                                    'param' => 'imp',
                                    'bind' => ':impianto',
                                    'type' => 'int',
                                    'null' => true,
                                    'check' => [
                                        'type' => 'int',
                                        'params' => []
                                    ]
                                ]
                            ]
                        ],
                        'where' => [
                            'and' => [
                                0 => [
                                    'field' => 'id_dato',
                                    'operator' => '=',
                                    'value' => [
                                        'param' => 'id',
                                        'bind' => ':id_dato',
                                        'type' => 'int',
                                        'null' => false,
                                        'check' => [
                                            'type' => 'integer',
                                            'params' => []
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'urlParams' => [
                        'date' => '02/01/2020',
                        'val' => 1.9,
                        'id' => '101700175'
                    ]
                ]    
            ],
            'delete' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/101700184',
                    'method' => 'DELETE',
                    'input' => null
                ], 
                'request' => null,
                'expecteds' => [
                    'input' => null,
                    'host' => 'h1',
                    'db' => 'SSCP_data',
                    'alias' => 'sscp',
                    'table' => 'dati_acquisiti',
                    'resource' => '/h1/sscp/dati_acquisiti',
                    'id' => '101700184',
                    'queryType' => 'delete',
                    'queryParams' => [                        
                        'table' => 'dati_acquisiti',
                        'type' => 'delete',
                        'where' => [
                            'and' => [
                                0 => [
                                    'field' => 'id_dato',
                                    'operator' => '=',
                                    'value' => [
                                        'param' => 'id',
                                        'bind' => ':id_dato',
                                        'type' => 'int',
                                        'null' => false,
                                        'check' => [
                                            'type' => 'integer',
                                            'params' => []
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'urlParams' => [
                        'id' => '101700184'
                    ]
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::__construct
     * @dataProvider constructorProvider
     */
    public function testConstructorEquals($args, $request, $expected)
    {
        $_GET = $request;
        
        Reflections::invokeConstructor($this->router, $args);
        
        $actual['input'] = Reflections::getProperty($this->router, 'input');
        $actual['host'] = Reflections::getProperty($this->router, 'host');
        $actual['db'] = Reflections::getProperty($this->router, 'db');
        $actual['alias'] = Reflections::getProperty($this->router, 'alias');
        $actual['table'] = Reflections::getProperty($this->router, 'table');
        $actual['resource'] = Reflections::getProperty($this->router, 'resource');
        $actual['id'] = Reflections::getProperty($this->router, 'id');
        $actual['queryType'] = Reflections::getProperty($this->router, 'queryType');
        $actual['queryParams'] = Reflections::getProperty($this->router, 'queryParams');
        $actual['urlParams'] = Reflections::getProperty($this->router, 'urlParams');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function constructorExceptionProvider()
    {
        $data = [
            'exception' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                    'method' => 'GET',
                    'input' => null
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::__construct
     * @dataProvider constructorExceptionProvider
     */
    public function testConstructorException($args)
    {
        $_GET = [];
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeConstructor($this->router, $args);
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function setInputProvider()
    {
        $data = [
            'no input' => [
                'args' => [
                    'input' => null
                ],
                'get' => [],
                'post' => [],
                'expecteds' => null
            ],
            'get' => [
                'args' => [
                    'input' => null
                ],
                'get' => [
                    'var' => 10230,
                    'val' => 1.9 
                ],
                'post' => [],
                'expecteds' => [
                    'var' => 10230,
                    'val' => 1.9 
                ]
            ],
            'post json' => [
                'args' => [
                    'input' => __DIR__ . '/../providers/phpInput.json'
                ],
                'get' => [],
                'post' => [],
                'expecteds' => [
                    'var' => 10230,
                    'type' => 2,
                    'date' => '01/01/2021',
                    'val' => 3.5
                ]
            ],
            'post' => [
                'args' => [
                    'input' => null
                ],
                'get' => [],
                'post' => [
                    'var' => 10230,
                    'type' => 2,
                    'date' => '01/01/2021',
                    'val' => 3.5
                ],
                'expecteds' => [
                    'var' => 10230,
                    'type' => 2,
                    'date' => '01/01/2021',
                    'val' => 3.5
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setInput
     * @dataProvider setInputProvider
     */
    public function testSetInputEquals($args, $get, $post, $expected)
    {
        $_GET = $get;
        $_POST = $post;
        
        Reflections::invokeMethod($this->router, 'setInput', $args);
        
        $actual = Reflections::getProperty($this->router, 'input');        
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setInput
     */
    public function testSetInputException()
    {
        $_GET = [];
        $_POST = [];
        $args = [
            'input' => __DIR__ . '/pippo.json'
        ];
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setInput', $args);
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function setHostProvider()
    {
        $data = [
            'h1' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                ],
                'expected' => 'h1'
            ],
            'h2' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h2/sscp/dati_acquisiti',
                ],
                'expected' => 'h2'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setHost
     * @dataProvider setHostProvider
     */
    public function testSetHostEquals($args, $expected)
    {
        Reflections::invokeMethod($this->router, 'setHost', $args);
        
        $actual = Reflections::getProperty($this->router, 'host');
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setHost
     */
    public function testSetHostException()
    {
        $args = [          
            'path' => 'http://localhost/crud/api/pippo/sscp/scarichi',
        ];
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setHost', $args);
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setHost
     */
    public function testSetHostStringException()
    {
        $args = [          
            'path' => [],
        ];
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setHost', $args);
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function setDbProvider()
    {
        $data = [
            'sscp' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                    'routes' => [
                        'SSCP_data' => [
                            'alias' => 'sscp'
                        ]
                    ]
                ],
                'expected' => [
                    'db' => 'SSCP_data',
                    'alias' => 'sscp'
                ]
            ],
            'spt' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/spt/dati_acquisiti',
                    'routes' => [
                        'SPT' => [
                            'alias' => 'spt'
                        ]
                    ]
                ],
                'expected' => [
                    'db' => 'SPT',
                    'alias' => 'spt'
                ]
            ],
            'dbutz' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/utz/utenti',
                    'routes' => [
                        'dbutz' => [
                            'alias' => 'utz'
                        ]
                    ]
                ],
                'expected' => [
                    'db' => 'dbutz',
                    'alias' => 'utz'
                ]
            ],
            'dbcore' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/core/scarichi',
                    'routes' => [
                        'dbcore' => [
                            'alias' => 'core'
                        ]
                    ]
                ],
                'expected' => [
                    'db' => 'dbcore',
                    'alias' => 'core'
                ]
            ],
            'dbumd' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/umd/scarichi',
                    'routes' => [
                        'dbumd' => [
                            'alias' => 'umd'
                        ]
                    ]
                ],
                'expected' => [
                    'db' => 'dbumd',
                    'alias' => 'umd'
                ]
            ] 
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setDb
     * @dataProvider setDbProvider
     */
    public function testSetDbEquals($args, $expected)
    {
        Reflections::invokeMethod($this->router, 'setDb', $args);
        
        $actual['db'] = Reflections::getProperty($this->router, 'db');
        $actual['alias'] = Reflections::getProperty($this->router, 'alias');
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setDb
     */
    public function testSetDbException()
    {
        $args = [          
            'path' => 'http://localhost/crud/api/pippo/scarichi',
            'routes' => [
                'dbcore' => [
                    'alias' => 'core'
                ]
            ]
        ];
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setDb', $args);
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function setTableProvider()
    {
        $data = [
            'sscp' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti',
                    'routes' => [
                        'SSCP_data' => [
                            'tables' => [
                                'dati_acquisiti',
                                'variabili'
                            ]
                        ]
                    ]
                ],
                'db' => 'SSCP_data',
                'expected' => [
                    'table' => 'dati_acquisiti'
                ]
            ],
            'spt' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/spt/dati_acquisiti',
                    'routes' => [
                        'SPT' => [
                            'tables' => [
                                'dati_acquisiti',
                                'variabili'
                            ]
                        ]
                    ]
                ],
                'db' => 'SPT',
                'expected' => [
                    'table' => 'dati_acquisiti'
                ]
            ],
            'dbutz' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/utz/utenti',
                    'routes' => [
                        'dbutz' => [
                            'tables' => [
                                'utenti',
                                'utenze'
                            ]
                        ]
                    ]
                ],
                'db' => 'dbutz',
                'expected' => [
                    'table' => 'utenti'
                ]
            ],
            'dbcore' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/core/scarichi',
                    'routes' => [
                        'dbcore' => [
                            'tables' => [
                                'scarichi',
                                'formule'
                            ]
                        ]
                    ]
                ],
                'db' => 'dbcore',
                'expected' => [
                    'table' => 'scarichi'
                ]
            ],
            'dbumd' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/umd/richieste',
                    'routes' => [
                        'dbumd' => [
                            'tables' => [
                                'richieste',
                                'attivazioni'
                            ]
                        ]
                    ]
                ],
                'db' => 'dbumd',
                'expected' => [
                    'table' => 'richieste'
                ]
            ] 
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setTable
     * @dataProvider setTableProvider
     */
    public function testSetTableEquals($args, $db, $expected)
    {
        
        Reflections::setProperty($this->router, 'db', $db);
        Reflections::invokeMethod($this->router, 'setTable', $args);
        
        $actual['table'] = Reflections::getProperty($this->router, 'table');
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setTable
     */
    public function testSetTableException()
    {
        $args = [          
            'path' => 'http://localhost/crud/api/h1/core/pippo',
            'routes' => [
                'dbcore' => [
                    'tables' => [
                        'scarichi',
                        'formule'
                    ]
                ]
            ]
        ];
        $db = 'dbcore';
        
        $this->setExpectedException('Exception');
        
        Reflections::setProperty($this->router, 'db', $db);
        Reflections::invokeMethod($this->router, 'setTable', $args);
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setResource
     */
    public function testSetResourceEquals()
    {
        $host = 'h1';
        $db = 'SSCP_data';
        $alias = 'sscp';
        $table = 'dati_acquisiti';
        $args = [];
        $expected = '/h1/sscp/dati_acquisiti';
        
        Reflections::setProperty($this->router, 'host', $host);
        Reflections::setProperty($this->router, 'db', $db);
        Reflections::setProperty($this->router, 'alias', $alias);
        Reflections::setProperty($this->router, 'table', $table);
        
        Reflections::invokeMethod($this->router, 'setResource', $args);
        
        $actual = Reflections::getProperty($this->router, 'resource');
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setResource
     */
    public function testSetResourceException()
    {
        $host = 'h1';
        $db = 'SSCP_data';
        $alias = null;
        $table = null;
        $args = [];
        
        Reflections::setProperty($this->router, 'host', $host);
        Reflections::setProperty($this->router, 'db', $db);
        Reflections::setProperty($this->router, 'alias', $alias);
        Reflections::setProperty($this->router, 'table', $table);
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setResource', $args);        
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function setIdProvider()
    {
        $data = [
            'with id' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/123456789'                    
                ],
                'host' => 'h1',
                'alias' => 'sscp',
                'table' => 'dati_acquisiti',
                'expected' => '123456789'
            ],
            'without id' => [
                'args' => [
                    'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti'                    
                ],
                'host' => 'h1',
                'alias' => 'sscp',
                'table' => 'dati_acquisiti',
                'expected' => null
            ] 
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setId
     * @dataProvider setIdProvider
     */
    public function testSetIdEquals($args, $host, $alias, $table, $expected)
    {
        Reflections::setProperty($this->router, 'host', $host);
        Reflections::setProperty($this->router, 'alias', $alias);
        Reflections::setProperty($this->router, 'table', $table);
        
        Reflections::invokeMethod($this->router, 'setId', $args);
        
        $actual = Reflections::getProperty($this->router, 'id');
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setId
     */
    public function testSetIdException()
    {
        $host = 'topolino';
        $alias = 'pippo';
        $table = 'pluto';
        $args = [
            'path' => 'http://localhost/crud/api/h1/sscp/dati_acquisiti/123456789'
        ];
        
        Reflections::setProperty($this->router, 'host', $host);
        Reflections::setProperty($this->router, 'alias', $alias);
        Reflections::setProperty($this->router, 'table', $table);
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setId', $args);        
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function setQueryTypeProvider()
    {
        $data = [
            'read' => [
                'args' => [
                    'method' => 'GET'                    
                ],
                'id' => '123456789',
                'expected' => 'read'
            ],
            'update put' => [
                'args' => [
                    'method' => 'PUT'                    
                ],
                'id' => '123456789',
                'expected' => 'update'
            ],
            'update patch' => [
                'args' => [
                    'method' => 'PATCH'                    
                ],
                'id' => '123456789',
                'expected' => 'update'
            ],
            'delete' => [
                'args' => [
                    'method' => 'DELETE'                    
                ],
                'id' => '123456789',
                'expected' => 'delete'
            ],
            'list' => [
                'args' => [
                    'method' => 'GET'                    
                ],
                'id' => NULL,
                'expected' => 'list'
            ],
            'create' => [
                'args' => [
                    'method' => 'POST'                    
                ],
                'id' => NULL,
                'expected' => 'create'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setQueryType
     * @dataProvider setQueryTypeProvider
     */
    public function testSetQueryTypeEquals($args, $id, $expected)
    {
        Reflections::setProperty($this->router, 'id', $id);
        
        Reflections::invokeMethod($this->router, 'setQueryType', $args);
        
        $actual = Reflections::getProperty($this->router, 'queryType');
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setQueryType
     */
    public function testSetQueryTypeException()
    {
        $id =  null;
        $args = [
            'method' => 'PUT'
        ];
        
        Reflections::setProperty($this->router, 'id', $id);
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setQueryType', $args);        
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function setQueryParamsProvider()
    {
        $data = [
            'read' => [
                'args' => [],
                'table' => 'dati_acquisiti',
                'queryType' => 'read',
                'expected' => [
                    'fields' => [
                        0 => [
                            'name' => 'id_dato',
                            'alias' => 'id',
                            'type' => 'integer'
                        ],
                        1 => [
                            'name' => 'variabile',
                            'alias' => null,
                            'type' => 'integer'
                        ],
                        2 => [
                            'name' => 'valore',
                            'alias' => null,
                            'type' => 'float'
                        ],
                        3 => [
                            'name' => 'CONVERT(varchar, data_e_ora, 20)',
                            'alias' => 'data_e_ora',
                            'type' => 'dateTime'
                        ],
                        4 => [
                            'name' => 'tipo_dato',
                            'alias' => null,
                            'type' => 'integer'
                        ]
                    ],
                    'table' => 'dati_acquisiti',
                    'where' => [
                        'and' => [
                            0 => [
                                'field' => 'id_dato',
                                'operator' => '=',
                                'value' => [
                                    'param' => 'id',
                                    'bind' => ':id_dato',
                                    'type' => 'int',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'integer',
                                        'params' => []
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'order' => [],
                    'type' => 'read'
                ]
            ],
            'list' => [
                'args' => [],
                'table' => 'dati_acquisiti',
                'queryType' => 'list',
                'expected' => [
                    'fields' => [
                        0 => [
                            'name' => 'id_dato',
                            'alias' => 'id',
                            'type' => 'integer'
                        ],
                        1 => [
                            'name' => 'variabile',
                            'alias' => null,
                            'type' => 'integer'
                        ],
                        2 => [
                            'name' => 'valore',
                            'alias' => null,
                            'type' => 'float'
                        ],
                        3 => [
                            'name' => 'CONVERT(varchar, data_e_ora, 20)',
                            'alias' => 'data_e_ora',
                            'type' => 'dateTime'
                        ],
                        4 => [
                            'name' => 'tipo_dato',
                            'alias' => null,
                            'type' => 'integer'
                        ]
                    ],
                    'table' => 'dati_acquisiti',
                    'where' => [
                        'and' => [
                            0 => [
                                'field' => 'variabile',
                                'operator' => '=',
                                'value' => [
                                    'param' => 'var',
                                    'bind' => ':variabile',
                                    'type' => 'int',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'integer',
                                        'params' => []
                                    ]
                                ]
                            ],
                            1 => [
                                'field' => 'tipo_dato',
                                'operator' => '=',
                                'value' => [
                                    'param' => 'type',
                                    'bind' => ':tipoDato',
                                    'type' => 'int',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'enum',
                                        'params' => [
                                            0 => [
                                                0 => 1,
                                                1 => 2
                                            ]
                                        ]
                                    ]
                                ]
                            ],
                            2 => [
                                'field' => 'data_e_ora',
                                'operator' => '>=',
                                'value' => [
                                    'param' => 'datefrom',
                                    'bind' => ':dataIniziale',
                                    'type' => 'str',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'dateTime',
                                        'params' => [
                                            0 => true
                                        ]
                                    ]
                                ]
                            ],
                            3 => [
                                'field' => 'data_e_ora',
                                'operator' => '<',
                                'value' => [
                                    'param' => 'dateto',
                                    'bind' => ':dataFinale',
                                    'type' => 'str',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'dateTime',
                                        'params' => [
                                            0 => true
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'order' => [
                        0 => [
                            'field' => 'data_e_ora',
                            'type' => 'asc'
                        ]
                    ],
                    'type' => 'list'
                ]
            ],
            'create' => [
                'args' => [],
                'table' => 'dati_acquisiti',
                'queryType' => 'create',
                'expected' => [                        
                    'table' => 'dati_acquisiti',
                    'type' => 'create',
                    'values' => [
                        0 => [
                            'field' => 'variabile',
                            'value' => [
                                'param' => 'var',
                                'bind' => ':variabile',
                                'type' => 'int',
                                'null' => false,
                                'check' => [
                                    'type' => 'integer',
                                    'params' => []
                                ]
                            ]
                        ],
                        1 => [
                            'field' => 'tipo_dato',
                            'value' => [
                                'param' => 'type',
                                'bind' => ':tipoDato',
                                'type' => 'int',
                                'null' => false,
                                'check' => [
                                    'type' => 'enum',
                                    'params' => [
                                        0 => [
                                            0 => 1,
                                            1 => 2
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        2 => [
                            'field' => 'data_e_ora',
                            'value' => [
                                'param' => 'date',
                                'bind' => ':data_e_ora',
                                'type' => 'str',
                                'null' => false,
                                'check' => [
                                    'type' => 'dateTime',
                                    'params' => [
                                        0 => true
                                    ]
                                ]
                            ]
                        ],
                        3 => [
                            'field' => 'valore',
                            'value' => [
                                'param' => 'val',
                                'bind' => ':valore',
                                'type' => 'int',
                                'null' => false,
                                'check' => [
                                    'type' => 'float',
                                    'params' => []
                                ]
                            ]
                        ],
                        4 => [
                            'field' => 'unita_misura',
                            'value' => [
                                'param' => 'unit',
                                'bind' => ':unita_misura',
                                'type' => 'str',
                                'null' => true,
                                'check' => [
                                    'type' => 'str',
                                    'params' => []
                                ]
                            ]
                        ],
                        5 => [
                            'field' => 'impianto',
                            'value' => [
                                'param' => 'imp',
                                'bind' => ':impianto',
                                'type' => 'int',
                                'null' => true,
                                'check' => [
                                    'type' => 'int',
                                    'params' => []
                                ]
                            ]
                        ]
                    ]
                ]                    
            ],
            'update' => [
                'args' => [],
                'table' => 'dati_acquisiti',
                'queryType' => 'update',
                'expected' => [                        
                    'table' => 'dati_acquisiti',
                    'type' => 'update',
                    'set' => [
                        0 => [
                            'field' => 'variabile',
                            'value' => [
                                'param' => 'var',
                                'bind' => ':variabile',
                                'type' => 'int',
                                'null' => true,
                                'check' => [
                                    'type' => 'integer',
                                    'params' => []
                                ]
                            ]
                        ],
                        1 => [
                            'field' => 'tipo_dato',
                            'value' => [
                                'param' => 'type',
                                'bind' => ':tipoDato',
                                'type' => 'int',
                                'null' => true,
                                'check' => [
                                    'type' => 'enum',
                                    'params' => [
                                        0 => [
                                            0 => 1,
                                            1 => 2
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        2 => [
                            'field' => 'data_e_ora',
                            'value' => [
                                'param' => 'date',
                                'bind' => ':data_e_ora',
                                'type' => 'str',
                                'null' => true,
                                'check' => [
                                    'type' => 'dateTime',
                                    'params' => [
                                        0 => true
                                    ]
                                ]
                            ]
                        ],
                        3 => [
                            'field' => 'valore',
                            'value' => [
                                'param' => 'val',
                                'bind' => ':valore',
                                'type' => 'int',
                                'null' => true,
                                'check' => [
                                    'type' => 'float',
                                    'params' => []
                                ]
                            ]
                        ],
                        4 => [
                            'field' => 'unita_misura',
                            'value' => [
                                'param' => 'unit',
                                'bind' => ':unita_misura',
                                'type' => 'str',
                                'null' => true,
                                'check' => [
                                    'type' => 'str',
                                    'params' => []
                                ]
                            ]
                        ],
                        5 => [
                            'field' => 'impianto',
                            'value' => [
                                'param' => 'imp',
                                'bind' => ':impianto',
                                'type' => 'int',
                                'null' => true,
                                'check' => [
                                    'type' => 'int',
                                    'params' => []
                                ]
                            ]
                        ]
                    ],
                    'where' => [
                        'and' => [
                            0 => [
                                'field' => 'id_dato',
                                'operator' => '=',
                                'value' => [
                                    'param' => 'id',
                                    'bind' => ':id_dato',
                                    'type' => 'int',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'integer',
                                        'params' => []
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'delete' => [
                'args' => [],
                'table' => 'dati_acquisiti',
                'queryType' => 'delete',
                'expected' => [                        
                    'table' => 'dati_acquisiti',
                    'type' => 'delete',
                    'where' => [
                        'and' => [
                            0 => [
                                'field' => 'id_dato',
                                'operator' => '=',
                                'value' => [
                                    'param' => 'id',
                                    'bind' => ':id_dato',
                                    'type' => 'int',
                                    'null' => false,
                                    'check' => [
                                        'type' => 'integer',
                                        'params' => []
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setQueryParams
     * @dataProvider setQueryParamsProvider
     */
    public function testSetQueryParamsEquals($args, $table, $queryType, $expected)
    {
        Reflections::setProperty($this->router, 'table', $table);
        Reflections::setProperty($this->router, 'queryType', $queryType);
        
        Reflections::invokeMethod($this->router, 'setQueryParams', $args);
        
        $actual = Reflections::getProperty($this->router, 'queryParams');
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setQueryParams
     */
    public function testSetQueryParamsException()
    {
        $args = [];
        $table = 'pippo';
        $queryType = 'read';
        
        Reflections::setProperty($this->router, 'table', $table);
        Reflections::setProperty($this->router, 'queryType', $queryType);
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setQueryParams', $args);        
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setQueryParams
     */
    public function testSetQueryParamsMethodException()
    {
        $args = [];
        $table = 'variabili_sync';
        $queryType = 'read';
        
        Reflections::setProperty($this->router, 'table', $table);
        Reflections::setProperty($this->router, 'queryType', $queryType);
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setQueryParams', $args);        
    }
    
    /**
     * @group router
     * @coversNothing
     */
    public function setUrlParamsProvider()
    {
        $data = [
            'list' => [
                'args' => [],
                'id' => null,
                'input' => [
                    'var' => 10230,
                    'val' => 3.9
                ],
                'queryType' => 'list',
                'expected' => [
                    'var' => 10230,
                    'val' => 3.9
                ]
            ],
            'create' => [
                'args' => [],
                'id' => null,
                'input' => [
                    'var' => 10230,
                    'val' => 3.9
                ],
                'queryType' => 'create',
                'expected' => [
                    'var' => 10230,
                    'val' => 3.9
                ]
            ],
            'read' => [
                'args' => [],
                'id' => '123456',
                'input' => [],
                'queryType' => 'read',
                'expected' => [
                    'id' => '123456'
                ]
            ],
            'delete' => [
                'args' => [],
                'id' => '123456',
                'input' => [],
                'queryType' => 'delete',
                'expected' => [
                    'id' => '123456'
                ]
            ],
            'update' => [
                'args' => [],
                'id' => '123456',
                'input' => [
                    'var' => 10230,
                    'val' => 3.9
                ],
                'queryType' => 'update',
                'expected' => [
                    'id' => '123456',
                    'var' => 10230,
                    'val' => 3.9
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setUrlParams
     * @dataProvider setUrlParamsProvider
     */
    public function testSetUrlParamsEquals($args, $id, $input, $queryType, $expected)
    {
        Reflections::setProperty($this->router, 'id', $id);
        Reflections::setProperty($this->router, 'input', $input);
        Reflections::setProperty($this->router, 'queryType', $queryType);
        
        Reflections::invokeMethod($this->router, 'setUrlParams', $args);
        
        $actual = Reflections::getProperty($this->router, 'urlParams');
        
        $this->assertEquals($expected, $actual);         
    } 
    
    /**
     * @group router
     * @covers \vaniacarta74\Crud\Router::setUrlParams
     */
    public function testSetUrlParamsException()
    {
        $args = [];
        $id = '123456';
        $input = [];
        $queryType = 'list';
        
        Reflections::setProperty($this->router, 'id', $id);
        Reflections::setProperty($this->router, 'input', $input);
        Reflections::setProperty($this->router, 'queryType', $queryType);
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->router, 'setUrlParams', $args);        
    }
}
