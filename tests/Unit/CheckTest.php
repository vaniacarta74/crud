<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\Unit;

use PHPUnit\Framework\TestCase;
use vaniacarta74\Crud\Check;

/**
 * Description of CheckTest
 *
 * @author Vania
 */
class CheckTest extends TestCase
{
    /**
     * @group check
     * @coversNothing
     */
    public function isDateProvider()
    {
        $data = [
            'standard latin' => [
                'value' => '01/01/2021',
                'isSmall' => null,
                'expected' => true
            ],
            'standard anglo' => [
                'value' => '2021-12-31',
                'isSmall' => null,
                'expected' => true
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isDate
     * @dataProvider isDateProvider
     */
    public function testIsDateEquals($value, $isSmall = null, $expected)
    {
        $actual = Check::isDate($value, $isSmall);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isDate
     */
    public function testIsDateException()
    {
        $value = 'pippo';
        
        $this->setExpectedException('Exception');
        
        Check::isDate($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isValidDateProvider()
    {
        $data = [
            'standard small' => [
                'value' => '01/01/2021',
                'isSmall' => true,
                'expected' => true
            ],
            'standard not small' => [
                'value' => '01/01/2100',
                'isSmall' => false,
                'expected' => true
            ],
            'not valid' => [
                'value' => '32/01/2100',
                'isSmall' => false,
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isValidDate
     * @dataProvider isValidDateProvider
     */
    public function testIsValidDateEquals($value, $isSmall, $expected)
    {
        $actual = Check::isValidDate($value, $isSmall);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isValidDateExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 1234566789,
                'small' => true
            ],
            'no bool' => [
                'value' => '01/01/2021',
                'small' => 'pippo'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isValidDate
     * @dataProvider isValidDateExceptionProvider
     */
    public function testIsValidDateException($value, $isSmall)
    {
        $this->setExpectedException('Exception');
        
        Check::isValidDate($value, $isSmall);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isSmallDateProvider()
    {
        $data = [
            'small' => [
                'value' => '01/01/2021',
                'expected' => true
            ],
            'no small' => [
                'value' => '06/06/2079',
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isSmallDate
     * @dataProvider isSmallDateProvider
     */
    public function testIsSmallDateEquals($value, $expected)
    {
        $actual = Check::isSmallDate($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isSmallDateExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 1234566789
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isSmallDate
     * @dataProvider isSmallDateExceptionProvider
     */
    public function testIsSmallDateException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isSmallDate($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isTimeProvider()
    {
        $data = [
            'time' => [
                'value' => '23:59:59',
                'expected' => true
            ],
            'wrong time' => [
                'value' => '24:59:59',
                'expected' => false
            ],
            'wrong format' => [
                'value' => '23:59',
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isTime
     * @dataProvider isTimeProvider
     */
    public function testIsTimeEquals($value, $expected)
    {
        $actual = Check::isTime($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isTimeExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 1234566789
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isTime
     * @dataProvider isTimeExceptionProvider
     */
    public function testIsTimeException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isTime($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isLatinDateProvider()
    {
        $data = [
            'standard' => [
                'value' => '01/01/2021',
                'expected' => true
            ],
            'latin bat wrong' => [
                'value' => '32/01/2021',
                'expected' => true
            ],
            'no latin' => [
                'value' => '2021-12-31',
                'expected' => false
            ],
            'wrong format' => [
                'value' => '31/12/21',
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isLatinDate
     * @dataProvider isLatinDateProvider
     */
    public function testIsLatinDateEquals($value, $expected)
    {
        $actual = Check::isLatinDate($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isLatinDateExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 1234566789
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isLatinDate
     * @dataProvider isLatinDateExceptionProvider
     */
    public function testIsLatinDateException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isLatinDate($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isAngloDateProvider()
    {
        $data = [
            'standard' => [
                'value' => '2021-12-31',
                'expected' => true
            ],
            'latin bat wrong' => [
                'value' => '2021-12-32',
                'expected' => true
            ],
            'no anglo' => [
                'value' => '31/12/2021',
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isAngloDate
     * @dataProvider isAngloDateProvider
     */
    public function testIsAngloDateEquals($value, $expected)
    {
        $actual = Check::isAngloDate($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isAngloDateExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 1234566789
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isAngloDate
     * @dataProvider isAngloDateExceptionProvider
     */
    public function testIsAngloDateException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isAngloDate($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isLatinDateTimeProvider()
    {
        $data = [
            'standard T' => [
                'value' => '31/12/2021T23:59:59',
                'expected' => true
            ],
            'standard space' => [
                'value' => '31/12/2021 23:59:59',
                'expected' => true
            ],
            'no latin' => [
                'value' => '2021-12-31T23:59:59',
                'expected' => false
            ],
            'no time' => [
                'value' => '31/12/2021',
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isLatinDateTime
     * @dataProvider isLatinDateTimeProvider
     */
    public function testIsLatinDateTimeEquals($value, $expected)
    {
        $actual = Check::isLatinDateTime($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isLatinDateTimeExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 1234566789
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isLatinDateTime
     * @dataProvider isLatinDateTimeExceptionProvider
     */
    public function testIsLatinDateTimeException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isLatinDateTime($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isAngloDateTimeProvider()
    {
        $data = [
            'standard T' => [
                'value' => '2021-12-31T23:59:59',
                'expected' => true
            ],
            'standard space' => [
                'value' => '2021-12-31 23:59:59',
                'expected' => true
            ],
            'no latin' => [
                'value' => '31/12/2021T23:59:59',
                'expected' => false
            ],
            'no time' => [
                'value' => '2021-12-31',
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isAngloDateTime
     * @dataProvider isAngloDateTimeProvider
     */
    public function testIsAngloDateTimeEquals($value, $expected)
    {
        $actual = Check::isAngloDateTime($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isAngloDateTimeExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 1234566789
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isAngloDateTime
     * @dataProvider isAngloDateTimeExceptionProvider
     */
    public function testIsAngloDateTimeException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isAngloDateTime($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isDateTimeProvider()
    {
        $data = [
            'standard small' => [
                'value' => '01/01/2021T23:59:59',
                'isSmall' => null,
                'expected' => true
            ],
            'standard not small' => [
                'value' => '01/01/2121T23:59:59',
                'isSmall' => null,
                'expected' => true
            ],
            'standard small' => [
                'value' => '01/01/2121T23:59:59',
                'isSmall' => true,
                'expected' => false
            ],
            'valid no time' => [
                'value' => '31/01/2021',
                'isSmall' => null,
                'expected' => true
            ],
            'no valid date' => [
                'value' => '32/01/2021T23:59:59',
                'isSmall' => null,
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isDateTime
     * @dataProvider isDateTimeProvider
     */
    public function testIsDateTimeEquals($value, $isSmall = null, $expected)
    {
        $actual = Check::isDateTime($value, $isSmall);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isDateTimeExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => '12345667890T1234',
                'small' => true
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isDateTime
     * @dataProvider isDateTimeExceptionProvider
     */
    public function testIsDateTimeException($value, $isSmall)
    {
        $this->setExpectedException('Exception');
        
        Check::isDateTime($value, $isSmall);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isIntegerProvider()
    {
        $data = [
            'string' => [
                'value' => '10',
                'expected' => true
            ],
            'numeric' => [
                'value' => 10,
                'expected' => true
            ],
            'negative' => [
                'value' => -10,
                'expected' => false
            ],
            'float' => [
                'value' => 10.4,
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isInteger
     * @dataProvider isIntegerProvider
     */
    public function testIsIntegerEquals($value, $expected)
    {
        $actual = Check::isInteger($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isIntegerExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 'pippo'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isInteger
     * @dataProvider isIntegerExceptionProvider
     */
    public function testIsIntegerException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isInteger($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isFloatProvider()
    {
        $data = [
            'string' => [
                'value' => '10.4',
                'expected' => true
            ],
            'numeric' => [
                'value' => 10.4,
                'expected' => true
            ],
            'negative' => [
                'value' => -10.4,
                'expected' => false
            ],
            'exponential' => [
                'value' => '0.4e4',
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isFloat
     * @dataProvider isFloatProvider
     */
    public function testIsFloatEquals($value, $expected)
    {
        $actual = Check::isFloat($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isFloatExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 'pippo'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isFloat
     * @dataProvider isFloatExceptionProvider
     */
    public function testIsFloatException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isFloat($value);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isEnumProvider()
    {
        $data = [
            'true' => [
                'value' => 'pippo',
                'admitted' => [
                    'pippo',
                    'pluto',
                    'paperino'
                ],
                'expected' => true
            ],
            'false' => [
                'value' => 'topolino',
                'admitted' => [
                    'pippo',
                    'pluto',
                    'paperino'
                ],
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isEnum
     * @dataProvider isEnumProvider
     */
    public function testIsEnumEquals($value, $admitted, $expected)
    {
        $actual = Check::isEnum($value, $admitted);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isEnumExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => 1234566789,
                'admitted' => []
            ],
            'no bool' => [
                'value' => 'pippo',
                'admitted' => 'pippo'
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isEnum
     * @dataProvider isEnumExceptionProvider
     */
    public function testIsEnumException($value, $admitted)
    {
        $this->setExpectedException('Exception');
        
        Check::isEnum($value, $admitted);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isStringProvider()
    {
        $data = [
            'string' => [
                'value' => 'pippo',
                'expected' => true
            ],
            'number' => [
                'value' => '12345',
                'expected' => true
            ],
            'void' => [
                'value' => '',
                'expected' => false
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isString
     * @dataProvider isStringProvider
     */
    public function testIsStringEquals($value, $expected)
    {
        $actual = Check::isString($value);
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @group check
     * @coversNothing
     */
    public function isStringExceptionProvider()
    {
        $data = [
            'no string' => [
                'value' => []
            ]
        ];
        
        return $data;
    }
    
    /**
     * @group check
     * @covers \vaniacarta74\Crud\Check::isString
     * @dataProvider isStringExceptionProvider
     */
    public function testIsStringException($value)
    {
        $this->setExpectedException('Exception');
        
        Check::isString($value);
    }
}
