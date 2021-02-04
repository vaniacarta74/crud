<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Error;

/**
 * Description of Curl
 *
 * @author Vania
 */
class Curl
{
    /**
     * @param string $url
     * @param string/null $httpMethod
     * @param array/null $params
     * @param bool/null $json
     * @return string
     * @throws \Exception
     */    
    public static function run($url, $httpMethod = null, $params = null, $json = null)
    {
        try {
            $method = isset($httpMethod) ? $httpMethod : 'GET';
            $isJson = isset($json) ? $json : false;
            if ($method === 'POST') {
                if (!isset($params) || count($params) === 0) {
                    throw new \Exception('Parametri curl non definiti');
                } else {
                    $ch = self::set($url, $method, $params, $isJson);
                }
            } else {
                $ch = self::set($url, $method);
            }            
            $report = self::exec($ch);
            
            return $report;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, DEBUG_LEVEL);
            throw $e;
        }
    }
    
    /**
     * @param string $url
     * @param string $method
     * @param array/null $params
     * @param bool/null $json
     * @return resource
     * @throws \Exception
     */
    public static function set($url, $method, $params = null, $json = null)
    {
        try {
            if (!is_string($url) || !is_string($method) || !in_array($method, array('GET', 'POST', 'PUT', 'PATCH', 'DELETE'))) {
                throw new \Exception('Formato parametri non corretto o valori non ammessi');
            }
            $isJson = isset($json) ? $json : false;
            $ch = curl_init();            
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, TIMEOUT);
            curl_setopt($ch, CURLOPT_TIMEOUT, TIMEOUT);
            switch ($method) {
                case 'GET':
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    break;
                case 'POST':
                    if (isset($params) && count($params) > 0) {                        
                        if ($isJson) {
                            $posts = json_encode($params);
                            $header = [
                                'Content-Type: application/json',
                                'Content-Length: ' . strlen($posts)
                            ];
                            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        } else {
                            $posts = $params;
                            curl_setopt($ch, CURLOPT_HEADER, false);
                        }
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);                    
                    } else {
                        throw new \Exception('Parametri POST non definiti');
                    }
                    break;
                default:
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                    break;                
            }
            return $ch;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, DEBUG_LEVEL);
            throw $e;
        }
    }
    
    /**
     * @param resource $ch
     * @return string
     * @throws \Exception
     */
    public static function exec($ch)
    {
        try {
            if (!is_resource($ch)) {
                throw new \Exception('Risorsa non definita');
            }
            $report = curl_exec($ch);
            curl_close($ch);
            
            return $report;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, DEBUG_LEVEL);
            throw $e;
        }
    }
}
