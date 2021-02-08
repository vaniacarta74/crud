<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Validator;
use vaniacarta74\Crud\tests\classes\Reflections;

/**
 * Description of ValidatorTest
 *
 * @author Vania
 */
class ValidatorTest extends TestCase
{
    private $validator;
    
    protected function setUp()
    {
        $queryParams = [                        
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
        ];
        $urlParams = [
            'id' => '101700184'    
        ];
        $this->validator = new Validator($queryParams, $urlParams);
    }
    
    protected function tearDown()
    {
        $this->validator = null;
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function constructorProvider()
    {
        $data = [
            'all' => [
                'args' => [
                    'queryParams' => [
                        'fields' => [],
                        'table' => 'variabili_sync',
                        'where' => [],
                        'order' => [],
                        'type' => 'all'
                    ],
                    'urlParams' => [
                        'id' => 'ALL'
                    ]
                ],
                'expecteds' => [
                    'rawParams' => [],
                    'completeParams' => [],
                    'validParams' => [],
                    'binders' => [],
                    'purgedQuery' => [
                        'fields' => [],
                        'table' => 'variabili_sync',
                        'where' => [],
                        'order' => [],
                        'type' => 'all'
                    ]
                ]    
            ],
            'read' => [
                'args' => [
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
                ],
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ]
                    ],
                    'completeParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '4000000'
                        ]
                    ],
                    'validParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '4000000'
                        ]
                    ],
                    'binders' => [
                        0 => ':id_dato'
                    ],
                    'purgedQuery' => [
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
                ]    
            ],
            'list' => [
                'args' => [
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
                ],
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ],
                        1 => [
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
                        ],
                        2 => [
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
                        ],
                        3 => [
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
                    ],
                    'completeParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '10230'
                        ],
                        1 => [
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
                            ],
                            'value' => '2'
                        ],
                        2 => [
                            'param' => 'datefrom',
                            'bind' => ':dataIniziale',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '27/08/2017T00:00:00'
                        ],
                        3 => [
                            'param' => 'dateto',
                            'bind' => ':dataFinale',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '27/08/2017T01:00:00'
                        ]
                    ],
                    'validParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '10230'
                        ],
                        1 => [
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
                            ],
                            'value' => '2'
                        ],
                        2 => [
                            'param' => 'datefrom',
                            'bind' => ':dataIniziale',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '27/08/2017T00:00:00'
                        ],
                        3 => [
                            'param' => 'dateto',
                            'bind' => ':dataFinale',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '27/08/2017T01:00:00'
                        ]
                    ],
                    'binders' => [
                        0 => ':variabile',
                        1 => ':tipoDato',
                        2 => ':dataIniziale',
                        3 => ':dataFinale'
                    ],
                    'purgedQuery' => [
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
                ]    
            ],
            'create' => [
                'args' => [
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
                ], 
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ],
                        1 => [
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
                        ],
                        2 => [
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
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ]
                        ],
                        4 => [
                            'param' => 'unit',
                            'bind' => ':unita_misura',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'str',
                                'params' => []
                            ]
                        ],
                        5 => [
                            'param' => 'imp',
                            'bind' => ':impianto',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'int',
                                'params' => []
                            ]
                        ]
                    ],
                    'completeParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '10230'
                        ],
                        1 => [
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
                            ],
                            'value' => '2'
                        ],
                        2 => [
                            'param' => 'date',
                            'bind' => ':data_e_ora',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '01/01/2021'
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ],
                            'value' => '3.5'
                        ],
                        4 => [
                            'param' => 'unit',
                            'bind' => ':unita_misura',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'str',
                                'params' => []
                            ],
                            'value' => null
                        ],
                        5 => [
                            'param' => 'imp',
                            'bind' => ':impianto',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'int',
                                'params' => []
                            ],
                            'value' => null
                        ]
                    ],
                    'validParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '10230'
                        ],
                        1 => [
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
                            ],
                            'value' => '2'
                        ],
                        2 => [
                            'param' => 'date',
                            'bind' => ':data_e_ora',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '01/01/2021'
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ],
                            'value' => '3.5'
                        ]
                    ],
                    'binders' => [
                        0 => ':variabile',
                        1 => ':tipoDato',
                        2 => ':data_e_ora',
                        3 => ':valore'
                    ],
                    'purgedQuery' => [
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
                            ]
                        ]
                    ]
                ]    
            ],
            'update' => [
                'args' => [
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
                ],
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ],
                        1 => [
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
                        ],
                        2 => [
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
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ]
                        ],
                        4 => [
                            'param' => 'unit',
                            'bind' => ':unita_misura',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'str',
                                'params' => []
                            ]
                        ],
                        5 => [
                            'param' => 'imp',
                            'bind' => ':impianto',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'int',
                                'params' => []
                            ]
                        ],
                        6 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ]
                    ],
                    'completeParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => null
                        ],
                        1 => [
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
                            ],
                            'value' => null
                        ],
                        2 => [
                            'param' => 'date',
                            'bind' => ':data_e_ora',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '02/01/2020'
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ],
                            'value' => '1.9'
                        ],
                        4 => [
                            'param' => 'unit',
                            'bind' => ':unita_misura',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'str',
                                'params' => []
                            ],
                            'value' => null
                        ],
                        5 => [
                            'param' => 'imp',
                            'bind' => ':impianto',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'int',
                                'params' => []
                            ],
                            'value' => null
                        ],
                        6 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '101700175'
                        ]
                    ],
                    'validParams' => [
                        2 => [
                            'param' => 'date',
                            'bind' => ':data_e_ora',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '02/01/2020'
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ],
                            'value' => '1.9'
                        ],
                        6 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '101700175'
                        ]
                    ],
                    'binders' => [
                        2 => ':data_e_ora',
                        3 => ':valore',
                        6 => ':id_dato'
                    ],
                    'purgedQuery' => [
                        'table' => 'dati_acquisiti',
                        'type' => 'update',
                        'set' => [                            
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
                ]    
            ],
            'delete' => [
                'args' => [
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
                ], 
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ]
                    ],
                    'completeParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '101700184'
                        ]
                    ],
                    'validParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '101700184'
                        ]
                    ],
                    'binders' => [
                        0 => ':id_dato'
                    ],
                    'purgedQuery' => [
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
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::__construct
     * @dataProvider constructorProvider
     */
    public function testConstructorEquals($args, $expected)
    {
        Reflections::setProperty($this->validator, 'binders', []);
        Reflections::invokeConstructor($this->validator, $args);
        
        $actual['rawParams'] = Reflections::getProperty($this->validator, 'rawParams');
        $actual['completeParams'] = Reflections::getProperty($this->validator, 'completeParams');
        $actual['validParams'] = Reflections::getProperty($this->validator, 'validParams');
        $actual['binders'] = Reflections::getProperty($this->validator, 'binders');
        $actual['purgedQuery'] = Reflections::getProperty($this->validator, 'purgedQuery');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::__construct
     */
    public function testConstructorException()
    {
        $args = [
            'queryParams' => 'pippo',
            'urlParams' => 'pluto'
        ];
        
        $this->setExpectedException('Exception');
        
        Reflections::invokeConstructor($this->validator, $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function setRawParamsProvider()
    {
        $data = [
            'all' => [
                'args' => [
                    'queryParams' => [
                        'fields' => [],
                        'table' => 'variabili_sync',
                        'where' => [],
                        'order' => [],
                        'type' => 'all'
                    ]                    
                ],
                'expecteds' => [
                    'rawParams' => []
                ]    
            ],
            'read' => [
                'args' => [
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
                    ]                    
                ],
                'expecteds' => [
                    'rawParams' => [
                        0 => [
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
            'list' => [
                'args' => [
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
                    ]
                ],
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ],
                        1 => [
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
                        ],
                        2 => [
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
                        ],
                        3 => [
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
                    ],
                ]    
            ],
            'create' => [
                'args' => [
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
                    ]
                ], 
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ],
                        1 => [
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
                        ],
                        2 => [
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
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ]
                        ],
                        4 => [
                            'param' => 'unit',
                            'bind' => ':unita_misura',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'str',
                                'params' => []
                            ]
                        ],
                        5 => [
                            'param' => 'imp',
                            'bind' => ':impianto',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'int',
                                'params' => []
                            ]
                        ]
                    ],
                ]    
            ],
            'update' => [
                'args' => [
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
                ],
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ],
                        1 => [
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
                        ],
                        2 => [
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
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ]
                        ],
                        4 => [
                            'param' => 'unit',
                            'bind' => ':unita_misura',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'str',
                                'params' => []
                            ]
                        ],
                        5 => [
                            'param' => 'imp',
                            'bind' => ':impianto',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'int',
                                'params' => []
                            ]
                        ],
                        6 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ]
                    ],
                ]    
            ],
            'delete' => [
                'args' => [
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
                ], 
                'expecteds' => [
                    'rawParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ]
                        ]
                    ],
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::setRawParams
     * @dataProvider setRawParamsProvider
     */
    public function testSetRawParamsEquals($args, $expected)
    {
        Reflections::invokeMethod($this->validator, 'setRawParams', $args);
        
        $actual['rawParams'] = Reflections::getProperty($this->validator, 'rawParams');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function setRawParamsExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'queryParams' => 'pippo'
                ]
            ],
            'no key' => [
                'args' => [
                    'queryParams' => [
                        'pippo' => 'pluto'
                    ]
                ]
            ],
            'wrong type' => [
                'args' => [
                    'queryParams' => [
                        'type' => 'pluto'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::setRawParams
     * @dataProvider setRawParamsExceptionProvider
     */
    public function testSetRawParamsException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'setRawParams', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getAllParamsProvider()
    {
        $data = [
            'all' => [
                'args' => [
                    'queryParams' => [
                        'fields' => [],
                        'table' => 'variabili_sync',
                        'where' => [],
                        'order' => [],
                        'type' => 'all'
                    ]                    
                ],
                'expecteds' => []    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getAllParams
     * @dataProvider getAllParamsProvider
     */
    public function testGetAllParamsEquals($args, $expected)
    {
        $actual = Reflections::invokeMethod($this->validator, 'getAllParams', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getAllParamsExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'queryParams' => 'pippo'
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getAllParams
     * @dataProvider getAllParamsExceptionProvider
     */
    public function testGetAllParamsException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'getAllParams', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getReadParamsProvider()
    {
        $data = [
            'read' => [
                'args' => [
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
                    ]                    
                ],
                'expecteds' => [
                    0 => [
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
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getReadParams
     * @dataProvider getReadParamsProvider
     */
    public function testGetReadParamsEquals($args, $expected)
    {
        $actual = Reflections::invokeMethod($this->validator, 'getReadParams', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getReadParamsExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'queryParams' => 'pippo'
                ]
            ],
            'no key' => [
                'args' => [
                    'queryParams' => [
                        'pippo' => 'pluto'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getReadParams
     * @dataProvider getReadParamsExceptionProvider
     */
    public function testGetReadParamsException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'getReadParams', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getListParamsProvider()
    {
        $data = [
            'list' => [
                'args' => [
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
                    ]
                ],
                'expecteds' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    1 => [
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
                    ],
                    2 => [
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
                    ],
                    3 => [
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
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getListParams
     * @dataProvider getListParamsProvider
     */
    public function testGetListParamsEquals($args, $expected)
    {
        $actual = Reflections::invokeMethod($this->validator, 'getListParams', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getListParamsExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'queryParams' => 'pippo'
                ]
            ],
            'no key' => [
                'args' => [
                    'queryParams' => [
                        'pippo' => 'pluto'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getListParams
     * @dataProvider getListParamsExceptionProvider
     */
    public function testGetListParamsException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'getListParams', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getCreateParamsProvider()
    {
        $data = [
            'create' => [
                'args' => [
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
                    ]
                ], 
                'expecteds' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    1 => [
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
                    ],
                    2 => [
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
                    ],
                    3 => [
                        'param' => 'val',
                        'bind' => ':valore',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'float',
                            'params' => []
                        ]
                    ],
                    4 => [
                        'param' => 'unit',
                        'bind' => ':unita_misura',
                        'type' => 'str',
                        'null' => true,
                        'check' => [
                            'type' => 'str',
                            'params' => []
                        ]
                    ],
                    5 => [
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
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getCreateParams
     * @dataProvider getCreateParamsProvider
     */
    public function testGetCreateParamsEquals($args, $expected)
    {
        $actual = Reflections::invokeMethod($this->validator, 'getCreateParams', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getCreateParamsExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'queryParams' => 'pippo'
                ]
            ],
            'no key' => [
                'args' => [
                    'queryParams' => [
                        'pippo' => 'pluto'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getCreateParams
     * @dataProvider getCreateParamsExceptionProvider
     */
    public function testGetCreateParamsException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'getCreateParams', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getUpdateParamsProvider()
    {
        $data = [
            'update' => [
                'args' => [
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
                    ]
                ],
                'expecteds' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    1 => [
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
                    ],
                    2 => [
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
                    ],
                    3 => [
                        'param' => 'val',
                        'bind' => ':valore',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'float',
                            'params' => []
                        ]
                    ],
                    4 => [
                        'param' => 'unit',
                        'bind' => ':unita_misura',
                        'type' => 'str',
                        'null' => true,
                        'check' => [
                            'type' => 'str',
                            'params' => []
                        ]
                    ],
                    5 => [
                        'param' => 'imp',
                        'bind' => ':impianto',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'int',
                            'params' => []
                        ]
                    ],
                    6 => [
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
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getUpdateParams
     * @dataProvider getUpdateParamsProvider
     */
    public function testGetUpdateParamsEquals($args, $expected)
    {
        $actual = Reflections::invokeMethod($this->validator, 'getUpdateParams', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getUpdateParamsExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'queryParams' => 'pippo'
                ]
            ],
            'no set key' => [
                'args' => [
                    'queryParams' => [
                        'where' => []
                    ]
                ]
            ],
            'no where key' => [
                'args' => [
                    'queryParams' => [
                        'set' => []
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getUpdateParams
     * @dataProvider getUpdateParamsExceptionProvider
     */
    public function testGetUpdateParamsException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'getUpdateParams', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getDeleteParamsProvider()
    {
        $data = [
            'delete' => [
                'args' => [
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
                    ]
                ], 
                'expecteds' => [
                    0 => [
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
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getDeleteParams
     * @dataProvider getDeleteParamsProvider
     */
    public function testGetDeleteParamsEquals($args, $expected)
    {
        $actual = Reflections::invokeMethod($this->validator, 'getDeleteParams', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function getDeleteParamsExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'queryParams' => 'pippo'
                ]
            ],
            'no key' => [
                'args' => [
                    'queryParams' => [
                        'pippo' => 'pluto'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::getDeleteParams
     * @dataProvider getDeleteParamsExceptionProvider
     */
    public function testGetDeleteParamsException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'getDeleteParams', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function goWhereDeepProvider()
    {
        $data = [
            'and' => [
                'args' => [
                    'rawParams' => [],
                    'params' => [                        
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
                'expecteds' => [
                    0 => [
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
            ],
            'or' => [
                'args' => [
                    'rawParams' => [],
                    'params' => [                        
                        'or' => [
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
                            ],
                            1 => [
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
                'expecteds' => [
                    0 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    1 => [
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
            ],
            'and 2 or' => [
                'args' => [
                    'rawParams' => [],
                    'params' => [
                        'and' => [
                            'or' => [
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
                                ],
                                1 => [
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
                            ],
                            'or2' => [
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
                                ],
                                1 => [
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
                'expecteds' => [
                    0 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    1 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    2 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    3 => [
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
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::goWhereDeep
     * @dataProvider goWhereDeepProvider
     */
    public function testGoWhereDeepEquals($args, $expected)
    {
        Reflections::invokeMethod($this->validator, 'goWhereDeep', $args);
        
        $actual = $args['rawParams'];
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function goWhereDeepExceptionProvider()
    {
        $data = [
            'no array 1' => [
                'args' => [
                    'rawParams' => 'pippo',
                    'params' => []
                ]
            ],
            'no array 2' => [
                'args' => [
                    'rawParams' => [],
                    'params' => 'pippo'
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::goWhereDeep
     * @dataProvider goWhereDeepExceptionProvider
     */
    public function testGoWhereDeepException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'goWhereDeep', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function setCompleteParamsProvider()
    {
        $data = [
            'all' => [
                'rawParams' => [],
                'args' => [
                    'urlParams' => [
                        'id' => 'ALL'
                    ]                   
                ],
                'expecteds' => [
                    'completeParams' => []
                ]    
            ],
            'read' => [
                'rawParams' => [
                    0 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ]
                ],
                'args' => [
                    'urlParams' => [
                        'id' => '4000000'
                    ]                   
                ],
                'expecteds' => [
                    'completeParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '4000000'
                        ]
                    ]
                ]    
            ],
            'list' => [
                'rawParams' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    1 => [
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
                    ],
                    2 => [
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
                    ],
                    3 => [
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
                ],
                'args' => [
                    'urlParams' => [
                        'var' => 10230,
                        'type' => 2,
                        'datefrom' => '27/08/2017T00:00:00',
                        'dateto' => '27/08/2017T01:00:00'
                    ]
                ],
                'expecteds' => [
                    'completeParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '10230'
                        ],
                        1 => [
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
                            ],
                            'value' => '2'
                        ],
                        2 => [
                            'param' => 'datefrom',
                            'bind' => ':dataIniziale',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '27/08/2017T00:00:00'
                        ],
                        3 => [
                            'param' => 'dateto',
                            'bind' => ':dataFinale',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '27/08/2017T01:00:00'
                        ]
                    ]
                ]    
            ],
            'create' => [
                'rawParams' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    1 => [
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
                    ],
                    2 => [
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
                    ],
                    3 => [
                        'param' => 'val',
                        'bind' => ':valore',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'float',
                            'params' => []
                        ]
                    ],
                    4 => [
                        'param' => 'unit',
                        'bind' => ':unita_misura',
                        'type' => 'str',
                        'null' => true,
                        'check' => [
                            'type' => 'str',
                            'params' => []
                        ]
                    ],
                    5 => [
                        'param' => 'imp',
                        'bind' => ':impianto',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'int',
                            'params' => []
                        ]
                    ]
                ],
                'args' => [
                    'urlParams' => [
                        'var' => 10230,
                        'type' => 2,
                        'date' => '01/01/2021',
                        'val' => 3.5
                    ]
                ], 
                'expecteds' => [
                    'completeParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '10230'
                        ],
                        1 => [
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
                            ],
                            'value' => '2'
                        ],
                        2 => [
                            'param' => 'date',
                            'bind' => ':data_e_ora',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '01/01/2021'
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ],
                            'value' => '3.5'
                        ],
                        4 => [
                            'param' => 'unit',
                            'bind' => ':unita_misura',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'str',
                                'params' => []
                            ],
                            'value' => null
                        ],
                        5 => [
                            'param' => 'imp',
                            'bind' => ':impianto',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'int',
                                'params' => []
                            ],
                            'value' => null
                        ]
                    ]
                ]    
            ],
            'update' => [
                'rawParams' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ],
                    1 => [
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
                    ],
                    2 => [
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
                    ],
                    3 => [
                        'param' => 'val',
                        'bind' => ':valore',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'float',
                            'params' => []
                        ]
                    ],
                    4 => [
                        'param' => 'unit',
                        'bind' => ':unita_misura',
                        'type' => 'str',
                        'null' => true,
                        'check' => [
                            'type' => 'str',
                            'params' => []
                        ]
                    ],
                    5 => [
                        'param' => 'imp',
                        'bind' => ':impianto',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'int',
                            'params' => []
                        ]
                    ],
                    6 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ]
                ],
                'args' => [
                    'urlParams' => [
                        'date' => '02/01/2020',
                        'val' => 1.9,
                        'id' => '101700175'
                    ]
                ],
                'expecteds' => [
                    'completeParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => null
                        ],
                        1 => [
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
                            ],
                            'value' => null
                        ],
                        2 => [
                            'param' => 'date',
                            'bind' => ':data_e_ora',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '02/01/2020'
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ],
                            'value' => '1.9'
                        ],
                        4 => [
                            'param' => 'unit',
                            'bind' => ':unita_misura',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'str',
                                'params' => []
                            ],
                            'value' => null
                        ],
                        5 => [
                            'param' => 'imp',
                            'bind' => ':impianto',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'int',
                                'params' => []
                            ],
                            'value' => null
                        ],
                        6 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '101700175'
                        ]
                    ]
                ]    
            ],
            'delete' => [
                'rawParams' => [
                    0 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ]
                ],
                'args' => [                    
                    'urlParams' => [
                        'id' => '101700184'
                    ]
                ], 
                'expecteds' => [
                    'completeParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '101700184'
                        ]
                    ],
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::setCompleteParams
     * @dataProvider setCompleteParamsProvider
     */
    public function testSetCompleteParamsEquals($rawParams, $args, $expected)
    {
        Reflections::setProperty($this->validator, 'rawParams', $rawParams);
        
        Reflections::invokeMethod($this->validator, 'setCompleteParams', $args);
        
        $actual['completeParams'] = Reflections::getProperty($this->validator, 'completeParams');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function setCompleteParamsExceptionProvider()
    {
        $data = [
            'no param' => [
                'rawParams' => [
                    0 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ]
                    ]
                ],
                'args' => [                    
                    'urlParams' => [
                        'pippo' => '101700184'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::setCompleteParams
     * @dataProvider setCompleteParamsExceptionProvider
     */
    public function testSetCompleteParamsException($rawParams, $args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::setProperty($this->validator, 'rawParams', $rawParams);
        
        Reflections::invokeMethod($this->validator, 'setCompleteParams', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function setValidParamsProvider()
    {
        $data = [
            'all' => [
                'completeParams' => [],
                'expecteds' => [
                    'binders' => [],
                    'validParams' => []
                ]    
            ],
            'read' => [
                'completeParams' => [
                    0 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ],
                        'value' => '4000000'
                    ]
                ],
                'expecteds' => [
                    'binders' => [
                        0 => ':id_dato'
                    ],
                    'validParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '4000000'
                        ]
                    ]
                ]    
            ],
            'list' => [
                'completeParams' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ],
                        'value' => '10230'
                    ],
                    1 => [
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
                        ],
                        'value' => '2'
                    ],
                    2 => [
                        'param' => 'datefrom',
                        'bind' => ':dataIniziale',
                        'type' => 'str',
                        'null' => false,
                        'check' => [
                            'type' => 'dateTime',
                            'params' => [
                                0 => true
                            ]
                        ],
                        'value' => '27/08/2017T00:00:00'
                    ],
                    3 => [
                        'param' => 'dateto',
                        'bind' => ':dataFinale',
                        'type' => 'str',
                        'null' => false,
                        'check' => [
                            'type' => 'dateTime',
                            'params' => [
                                0 => true
                            ]
                        ],
                        'value' => '27/08/2017T01:00:00'
                    ]
                ],
                'expecteds' => [
                    'binders' => [
                        0 => ':variabile',
                        1 => ':tipoDato',
                        2 => ':dataIniziale',
                        3 => ':dataFinale'
                    ],
                    'validParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '10230'
                        ],
                        1 => [
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
                            ],
                            'value' => '2'
                        ],
                        2 => [
                            'param' => 'datefrom',
                            'bind' => ':dataIniziale',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '27/08/2017T00:00:00'
                        ],
                        3 => [
                            'param' => 'dateto',
                            'bind' => ':dataFinale',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '27/08/2017T01:00:00'
                        ]
                    ]
                ]    
            ],
            'create' => [
                'completeParams' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ],
                        'value' => '10230'
                    ],
                    1 => [
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
                        ],
                        'value' => '2'
                    ],
                    2 => [
                        'param' => 'date',
                        'bind' => ':data_e_ora',
                        'type' => 'str',
                        'null' => false,
                        'check' => [
                            'type' => 'dateTime',
                            'params' => [
                                0 => true
                            ]
                        ],
                        'value' => '01/01/2021'
                    ],
                    3 => [
                        'param' => 'val',
                        'bind' => ':valore',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'float',
                            'params' => []
                        ],
                        'value' => '3.5'
                    ],
                    4 => [
                        'param' => 'unit',
                        'bind' => ':unita_misura',
                        'type' => 'str',
                        'null' => true,
                        'check' => [
                            'type' => 'str',
                            'params' => []
                        ],
                        'value' => null
                    ],
                    5 => [
                        'param' => 'imp',
                        'bind' => ':impianto',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'int',
                            'params' => []
                        ],
                        'value' => null
                    ]
                ],
                'expecteds' => [
                    'binders' => [
                        0 => ':variabile',
                        1 => ':tipoDato',
                        2 => ':data_e_ora',
                        3 => ':valore',
                    ],
                    'validParams' => [
                        0 => [
                            'param' => 'var',
                            'bind' => ':variabile',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '10230'
                        ],
                        1 => [
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
                            ],
                            'value' => '2'
                        ],
                        2 => [
                            'param' => 'date',
                            'bind' => ':data_e_ora',
                            'type' => 'str',
                            'null' => false,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '01/01/2021'
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ],
                            'value' => '3.5'
                        ]
                    ]
                ]    
            ],
            'update' => [
                'completeParams' => [
                    0 => [
                        'param' => 'var',
                        'bind' => ':variabile',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ],
                        'value' => null
                    ],
                    1 => [
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
                        ],
                        'value' => null
                    ],
                    2 => [
                        'param' => 'date',
                        'bind' => ':data_e_ora',
                        'type' => 'str',
                        'null' => true,
                        'check' => [
                            'type' => 'dateTime',
                            'params' => [
                                0 => true
                            ]
                        ],
                        'value' => '02/01/2020'
                    ],
                    3 => [
                        'param' => 'val',
                        'bind' => ':valore',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'float',
                            'params' => []
                        ],
                        'value' => '1.9'
                    ],
                    4 => [
                        'param' => 'unit',
                        'bind' => ':unita_misura',
                        'type' => 'str',
                        'null' => true,
                        'check' => [
                            'type' => 'str',
                            'params' => []
                        ],
                        'value' => null
                    ],
                    5 => [
                        'param' => 'imp',
                        'bind' => ':impianto',
                        'type' => 'int',
                        'null' => true,
                        'check' => [
                            'type' => 'int',
                            'params' => []
                        ],
                        'value' => null
                    ],
                    6 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ],
                        'value' => '101700175'
                    ]
                ],
                'expecteds' => [
                    'binders' => [
                        2 => ':data_e_ora',
                        3 => ':valore',
                        6 => ':id_dato'
                    ],
                    'validParams' => [
                        2 => [
                            'param' => 'date',
                            'bind' => ':data_e_ora',
                            'type' => 'str',
                            'null' => true,
                            'check' => [
                                'type' => 'dateTime',
                                'params' => [
                                    0 => true
                                ]
                            ],
                            'value' => '02/01/2020'
                        ],
                        3 => [
                            'param' => 'val',
                            'bind' => ':valore',
                            'type' => 'int',
                            'null' => true,
                            'check' => [
                                'type' => 'float',
                                'params' => []
                            ],
                            'value' => '1.9'
                        ],
                        6 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '101700175'
                        ]
                    ]
                ]    
            ],
            'delete' => [
                'completeParams' => [
                    0 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ],
                        'value' => '101700184'
                    ]
                ],                 
                'expecteds' => [
                    'binders' => [
                        0 => ':id_dato'
                    ],
                    'validParams' => [
                        0 => [
                            'param' => 'id',
                            'bind' => ':id_dato',
                            'type' => 'int',
                            'null' => false,
                            'check' => [
                                'type' => 'integer',
                                'params' => []
                            ],
                            'value' => '101700184'
                        ]
                    ]
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::setValidParams
     * @dataProvider setValidParamsProvider
     */
    public function testSetValidParamsEquals($completeParams, $expected)
    {
        Reflections::setProperty($this->validator, 'completeParams', $completeParams);
        Reflections::setProperty($this->validator, 'binders', []);
        
        Reflections::invokeMethod($this->validator, 'setValidParams');
        
        $actual['binders'] = Reflections::getProperty($this->validator, 'binders');
        $actual['validParams'] = Reflections::getProperty($this->validator, 'validParams');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function setValidParamsExceptionProvider()
    {
        $data = [
            'no param' => [
                'completeParams' => [
                    0 => [
                        'param' => 'id',
                        'bind' => ':id_dato',
                        'type' => 'int',
                        'null' => false,
                        'check' => [
                            'type' => 'integer',
                            'params' => []
                        ],
                        'value' => 34.5
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::setValidParams
     * @dataProvider setValidParamsExceptionProvider
     */
    public function testSetValidParamsException($completeParams)
    {
        $this->setExpectedException('Exception');
        
        Reflections::setProperty($this->validator, 'completeParams', $completeParams);
        
        Reflections::invokeMethod($this->validator, 'setValidParams');
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function purgeQueryProvider()
    {
        $data = [
            'all' => [
                'binders' => [],
                'args' => [
                    'queryParams' => [
                        'fields' => [],
                        'table' => 'variabili_sync',
                        'where' => [],
                        'order' => [],
                        'type' => 'all'
                    ]                    
                ],
                'expecteds' => [
                    'purgedQuery' => [
                        'fields' => [],
                        'table' => 'variabili_sync',
                        'where' => [],
                        'order' => [],
                        'type' => 'all'
                    ]
                ]    
            ],
            'read' => [
                'binders' => [
                    0 => 'id_dato'
                ],
                'args' => [
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
                    ]                    
                ],
                'expecteds' => [
                    'purgedQuery' => [
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
                ]    
            ],
            'list' => [
                'binders' => [
                    0 => ':variabile',
                    1 => ':tipoDato',
                    2 => ':dataIniziale',
                    3 => ':dataFinale'
                ],
                'args' => [
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
                    ]
                ],
                'expecteds' => [
                    'purgedQuery' => [
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
                ]    
            ],
            'create' => [
                'binders' => [
                    0 => ':variabile',
                    1 => ':tipoDato',
                    2 => ':data_e_ora',
                    3 => ':valore'
                ],
                'args' => [
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
                    ]
                ], 
                'expecteds' => [
                    'purgedQuery' => [                        
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
                            ]
                        ]
                    ]
                ]    
            ],
            'update' => [
                'binders' => [
                    2 => ':data_e_ora',
                    3 => ':valore',
                    6 => ':id_dato'
                ],
                'args' => [
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
                ],
                'expecteds' => [
                    'purgedQuery' => [                        
                        'table' => 'dati_acquisiti',
                        'type' => 'update',
                        'set' => [                            
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
                ]    
            ],
            'delete' => [
                'binders' => [
                    0 => ':id_dato'
                ],
                'args' => [
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
                    ]
                ], 
                'expecteds' => [
                    'purgedQuery' => [                        
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
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::purgeQuery
     * @dataProvider purgeQueryProvider
     */
    public function testPurgeQueryEquals($binders, $args, $expected)
    {
        Reflections::setProperty($this->validator, 'binders', $binders);
        
        Reflections::invokeMethod($this->validator, 'purgeQuery', $args);
        
        $actual['purgedQuery'] = Reflections::getProperty($this->validator, 'purgedQuery');
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function purgeQueryExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'queryParams' => 'pippo'
                ]
            ],
            'no key' => [
                'args' => [
                    'queryParams' => [
                        'pippo' => 'pluto'
                    ]
                ]
            ],
            'wrong type' => [
                'args' => [
                    'queryParams' => [
                        'type' => 'pluto'
                    ]
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::purgeQuery
     * @dataProvider purgeQueryExceptionProvider
     */
    public function testPurgeQueryException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'purgeQuery', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function purgeTypeProvider()
    {
        $data = [
            'create' => [
                'binders' => [
                    0 => ':variabile',
                    1 => ':tipoDato',
                    2 => ':data_e_ora',
                    3 => ':valore'
                ],
                'args' => [
                    'type' => 'values',
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
                    ]
                ], 
                'expecteds' => [
                    'purgedType' => [                        
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
                            ]
                        ]
                    ]
                ]    
            ],
            'update' => [
                'binders' => [
                    2 => ':data_e_ora',
                    3 => ':valore',
                    6 => ':id_dato'
                ],
                'args' => [
                    'type' => 'set',
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
                ],
                'expecteds' => [
                    'purgedType' => [                        
                        'table' => 'dati_acquisiti',
                        'type' => 'update',
                        'set' => [                            
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
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::purgeType
     * @dataProvider purgeTypeProvider
     */
    public function testPurgeTypeEquals($binders, $args, $expected)
    {
        Reflections::setProperty($this->validator, 'binders', $binders);
        
        $actual['purgedType'] = Reflections::invokeMethod($this->validator, 'purgeType', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function purgeTypeExceptionProvider()
    {
        $data = [
            'no string' => [
                'args' => [
                    'type' => [],
                    'queryParams' => []
                ]
            ],
            'no array' => [
                'args' => [
                    'type' => 'pippo',
                    'queryParams' => 'pluto'
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::purgeType
     * @dataProvider purgeTypeExceptionProvider
     */
    public function testPurgeTypeException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'purgeType', $args);
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function purgePartProvider()
    {
        $data = [
            'create' => [
                'binders' => [
                    0 => ':variabile',
                    1 => ':tipoDato',
                    2 => ':data_e_ora',
                    3 => ':valore'
                ],
                'args' => [
                    'part' => [
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
                'expecteds' => [
                    'purgedPart' => [
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
                        ]
                    ]
                ]    
            ],
            'update' => [
                'binders' => [
                    2 => ':data_e_ora',
                    3 => ':valore',
                    6 => ':id_dato'
                ],
                'args' => [
                    'part' => [
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
                    ]
                ],
                'expecteds' => [
                    'purgedPart' => [                            
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
                        ]
                    ]
                ]    
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::purgePart
     * @dataProvider purgePartProvider
     */
    public function testPurgePartEquals($binders, $args, $expected)
    {
        Reflections::setProperty($this->validator, 'binders', $binders);
        
        $actual['purgedPart'] = Reflections::invokeMethod($this->validator, 'purgePart', $args);
        
        $this->assertEquals($expected, $actual);         
    }
    
    /**
     * @group validator
     * @coversNothing
     */
    public function purgePartExceptionProvider()
    {
        $data = [
            'no array' => [
                'args' => [
                    'part' => 'pippo'
                ]
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group validator
     * @covers \vaniacarta74\Crud\Validator::purgePart
     * @dataProvider purgePartExceptionProvider
     */
    public function testPurgePartException($args)
    {
        $this->setExpectedException('Exception');
        
        Reflections::invokeMethod($this->validator, 'purgePart', $args);
    }
}
