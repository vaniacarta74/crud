<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace vaniacarta74\Crud;

require __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    $queryParams = [
        'variabile' => [
            //'value' => 10230
            'value' => $_GET['var']        
        ],
        'tipoDato' => [
            //'value' => 2
            'value' => $_GET['type']
        ],
        'dataIniziale' => [
            //'value' => '2017-01-11'
            'value' => $_GET['datefrom']
        ],
        'dataFinale' => [
            //'value' => '2017-01-12'
            'value' => $_GET['dateto']
        ]
    ];

    $pdo = Db::connect('SSCP_data');

    $stmt = Db::query($pdo, 'query_dati_acquisiti', $queryParams);

    $records = Db::fetch($stmt);

    $response = [
        'ok' => true,
        'records' => $records
    ];    
    http_response_code(200);
    echo json_encode($response);
} catch (\Exception $e) {
    http_response_code(400);
    Error::errorHandler($e, 1, 'cli');
    Error::noticeHandler($e, 2, 'json');
    exit();
}
