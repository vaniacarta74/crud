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
    private static $driver = 'dblib';
    private static $host = MSSQL_HOST;
    private static $user = MSSQL_USER;
    private static $password = MSSQL_PASSWORD;
    
    public static function connect($db, $driver = null, $host = null, $user = null, $password = null)
    {
        try {
            $params = [
                'db' => $db,
                'driver' => isset($driver) ? $driver : self::$driver,
                'host' => isset($host) ? $host : self::$host,
                'user' => isset($user) ? $user : self::$user,
                'password' => isset($password) ? $password : self::$password
            ];
            $key = md5(serialize($params));    
            $dsn = $params['driver'] . ':host=' . $params['host'] . ';dbname=' . $params['db'];
            if (!array_key_exists($key, $GLOBALS) || !($GLOBALS[$key] instanceof \PDO)) {
                $pdo = new \PDO($dsn, $params['user'], $params['password']);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $GLOBALS[$key] = $pdo;
            }
            return $GLOBALS[$key];
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function prepare($pdo, $queryParams)
    {
        try {
            $type = $queryParams['type'];
            $genType = ($type === 'selectById') ? 'select' : $type;
            $functionName = 'Db::prepare' . ucfirst($genType);
            $rawQuery = Utility::callback($functionName, array($queryParams));
            $stmt = $pdo->prepare($rawQuery);
            
            return $stmt;
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function prepareSelect($queryParams)
    {
        try {
            $fields = self::setSelectFields($queryParams['fields']);
            $table = self::setTable($queryParams['table']);
            $where = self::setWhere($queryParams['where']);
            $order = self::setOrder($queryParams['order']);
            
            $rawQuery = 'SELECT ' . $fields . ' FROM ' . $table . (isset($where) ? ' WHERE ' . $where : null) . (isset($order) ? ' ORDER BY ' . $order : null) . ';';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function setSelectFields($arrFields)
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
    
    public static function setTable($table)
    {
        try {            
            return $table;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function setWhere($arrWhere)
    {
        try {
            $keys = array_keys($arrWhere);
            $opAndOr = strtoupper($keys[0]); 
            $subExp = self::setWhereRecursive($arrWhere);
            $where = implode(' ' . $opAndOr . ' ', $subExp);
            
            return $where;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function setWhereRecursive($params) 
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
    
    public static function setOrder($arrOrders)
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
    
    public static function prepareInsert($queryParams)
    {
        try {
            $table = self::setTable($queryParams['table']);
            $fields = self::setInsertFields($queryParams['values']);
            $values = self::setValues($queryParams['values']);
            
            $rawQuery = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $values . ');';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function setInsertFields($arrValues)
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
    
    public static function setValues($arrValues)
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
    
    public static function prepareUpdate($queryParams)
    {
        try {
            $table = self::setTable($queryParams['table']);
            $sets = self::setSets($queryParams['set']);
            $where = self::setWhere($queryParams['where']);
            
            $rawQuery = 'UPDATE ' . $table . ' SET ' . $sets . ' WHERE ' . $where . ';';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function setSets($arrSets)
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
    
    public static function prepareDelete($queryParams)
    {
        try {
            $table = self::setTable($queryParams['table']);
            $where = self::setWhere($queryParams['where']);
            
            $rawQuery = 'DELETE FROM ' . $table . ' WHERE ' . $where . ';';
            
            return $rawQuery;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    //public static function query($pdo, $rawQuery, $bindParams)
    public static function query($stmt, $bindParams)
    {
        try {
            //$stmt = $pdo->prepare($rawQuery);
            foreach ($bindParams as $param) {
                $type = constant('\PDO::PARAM_' . strtoupper($param['type']));
                $stmt->bindParam($param['bind'], $param['value'], $type);
            }
            $stmt->execute();
            return $stmt;
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function fetch($stmt, $style = null)
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
}
