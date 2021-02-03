<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Accessor;
use vaniacarta74\Crud\Error;

/**
 * Description of Responder
 *
 * @author Vania
 */
class Responder extends Accessor
{
    protected $type;
    protected $id;
    protected $records;
    protected $count;
    protected $resource;
    protected $response;
    
    /**
     * @param string $resource
     * @param array $results
     * @throws \Exception
     */
    public function __construct($resource, $results)
    {
        try {
            if (!is_string($resource) || !is_array($results)) {
                throw new \Exception('Formato parametri non corretto');
            }
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
    
    /**
     * @param array $results
     * @throws \Exception
     */
    private function setId($results)
    {
        try {
            if (!is_array($results)) {
                throw new \Exception('Formato parametro non corretto');
            }
            $this->id = isset($results['id']) ? $results['id'] : null;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @param array $results
     * @throws \Exception
     */
    private function setRecords($results) 
    {
        try {
            if (!is_array($results)) {
                throw new \Exception('Formato parametro non corretto');
            }
            $this->records = isset($results['records']) ? $results['records'] : [];           
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @param array $results
     * @throws \Exception
     */
    private function setType($results) 
    {
        try {
            if (!is_array($results)) {
                throw new \Exception('Formato parametro non corretto');
            }
            $this->type = isset($results['type']) ? $results['type'] : null;            
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @param string $resource
     * @throws \Exception
     */
    private function setResource($resource) 
    {
        try {
            if (!is_string($resource)) {
                throw new \Exception('Formato parametro non corretto');
            }
            $this->resource = $resource;           
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @throws \Exception
     */
    private function setCount()
    {
        try {
            if (is_array($this->records)) {
                $count = count($this->records);
            } else {
                $count = 0;
            }            
            $this->count = $count;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
    /**
     * @param int $id
     * @return string
     * @throws \Exception
     */
    private function setLink($id)
    {
        try {
            if (!is_numeric($id)) {
                throw new \Exception('Formato parametro non corretto');
            }
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
            if (!is_array($this->records)) {
                throw new \Exception('Formato proprietà records non corretto');
            }
            $linked = [];
            foreach ($this->records as $nRecord => $record) {
                $linked[$nRecord] = $record;
                if (array_key_exists('id', $record)) {
                    $linked[$nRecord]['link'] = $this->setLink($record['id']);
                } else {
                    throw new \Exception('Proprietà records senza id');
                }
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
                default:
                    throw new \Exception('Metodo non contemplato');
                    break;
            }
            $this->response = $response;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
//    public function getResponse()
//    {
//        return $this->response;
//    }
}
