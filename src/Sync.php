<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

/**
 * Description of Sync
 *
 * @author Vania
 */
class Sync
{
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
     * @return array
     * @throws \Exception
     */
    public function getVarToSync()
    {
        try {
            try {
                $resVarSync = $this->callCrudService('http://localhost/crud/api/h1/core/variabili_sync/ALL');
                if (!array_key_exists('records', $resVarSync)) {
                    throw new \Exception();
                }
            } catch (\Exception $e) {
                $resVarSync = ['records' => []];
            }  
            $variabili = $resVarSync['records'];
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
    
    public function getTargetAllMaxDates()
    {
        try {
            try {
                $resSptMaxData = $this->callCrudService('http://localhost/crud/api/h2/spt/vista_variabili_maxdata/ALL');
                if (!array_key_exists('records', $resSptMaxData)) {
                    throw new \Exception();
                }
            } catch (\Exception $e) {
                $resSptMaxData['records'] = [];
            }
            try {
                $resSscpMaxData = $this->callCrudService('http://localhost/crud/api/h2/sscp/vista_variabili_maxdata/ALL');
                if (!array_key_exists('records', $resSscpMaxData)) {
                    throw new \Exception();
                }
            } catch (\Exception $e) {
                $resSscpMaxData['records'] = [];
            }
            $maxData = array_merge($resSptMaxData['records'], $resSscpMaxData['records']); 
            
            return $maxData;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
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
    
    public function getSourceRecords($distData)
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
                try {
                    $resNewData = $this->callCrudService('http://localhost/crud/api/h1/' . $db . '/dati_acquisiti?var=' . $variabile . '&type=' . $tipo_dato . '&datefrom=' . $data_iniziale . '&dateto=' . $data_finale);
                    if (array_key_exists('records', $resNewData)) {
                        $newData[$codice] = $resNewData['records'];
                    } else {
                        throw new \Exception();
                    }                                        
                } catch (\Exception $e) {
                    $newData[$codice] = [];
                    continue;
                }
            }            
            return $newData;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
    
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
                foreach ($records as $n_rec => $fields) {
                    $params = [
                        'var' => $fields['variabile'],
                        'type' => $fields['tipo_dato'],
                        'date' => str_replace(' ', 'T', $fields['data_e_ora']),
                        'val' => $fields['valore']
                    ];
                    try {
                        $this->callCrudService('http://localhost/crud/api/h2/' . $db . '/dati_acquisiti', 'POST', $params);
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
    
    public function setResponse($resInsertData)
    {
        try {
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
            return $response;
        // @codeCoverageIgnoreStart
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
        // @codeCoverageIgnoreEnd
    }
}
