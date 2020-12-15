<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Error;
use vaniacarta74\Crud\Utility;

/**
 * Description of Validator
 *
 * @author Vania
 */
class Validator
{
    private $rawParams;
    
    public function __construct($queryParams, $urlParams)
    {
        $this->setRawParams($queryParams);
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
}
