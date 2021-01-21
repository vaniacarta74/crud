<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Accessor;
use vaniacarta74\Crud\Error;
use vaniacarta74\Crud\Utility;

/**
 * Description of Validator
 *
 * @author Vania
 */
class Validator extends Accessor
{
    protected $rawParams;
    protected $completeParams;
    protected $validParams;
    protected $binders;
    protected $purgedQuery;
    
    /**
     * @param array $queryParams
     * @param array $urlParams
     * @throws \Exception
     */
    public function __construct($queryParams, $urlParams)
    {
        try {
            if (!is_array($queryParams) || !is_array($urlParams)) {
                throw new \Exception('Tipo parametri errato. Utilizzare array.');
            }
            $this->setRawParams($queryParams);
            $this->setCompleteParams($urlParams);
            $this->setValidParams();
            $this->purgeQuery($queryParams);
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @param array $queryParams
     * @throws \Exception
     */
    private function setRawParams($queryParams) 
    {
        try {
            if (!is_array($queryParams) || !key_exists('type', $queryParams) || !in_array($queryParams['type'], array('list', 'read', 'create', 'update', 'delete'))) {
                throw new \Exception('Tipo operazione non definito correttamente');
            }
            $type = $queryParams['type'];
            $method = 'get' . ucfirst($type) . 'Params';
            $this->rawParams = $this->$method($queryParams);
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    /**
     * @param array $queryParams
     * @return array
     * @throws \Exception
     */
    private function getListParams($queryParams) 
    {
        try {
            if (!is_array($queryParams) || !key_exists('where', $queryParams)) {
                throw new \Exception('Clausola where non definita correttamente');
            }
            $params = $queryParams['where'];
            $rawParams = [];
            $this->goWhereDeep($rawParams, $params);            
            return $rawParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    /**
     * @param array $queryParams
     * @return array
     * @throws \Exception
     */
    private function getReadParams($queryParams) 
    {
        try {
            if (!is_array($queryParams) || !key_exists('where', $queryParams)) {
                throw new \Exception('Clausola where non definita correttamente');
            }
            $params = $queryParams['where'];
            $rawParams = [];
            $this->goWhereDeep($rawParams, $params);            
            return $rawParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    /**
     * @param array $queryParams
     * @return array
     * @throws \Exception
     */
    private function getCreateParams($queryParams) 
    {
        try {
            if (!is_array($queryParams) || !key_exists('values', $queryParams)) {
                throw new \Exception('Clausola values non definita correttamente');
            }
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
    
    /**
     * @param array $queryParams
     * @return array
     * @throws \Exception
     */
    private function getUpdateParams($queryParams) 
    {
        try {
            if (!is_array($queryParams) || !key_exists('set', $queryParams)) {
                throw new \Exception('Clausola set non definita correttamente');
            }
            $setParams = $queryParams['set'];
            $rawParams = [];
            foreach ($setParams as $key => $param) {
                foreach ($param as $keyProperty => $property) {
                    if ($keyProperty === 'value') {
                        $rawParams[] = $param['value'];
                    }                        
                }
            }
            if (!is_array($queryParams) || !key_exists('where', $queryParams)) {
                throw new \Exception('Clausola where non definita correttamente');
            }
            $whereParams = $queryParams['where'];
            $this->goWhereDeep($rawParams, $whereParams);
            return $rawParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    /**
     * @param array $queryParams
     * @return array
     * @throws \Exception
     */
    private function getDeleteParams($queryParams) 
    {
        try {
            if (!is_array($queryParams) || !key_exists('where', $queryParams)) {
                throw new \Exception('Clausola where non definita correttamente');
            }
            $params = $queryParams['where'];
            $rawParams = [];
            $this->goWhereDeep($rawParams, $params);            
            return $rawParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    /**
     * @param array $rawParams
     * @param array $params
     * @throws \Exception
     */
    private function goWhereDeep(&$rawParams, $params) 
    {
        try {
            if (!is_array($rawParams) || !is_array($params)) {
                throw new \Exception('Tipo parametri errato usare array');
            }
            foreach ($params as $key => $param) {
                if (preg_match('/^(and|or)(.)*$/', $key)) {
                    $this->goWhereDeep($rawParams, $param);
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
    
    /**
     * @param array $urlParams
     * @throws \Exception
     */
    private function setCompleteParams($urlParams) 
    {
        try {
            $completeParams = [];
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
    
    /**
     * @throws \Exception
     */
    private function setValidParams() 
    {
        try {
            $validParams = [];
            foreach($this->completeParams as $nParam => $properties) {
                if (isset($properties['value'])) {
                    foreach ($properties as $key => $value) {
                        $validParams[$nParam][$key] = $value;
                        if ($key === 'check') {
                            $method = array('Check', 'is' . ucfirst($value['type']));
                            $methodParams = array_merge(array($properties['value']), $value['params']);
                            if (!Utility::callback($method, $methodParams)) {
                                throw new \Exception('Formato parametro ' . $properties['param'] . ' non valido');
                            };
                            $this->binders[$nParam] = $properties['bind'];
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
    
    /**
     * @param array $queryParams
     * @throws \Exception
     */
    private function purgeQuery($queryParams) 
    {
        try {
            if (!is_array($queryParams) || !key_exists('type', $queryParams) || !in_array($queryParams['type'], array('list', 'read', 'create', 'update', 'delete'))) {
                throw new \Exception('Tipo operazione non definito correttamente');
            }
            $type = $queryParams['type'];
            switch ($type) {
                case 'create':
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
    
    /**
     * @param string $type
     * @param array $queryParams
     * @return array
     * @throws \Exception
     */
    private function purgeType($type, $queryParams) 
    {
        try {
            if (!is_string($type) || !is_array($queryParams)) {
                throw new \Exception('Tipo parametri errato');
            }
            $purgedType = [];
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
            if (!is_array($part)) {
                throw new \Exception('Tipo parametro errato');
            }
            $purgedPart = [];
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
