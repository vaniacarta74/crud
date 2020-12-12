<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Error;

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
                $GLOBALS[$key] = new \PDO($dsn, $params['user'], $params['password']);
            }
            return $GLOBALS[$key];
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function query($pdo, $rawQuery, $bindParams)
    {
        try {
            //include __DIR__ . '/inc/query/' . $queryFile . '.php';
            $stmt = $pdo->prepare($rawQuery);
            //$bindParams = array_merge_recursive($selectParams, $queryParams);
            foreach ($bindParams as $param) {
                $type = constant('\PDO::PARAM_' . strtoupper($param['type']));
                $stmt->bindParam($param['bind'], $param['value'], $type);
            }
            $stmt->execute();
            
            return $stmt;
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
}
