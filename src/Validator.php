<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Error;
use vaniacarta74\Crud\Utility;
use vaniacarta74\Crud\Check;

/**
 * Description of Validator
 *
 * @author Vania
 */
class Validator
{
    private $rawParams;
    private $completeParams;
    private $validParams;
    private $binders;
    private $purgedQuery;
    
    
    public function __construct($queryParams, $urlParams)
    {
        $this->setRawParams($queryParams);
        $this->setCompleteParams($urlParams);
        $this->setValidParams();
        $this->purgeQuery($queryParams);
    }
    
    public function getPurgedQuery()
    {
        return $this->purgedQuery;
    }
    
    private function setRawParams($queryParams) 
    {
        try {
            $type = $queryParams['type'];
            $genType = ($type === 'selectById') ? 'select' : $type;
            $functionName = 'Validator::get' . ucfirst($genType) . 'Params';
            $this->rawParams = Utility::callback($functionName, array($queryParams));
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    public function getRawParams()
    {
        return $this->rawParams;
    }
    
    public static function goWhereDeep(&$rawParams, $params) 
    {
        try {
            foreach ($params as $key => $param) {
                if ($key === 'and' || $key === 'or') {
                    self::goWhereDeep($rawParams, $param);
                } else {
                    foreach ($param as $keyProperty => $property) {
                        if ($keyProperty === 'value') {
                            $rawParams[] = $param['value'];
                        }                        
                    }                    
                }
            }
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    public static function getSelectParams($queryParams) 
    {
        try {
            $params = $queryParams['where'];
            $rawParams = [];
            self::goWhereDeep($rawParams, $params);
            
            return $rawParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    public static function getInsertParams($queryParams) 
    {
        try {
            $params = $queryParams['values'];
            $rawParams = [];
            foreach ($params as $key => $param) {
                foreach ($param as $keyProperty => $property) {
                    if ($keyProperty === 'value') {
                        $rawParams[] = $param['value'];
                    }                        
                }
            }
            return $rawParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    public static function getUpdateParams($queryParams) 
    {
        try {
            $rawParams = [];            
            $setParams = $queryParams['set'];
            foreach ($setParams as $key => $param) {
                foreach ($param as $keyProperty => $property) {
                    if ($keyProperty === 'value') {
                        $rawParams[] = $param['value'];
                    }                        
                }
            }
            $whereParams = $queryParams['where'];
            self::goWhereDeep($rawParams, $whereParams);
            return $rawParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    public static function getDeleteParams($queryParams) 
    {
        try {
            $params = $queryParams['where'];
            $rawParams = [];
            self::goWhereDeep($rawParams, $params);
            
            return $rawParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    private function setCompleteParams($urlParams) 
    {
        try {
            foreach ($this->rawParams as $nParam => $params) {
                foreach ($params as $key => $value) {
                    $completeParams[$nParam][$key] = $value;
                    if ($key === 'param') {
                        if (array_key_exists($value, $urlParams)) {
                            $completeParams[$nParam]['value'] = htmlspecialchars(strip_tags($urlParams[$value]));
                        } else {
                            if ($params['null']) {
                                $completeParams[$nParam]['value'] = null;
                            } else {
                                throw new \Exception('Parametro ' . $value . ' necessario');
                            }
                        }
                    }
                }
            }
            $this->completeParams = $completeParams;           
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    public function getCompleteParams()
    {
        return $this->completeParams;
    }
    
    private function setValidParams() 
    {
        try {            
            foreach($this->completeParams as $keyParam => $properties) {
                if (isset($properties['value'])) {
                    foreach ($properties as $key => $value) {
                        $validParams[$keyParam][$key] = $value;
                        if ($key === 'check') {
                            $functionName = 'Check::is' . ucfirst($value['type']);
                            $functionParams = array_merge(array($properties['value']), $value['params']);
                            if (!Utility::callback($functionName, $functionParams)) {
                                throw new \Exception('Formato parametro ' . $properties['param'] . ' non valido');
                            };
                            $this->binders[] = $properties['bind'];
                        }
                    }
                }    
            }            
            $this->validParams = $validParams;            
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    public function getValidParams()
    {
        return $this->validParams;
    }
    
    private function purgeQuery($queryParams) 
    {
        try {
            $type = $queryParams['type'];
            switch ($type) {
                case 'insert':
                    $this->purgedQuery = $this->purgeType('values', $queryParams);
                    break;
                case 'update':
                    $this->purgedQuery = $this->purgeType('set', $queryParams);
                    break;
                default:
                    $this->purgedQuery = $queryParams;
                    break;
            }
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    private function purgeType($type, $queryParams) 
    {
        try {
            foreach ($queryParams as $keyPart => $part) {
                if ($keyPart === $type) {
                    $purgedType[$keyPart] = $this->purgePart($part);
                } else {
                    $purgedType[$keyPart] = $part;
                }
            }
            return $purgedType;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    private function purgePart($part) 
    {
        try {
            foreach ($part as $nParam => $param) {
                if (in_array($param['value']['bind'], $this->binders)) {
                    $purgedPart[$nParam] = $param;
                }
            }
            return $purgedPart;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
}
