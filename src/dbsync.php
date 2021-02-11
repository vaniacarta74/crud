<?php

namespace vaniacarta74\Crud;

require __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    $jsonVarSync = Curl::run('http://localhost/crud/api/h1/core/variabili_sync/ALL');
    $resVarSync = json_decode($jsonVarSync, true);
    $variabili = $resVarSync['response']['records'];
    
    $distinct[] = $variabili[0]['codice'];
    $maxId = count($variabili);
    for ($i = 1; $i < $maxId; $i++) {        
        if ($variabili[$i - 1]['codice'] !== $variabili[$i]['codice']) {
            $distinct[] = $variabili[$i]['codice'];
        }
    }
    //echo json_encode($distinct);
    
    $jsonSptMaxData = Curl::run('http://localhost/crud/api/h2/spt/vista_variabili_maxdata/ALL');
    //echo $jsonSptMaxData;
    $arrSptMaxData = json_decode($jsonSptMaxData, true);
    
    $jsonSscpMaxData = Curl::run('http://localhost/crud/api/h2/sscp/vista_variabili_maxdata/ALL'); 
    //echo $jsonSscpMaxData;
    $arrSscpMaxData = json_decode($jsonSscpMaxData, true);
    
    $maxData = array_merge($arrSptMaxData['response']['records'], $arrSscpMaxData['response']['records']);
    //echo json_encode($maxData);
    
    $distData = [];
    $j = 0;
    $iMax = count($maxData);
    foreach ($distinct as $codice) {
        for ($i = $j; $i < $iMax; $i++) {
            if ($codice === $maxData[$i]['codice']) {
                $distData[$codice] = $maxData[$i]['data_e_ora'];
                break;
            }
        }
        $j = $i;
    }
    //echo json_encode($distData);
    
    foreach ($distData as $codice => $data) {
        $arrCodice = explode('.', $codice);
        $db = ($arrCodice[0] === 'SPT') ? 'spt' : 'sscp';
        $variabile = $arrCodice[1];
        $tipo_dato = $arrCodice[2];
        $data_iniziale = str_replace(' ', 'T', $data);
        $data_finale = str_replace(' ', 'T', date('Y-m-d H:i:s'));
        $jsonNewData = Curl::run('http://localhost/crud/api/h1/' . $db . '/dati_acquisiti?var=' . $variabile . '&type=' . $tipo_dato . '&datefrom=' . $data_iniziale . '&dateto=' . $data_finale);
        $resNewData = json_decode($jsonNewData, true);
        $newData[$codice] = $resNewData['response']['records'];
    }
    //echo json_encode($newData);
    
    foreach ($newData as $codice => $records) {
        $arrCodice = explode('.', $codice);
        $db = ($arrCodice[0] === 'SPT') ? 'spt' : 'sscp';
        foreach ($records as $n_rec => $fields) {
            $params = [
                'var' => $fields['variabile'],
                'type' => $fields['tipo_dato'],
                'date' => str_replace(' ', 'T', $fields['data_e_ora']),
                'val' => $fields['valore']
            ];
            $jsonInsertData = Curl::run('http://localhost/crud/api/h2/' . $db . '/dati_acquisiti', 'POST', $params);
            $resInsertData[$codice][] = json_decode($jsonInsertData, true);
        }      
    }
    $resInsertData['time'] = Utility::benchmark(START);
    echo json_encode($resInsertData);
    
    http_response_code(200);
    //echo json_encode($response);
} catch (\Exception $e) {
    http_response_code(400);
    Error::errorHandler($e, 1, 'cli');
    Error::noticeHandler($e, 2, 'json');
    exit();
}