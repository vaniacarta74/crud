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
    private $type;
    private $id;
    private $records;
    private $count;
    private $resource;
    private $response;
        
    public function __construct($resource, $results)
    {
        try {
            $this->setResource($resource);
            $this->setType($results);            
            $this->setId($results);
            $this->setRecords($results);
            $this->setCount();
            $this->addLinks();
            $this->setResponse();
            
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
        
    private function setId($results)
    {
        try {
            $this->id = isset($results['id']) ? $results['id'] : null;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setRecords($results) 
    {
        try {            
            $this->records = $results['records'];           
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setType($results) 
    {
        try {            
            $this->type = $results['type'];           
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    private function setResource($resource) 
    {
        try {            
            $this->resource = $resource;           
        } catch (\Exception $e) {
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
    
    private function setResponse()
    {
        try {
            $response['ok'] = true;
            $response['method'] = $this->type;            
            switch ($this->type) {                
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
