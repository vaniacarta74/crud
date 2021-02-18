<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Accessor;
use vaniacarta74\Crud\Error;
use vaniacarta74\Crud\Curl;
/**
 * Description of Sync
 *
 * @author Vania
 */
class Sync extends Accessor
{
    const URLSOURCE = 'http://localhost/crud/api/h1';
    const URLTARGET = 'http://localhost/crud/api/h2';
    const URLALLSYNCVAR = 'http://localhost/crud/api/h1/core/variabili_sync/ALL';
    const URLALLSPTMAXDATA = 'http://localhost/crud/api/h2/spt/vista_variabili_maxdata/ALL';
    const URLALLSSCPMAXDATA = 'http://localhost/crud/api/h2/sscp/vista_variabili_maxdata/ALL';
    
    protected $varToSync;
    protected $targetLastRecords;
    protected $sourceNewRecords;
    protected $report;
    protected $response;
    
    /**
     * @throws \Exception
     */
    public function __construct()
    {
        try {
            $this->varToSync = [];
            $this->targetLastRecords = [];
            $this->sourceNewRecords = [];
            $this->report = [];
            $this->setResponse();
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
    /**
     * @throws \Exception
     */
    public function run() {
        try {
            $this->setVarToSync();
            $this->setTargetLastRecords();
            $this->setSourceNewRecords();
            $this->setReport();
            $this->setResponse();
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
    /**
     * @param string $url
     * @param string $method
     * @param array $param
     * @param boolean $isJson
     * @return array
     * @throws \Exception
     */
    public function callCrudService($url, $method = null, $param = null, $isJson = null)
    {
        try {
            $json = Curl::run($url, $method, $param, $isJson);
            $response = json_decode($json, true);
            if ($response['ok']) {
                switch ($response['method']) {
                    case 'all':
                    case 'list':
                    case 'read':                        
                        $return['records'] = $response['response']['records'];
                        break;
                    case 'create':
                    case 'update':
                    case 'delete':
                        $return['records'] = [];
                        break;
                }
                $return['message'] = $response['response']['message'];
            } else {
                throw new \Exception('Errore servizio ' . $url . ' metodo ' . $method . ': ' . $response['Descrizione errore']);
            }
            return $return;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @throws \Exception
     */
    public function setVarToSync()
    {
        try {
            $variabili = $this->getVariabili(self::URLALLSYNCVAR);            
            $distinct = $this->getDistinctVar($variabili);            
            $this->varToSync = $distinct;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
    /**
     * @param string $url
     * @return array
     * @throws \Exception
     */
    public function getVariabili($url)
    {
        try {
            try {
                $result = $this->callCrudService($url);
                if (array_key_exists('records', $result)) {
                    $variabili = $result['records'];
                } else {
                    throw new \Exception();
                }
            } catch (\Exception $e) {
                $variabili = [];
            }            
            return $variabili;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
    /**
     * @param array $variabili
     * @return array
     * @throws \Exception
     */    
    public function getDistinctVar($variabili)
    {
        try {
            $maxId = count($variabili);
            if ($maxId > 0) {
                if (!array_key_exists('codice', $variabili[0])) {
                    throw new \Exception('Chiave codice non presente');
                }
                $distinct[] = $variabili[0]['codice'];
                for ($i = 1; $i < $maxId; $i++) {        
                    if ($variabili[$i - 1]['codice'] !== $variabili[$i]['codice']) {
                        $distinct[] = $variabili[$i]['codice'];
                    }
                }                
            } else {
                $distinct = [];
            }
            return $distinct;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @return array
     * @throws \Exception
     */
    public function getTargetAllMaxDates()
    {
        try {
            $varSpt = $this->getVariabili(self::URLALLSPTMAXDATA);            
            $varSscp = $this->getVariabili(self::URLALLSSCPMAXDATA);            
            $maxData = array_merge($varSpt, $varSscp);            
            return $maxData;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
    /**
     * @param array $maxData
     * @return array
     * @throws \Exception
     */
    public function getTargetVarMaxDates($distinct, $maxData)
    {
        try {
            $j = 0;
            $distData = [];
            $iMax = count($maxData);
            foreach ($distinct as $codice) {
                for ($i = $j; $i < $iMax; $i++) {
                    if (array_key_exists('codice', $maxData[$i]) && array_key_exists('data_e_ora', $maxData[$i])) {
                        if ($codice === $maxData[$i]['codice']) {
                            $distData[$codice] = $maxData[$i]['data_e_ora'];
                            break;
                        }
                    } else {
                        throw new \Exception('Chiavi codice o data_e_ora non presenti');
                    }
                }
                $j = $i;
            }            
            return $distData;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @param array $param
     * @throws \Exception
     */
    public function setTargetLastRecords($param = null)
    {
        try {
            $varToSync = isset($param) ? $param : $this->varToSync;
            if (!is_array($varToSync)) {
                throw new \Exception('Formato parametro non ammesso');
            }
            if (count($varToSync) > 0) {
                $maxData = $this->getTargetAllMaxDates();
                $this->targetLastRecords = $this->getTargetVarMaxDates($varToSync, $maxData);
            } else {
                $this->targetLastRecords = [];
            }
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @throws \Exception
     */
    public function listSourceNewRecords($distData)
    {
        try {            
            $newData = [];
            foreach ($distData as $codice => $data) {
                $arrCodice = explode('.', $codice);
                $db = ($arrCodice[0] === 'SPT') ? 'spt' : 'sscp';
                $variabile = $arrCodice[1];
                $tipo_dato = $arrCodice[2];
                $data_iniziale = str_replace(' ', 'T', $data);
                $data_finale = str_replace(' ', 'T', date('Y-m-d H:i:s'));                
                
                $newData[$codice] = $this->getVariabili(self::URLSOURCE . '/' . $db . '/dati_acquisiti?var=' . $variabile . '&type=' . $tipo_dato . '&datefrom=' . $data_iniziale . '&dateto=' . $data_finale);
            }            
            return $newData;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
    /**
     * @param array $param
     * @throws \Exception
     */     
    public function setSourceNewRecords($param = null)
    {
        try {
            $targetLastRecords = isset($param) ? $param : $this->targetLastRecords;
            if (!is_array($targetLastRecords)) {
                throw new \Exception('Formato parametro non ammesso');
            }
            if (count($targetLastRecords) > 0) {
                $this->sourceNewRecords = $this->listSourceNewRecords($targetLastRecords);
            } else {
                $this->sourceNewRecords = [];
            }
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @param array $newData
     * @return array
     * @throws \Exception
     */
    public function insertTargetRecords($newData)
    {
        try {            
            $resInsertData = [];
            foreach ($newData as $codice => $records) {
                $arrCodice = explode('.', $codice);
                $db = ($arrCodice[0] === 'SPT') ? 'spt' : 'sscp';
                $i = 1;
                $j = 1;
                $resInsertData[$codice]['inserted'] = 0;
                $resInsertData[$codice]['failed'] = 0;
                foreach ($records as $fields) {
                    $params = [
                        'var' => $fields['variabile'],
                        'type' => $fields['tipo_dato'],
                        'date' => str_replace(' ', 'T', $fields['data_e_ora']),
                        'val' => $fields['valore']
                    ];
                    try {
                        $this->callCrudService(self::URLTARGET . '/' . $db . '/dati_acquisiti', 'POST', $params);
                        $resInsertData[$codice]['inserted'] = $i;
                        $i++;
                    } catch (\Exception $e) {
                        $resInsertData[$codice]['failed'] = $j;
                        $j++;
                        continue;
                    }            
                }      
            }
            return $resInsertData;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
    /**
     * @throws \Exception
     */
    public function setReport($param = null)
    {
        try {
            $sourceNewRecords = isset($param) ? $param : $this->sourceNewRecords;
            if (!is_array($sourceNewRecords)) {
                throw new \Exception('Formato parametro non ammesso');
            }
            if (count($sourceNewRecords) > 0) {
                $this->report = $this->insertTargetRecords($sourceNewRecords);
            } else {
                $this->report = [];
            }            
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    /**
     * @throws \Exception
     */
    public function setResponse($param = null)
    {
        try {
            $resInsertData = isset($param) ? $param : $this->report;
            if (!is_array($resInsertData)) {
                throw new \Exception('Formato parametro non ammesso');
            }
            $total = 0;
            if (count($resInsertData) > 0) {
                $response['ok'] = true;
                $response['message'] = 'Sincronizzazione ' . MSSQL_HOST . ' => ' . MSSQL_HOST2 . ' avvenuta con successo in: ';
                foreach ($resInsertData as $codice => $counts) {
                    $response['variabili'][$codice] = 'records ' . ($counts['inserted'] + $counts['failed']) . ' | riusciti ' . $counts['inserted'] . ' | falliti ' . $counts['failed'];
                    $total += $counts['inserted'];
                }
                $response['message'] .= Utility::benchmark(START) . '. Record inseriti: ' . $total;
            } else {
                $response['ok'] = false;
                $response['codice errore'] = 400;
                $response['descrizione errore'] = 'Nessuna variabile da sincronizzare trovata';
            }            
            $this->response = $response;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
}
