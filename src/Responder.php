<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Db;

/**
 * Description of Responder
 *
 * @author Vania
 */
class Responder
{
    private $id;
    private $response;
    
    public function __construct($queryType, $id, $pdo, $stmt)
    {
        try {
            $this->setId($queryType, $id, $pdo);
            $this->setResponse($stmt);
            
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setId($queryType, $id, $pdo)
    {
        try {
            switch ($queryType) {
                case 'selectById':
                case 'update':
                case 'delete':
                    $this->id = $id;
                    break;
                case 'insert':
                    $this->id = $pdo->lastInsertId();
                    break;
                case 'select':
                    $this->id = null;
                    break;
            }
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }  
    
    private function setResponse($stmt)
    {
        try {
            if (isset($this->id)) {
                $response = [
                    'ok' => true,                
                    'id' => $this->id
                ];
            } else {
                $response = [
                    'ok' => true,                
                    'records' => DB::fetch($stmt)
                ];
            }
            $this->response = $response;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public function getResponse()
    {
        return $this->response;
    }
}
