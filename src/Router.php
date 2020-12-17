<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Error;

/**
 * Description of Router
 *
 * @author Vania
 */
class Router
{
    private $db;
    private $alias;
    private $table;
    private $id;
    private $queryType;
    private $queryParams;
    private $urlParams;
    
    public function __construct($path, $method)
    {
        try {            
            $strJson = @file_get_contents(__DIR__ . '/json/routes.json');
            $routes = json_decode($strJson, true);
            $dbOk = $this->setDb($path, $routes);
            $tableOk = $this->setTable($path, $routes);
            $this->setId($path);
            $this->setQueryType($method);
            $this->setQueryParams();
            $this->setUrlParams();
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }    
    
    private function setDb($path, $routes)
    {
        try {
            $isOk = false;
            foreach ($routes as $db => $route) {
                if (strpos($path, $route['alias']) !== false) {
                    $this->db = $db;
                    $this->alias = $route['alias'];
                    $isOk = true;
                    break;
                }
            }
            if ($isOk) {
                return $isOk;
            } else {
                throw new \Exception('Nome db non trovato.');
            }        
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function getDb()
    {
        return $this->db;
    }
    
    private function setTable($path, $routes)
    {
        try {
            $tables = $routes[$this->db]['tables'];
            $isOk = false;
            foreach ($tables as $table) {
                if (strpos($path, $table) !== false) {
                    $this->table = $table;
                    $isOk = true;
                    break;
                }
            }
            if ($isOk) {
                return $isOk;
            } else {
                throw new \Exception('Nome tabella non trovato.');
            }        
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function getTable()
    {
        return $this->table;
    }
    
    private function setId($path)
    {
        try {
            $baseRegex = $this->alias . '\/' . $this->table;
            if (preg_match('/' . $baseRegex  . '$/', $path)) {
                $this->id = null;
            } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches)) {
                $this->id = $matches[1];
            } else {
                throw new \Exception('Id non definito correttamente.');
            }
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function getId()
    {
        return $this->id;
    }
        
    private function setQueryType($method)
    {
        try {
            $queryType = '';
            if (isset($this->id)) {
                switch ($method) {
                    case 'GET':
                        $queryType = 'selectById';
                        break;
                    case 'PUT':
                    case 'PATCH':
                        $queryType = 'update';
                        break;
                    case 'DELETE':
                        $queryType = 'delete';
                        break;
                }
            } else {
                switch ($method) {
                    case 'GET':
                        $queryType = 'select';
                        break;
                    case 'POST':
                        $queryType = 'insert';
                        break;
                }
            }
            if ($queryType !== '') {
                $this->queryType = $queryType;
            } else {
                throw new \Exception('Parametri richiesta errati.');
            }           
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function getQueryType()
    {
        return $this->queryType;
    }

    private function setQueryParams()
    {
        try {
            $path = __DIR__ . '/json/' . $this->table . '.json';
            $strJson = @file_get_contents($path);
            $params = json_decode($strJson, true);
            $queryParams = $params[$this->queryType];
            $queryParams['type'] = $this->queryType;
            $this->queryParams = $queryParams;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function getQueryParams()
    {
        return $this->queryParams;
    }
    
    private function setUrlParams()
    {
        try {
            $urlParams = [];
            switch ($this->queryType) {
                case 'select':
                    $urlParams = $_GET;
                    break;
                case 'selectById':
                case 'delete':
                    $urlParams['id'] = $this->id;
                    break;
                case 'insert':
                    $post = @file_get_contents('php://input');
                    $urlParams = json_decode($post, true);
                    //$urlParams = $_GET;
                    break;
                case 'update':
                    $urlParams = $_GET;
                    $urlParams['id'] = $this->id;
                    break;
            }
            if (count($urlParams) > 0) {
                $this->urlParams = $urlParams;
            } else {
                throw new \Exception('Parametri url non presenti');
            }
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function getUrlParams()
    {
        return $this->urlParams;
    }
}
