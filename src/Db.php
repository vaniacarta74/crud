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
 * Description of Db
 *
 * @author Vania
 */
class Db
{
    private $db;
    private $driver;
    private $host;
    private $user;
    private $password;
    private $dsn;
    private $pdo;
    private $pdoStmt;
    private $queryType;
    
    public function __construct($db, $driver = null, $host = null, $user = null, $password = null) {
        try {
            $this->db = $db;
            $this->driver = isset($driver) ? $driver : 'dblib';
            $this->host = isset($host) ? $host : MSSQL_HOST;
            $this->user = isset($user) ? $user : MSSQL_USER;
            $this->password = isset($password) ? $password : MSSQL_PASSWORD;
            $this->dsn = $this->driver . ':host=' . $this->host . ';dbname=' . $this->db;
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function run($queryParams, $bindParams)
    {
        try {
            $this->connect();
            $this->prepare($queryParams);            
            $this->query($bindParams);
            return $this->getResults();
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }   
    
    public function connect()
    {
        try {
            $n = 5;
            $delay = 500000;
            $params = [
                'db' => $this->db,
                'driver' => $this->driver,
                'host' => $this->host,
                'user' => $this->user,
                'password' => $this->password
            ];
            $key = md5(serialize($params));    
            if (!array_key_exists($key, $GLOBALS) || !($GLOBALS[$key] instanceof \PDO)) {
                $isOk = false;
                for ($i = 1; $i <= $n; $i++) {
                    try {
                        $pdo = new \PDO($this->dsn, $this->user, $this->password);
                        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                        $GLOBALS[$key] = $pdo;
                        $isOk = true;
                        break;
                    } catch (\PDOException $e) {
                        usleep($delay);
                        continue;
                    }
                }
                if (!$isOk) {
                    throw new \PDOException('Impossibile stabilire la seguente connessione: dsn = ' . $this->dsn);
                }
            }
            $this->pdo = $GLOBALS[$key];
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function prepare($queryParams)
    {
        try {
            $this->queryType = $queryParams['type'];
            $method = 'prepare' . ucfirst($this->queryType);
            $rawQuery = $this->$method($queryParams);
            $this->pdoStmt = $this->pdo->prepare($rawQuery);
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function prepareList($queryParams)
    {
        try {
            $fields = $this->setSelectFields($queryParams['fields']);
            $table = $this->setTable($queryParams['table']);
            $where = $this->setWhere($queryParams['where']);
            $order = $this->setOrder($queryParams['order']);
            
            $rawQuery = 'SELECT ' . $fields . ' FROM ' . $table . (isset($where) ? ' WHERE ' . $where : null) . (isset($order) ? ' ORDER BY ' . $order : null) . ';';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function prepareRead($queryParams)
    {
        try {
            $fields = $this->setSelectFields($queryParams['fields']);
            $table = $this->setTable($queryParams['table']);
            $where = $this->setWhere($queryParams['where']);
            $order = $this->setOrder($queryParams['order']);
            
            $rawQuery = 'SELECT ' . $fields . ' FROM ' . $table . (isset($where) ? ' WHERE ' . $where : null) . (isset($order) ? ' ORDER BY ' . $order : null) . ';';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setSelectFields($arrFields)
    {
        try {
            $strFields = [];
            foreach ($arrFields as $field) {
                if (isset($field['alias'])) {
                    $strFields[] = $field['name'] . ' AS ' . $field['alias'];
                } else {
                    $strFields[] = $field['name'];
                }                
            }
            if (count($strFields) === 0) {
                $fields = '*';
            } else {
                $fields = implode(', ', $strFields);
            }
            return $fields;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setTable($table)
    {
        try {            
            return $table;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setWhere($arrWhere)
    {
        try {
            $keys = array_keys($arrWhere);
            $opAndOr = strtoupper($keys[0]); 
            $subExp = $this->setWhereRecursive($arrWhere);
            $where = implode(' ' . $opAndOr . ' ', $subExp);
            
            return $where;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setWhereRecursive($params) 
    {
        try {
            foreach ($params as $key => $param) {
                if ($key === 'and' || $key === 'or') {
                    $opAndOr = strtoupper($key);
                    $subExp = self::setWhereRecursive($param);
                    $exp[] = '(' . implode(' ' . $opAndOr . ' ', $subExp) . ')';
                } else {
                    $exp[] =  $param['field'] . ' ' . $param['operator'] . ' ' . $param['value']['bind'];                       
                }
            }
            return $exp;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }        
    }
    
    private function setOrder($arrOrders)
    {
        try {
            $strOrders = [];
            foreach ($arrOrders as $order) {
                $strOrders[] = $order['field'] . ' ' . strtoupper($order['type']);               
            }
            if (count($strOrders) === 0) {
                $orders = null;
            } else {
                $orders = implode(',', $strOrders);
            }
            return $orders;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function prepareCreate($queryParams)
    {
        try {
            $table = $this->setTable($queryParams['table']);
            $fields = $this->setInsertFields($queryParams['values']);
            $values = $this->setValues($queryParams['values']);
            
            $rawQuery = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $values . ');';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setInsertFields($arrValues)
    {
        try {
            $strFields = [];
            foreach ($arrValues as $params) {                
                $strFields[] = $params['field'];
            }
            $fields = implode(', ', $strFields);
            return $fields;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setValues($arrValues)
    {
        try {
            $strValues = [];
            foreach ($arrValues as $params) {                
                $strValues[] = $params['value']['bind'];
            }
            $values = implode(', ', $strValues);
            return $values;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function prepareUpdate($queryParams)
    {
        try {
            $table = $this->setTable($queryParams['table']);
            $sets = $this->setSets($queryParams['set']);
            $where = $this->setWhere($queryParams['where']);
            
            $rawQuery = 'UPDATE ' . $table . ' SET ' . $sets . ' WHERE ' . $where . ';';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setSets($arrSets)
    {
        try {
            $strSets = [];
            foreach ($arrSets as $params) {                
                $strSets[] = $params['field'] . ' = ' . $params['value']['bind'];
            }
            $sets = implode(', ', $strSets);
            return $sets;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function prepareDelete($queryParams)
    {
        try {
            $table = $this->setTable($queryParams['table']);
            $where = $this->setWhere($queryParams['where']);
            
            $rawQuery = 'DELETE FROM ' . $table . ' WHERE ' . $where . ';';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function query($bindParams)
    {
        try {
            foreach ($bindParams as $param) {
                $type = constant('\PDO::PARAM_' . strtoupper($param['type']));
                $this->pdoStmt->bindParam($param['bind'], $param['value'], $type);
            }
            $this->pdoStmt->execute();
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function fetch($stmt, $style = null)
    {
        try {
            $pdoStyle = isset($style) ? $style : \PDO::FETCH_ASSOC;
            while ($row = $stmt->fetch($pdoStyle)) {
                $records[] = $row;
            }            
            return $records;
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function getResults()
    {
        try {
            $response['type'] = $this->queryType;
            if ($this->queryType === 'list' || $this->queryType === 'read') {
                $response['id'] = null;
                $response['records'] = $this->fetch($this->pdoStmt);;
            } elseif ($this->queryType === 'create') {
                $response['id'] = $this->pdo->lastInsertId();
                $response['records'] = null;
            } else {
                $response['id'] = null;
                $response['records'] = null;
            }
            return $response;
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
}
