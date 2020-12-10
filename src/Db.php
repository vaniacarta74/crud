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
    
    public static function printConnectionString()
    {
        try {
            return 'mssql://' . self::$host . '@' . self::$user . ':' . self::$password . '<br/>';
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function getPDO($db, $driver = null, $host = null, $user = null, $password = null)
    {
        try {
            $params = [
                'db' => $db,
                'driver' => isset($driver) ? $driver : self::$driver,
                'host' => isset($host) ? $host : self::$host,
                'user' => isset($user) ? $user : self::$user,
                'password' => isset($password) ? $password : self::$password,
                'attributes' => [
                    \PDO::ATTR_PERSISTENT => true
                ]
            ];
            $key = md5(serialize($params));    
            $dsn = $params['driver'] . ':host=' . $params['host'] . ';dbname=' . $params['db'];
            if (!array_key_exists($key, $GLOBALS) || !($GLOBALS[$key] instanceof \PDO)) {
                $GLOBALS[$key] = new \PDO($dsn, $params['user'], $params['password'], $params['attributes']);
            }
            return $GLOBALS[$key];
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
}
