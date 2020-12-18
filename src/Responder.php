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
    private $lcrud;
    private $id;
    private $records;
    private $count;
    private $resource;
    private $response;
    
    public function __construct($lcrud, $resource, $id, $pdo, $stmt)
    {
        try {
            $this->lcrud = $lcrud;
            $this->resource = $resource;
            $this->setId($id, $pdo);
            $this->setRecords($stmt);
            $this->setCount();
            $this->addLinks();
            $this->setResponse();
            
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setId($id, $pdo)
    {
        try {
            switch ($this->lcrud) {
                case 'read':
                case 'update':
                case 'delete':
                    $this->id = $id;
                    break;
                case 'create':
                    $this->id = $pdo->lastInsertId();
                    break;
                case 'list':
                    $this->id = null;
                    break;
            }
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    } 
    
    private function setRecords($stmt) 
    {
        try {
            if ($this->lcrud === 'list' || $this->lcrud === 'read') {
                $records = DB::fetch($stmt);
            } else {
                $records = null;
            }
            $this->records = $records;           
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setCount()
    {
        try {
            if (isset($this->records)) {
                $count = count($this->records);
            } else {
                $count = 1;
            }            
            $this->count = $count;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setLink($id)
    {
        try {
            $link = $this->resource . '/' . $id;
            return $link;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function addLinks()
    {
        try {
            $linked = [];
            foreach ($this->records as $nRecord => $record) {
                $linked[$nRecord] = $record;
                $linked[$nRecord]['link'] = $this->setLink($record['id']);
            }
            $this->records = $linked;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setResponse($stmt)
    {
        try {
            $response['ok'] = true;
            $response['method'] = $this->lcrud;            
            switch ($this->lcrud) {                
                case 'update':
                    $response['response']['message'] = 'Record ' . $this->id . ' aggiornato con successo';
                    $response['response']['link'] = $this->setLink($this->id);
                    break;
                case 'create':
                    $response['response']['message'] = 'Record ' . $this->id . ' inserito con successo';
                    $response['response']['link'] = $this->setLink($this->id);
                    break;
                case 'list':
                    if (count($this->records) === 0) {
                        $response['response']['message'] = 'Nessun record trovato per i parametri indicati';
                    } else {
                        $response['response']['message'] = 'Numero record caricati: ' . $this->count;                        
                    }                    
                    $response['response']['records'] = $this->records;
                    break;
                case 'read':
                    if (count($this->records) === 0) {
                        $response['response']['message'] = 'Record ' . $this->id . ' non trovato';
                    } else {
                        $response['response']['message'] = 'Record ' . $this->id . ' caricato con successo';                        
                    }
                    $response['response']['records'] = $this->records;
                    break;
                case 'delete':
                    $response['response']['message'] = 'Record ' . $this->id . ' cancellato con successo';
                    break;
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
