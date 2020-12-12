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
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    $path = strtok($url, '?');
    
    $db = [
        'sscp' => 'SSCP_data',
        'spt' => 'SPT',
        'utz' => 'dbutz',
        'core' => 'dbcore',
        'umd' => 'dbumd'
    ];
    
    foreach ($db as $alias => $name) {
        if (strpos($path, $alias) !== false) {
            $dbName = $name;
            $dbAlias = $alias;
            break;
        }
    }
    
    $routes = [
        'dati_acquisiti' => 'dati_acquisiti',
        'variabili' => 'variabili'
    ];
    
    foreach ($routes as $route => $table) {
        if (strpos($path, $route) !== false) {
            $queryTable = $table;
            $queryRoute = $route;
            break;
        }
    }
    
    $baseRegex = $dbAlias . '\/' . $queryRoute;
    if (preg_match('/' . $baseRegex  . '$/', $path) && $method == 'GET') {
        $queryFile = 'select_' . $queryTable;
        $queryParams = $_GET;
    } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches) && $method == 'GET') {
        $queryFile = 'select_' . $queryTable . 'by_id';
        $queryParams = ['id' => $matches[1]];
    } elseif (preg_match('/' . $baseRegex  . '$/', $path) && $method == 'POST') {
        $queryFile = 'insert_' . $queryTable;
        $queryParams = $_POST;
    } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches) && $method == 'PUT') {
        $queryFile = 'update_' . $queryTable;
        $queryParams = ['id' => $matches[1]];
    } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches) && $method == 'PATCH') {
        $queryFile = 'update_' . $queryTable;
        $queryParams = ['id' => $matches[1]];
    } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches) && $method == 'DELETE') {
        $queryFile = 'delete_' . $queryTable;
        $queryParams = ['id' => $matches[1]];
    } else {
        $queryFile = 'NODEF';
        $queryParams = [];
    }   

    include __DIR__ . '/inc/query/' . $queryTable . '/' . $queryFile . '.php';
    
//    $queryParams = [
//        'variabile' => [
//            //'value' => 10230
//            'value' => $_GET['var']        
//        ],
//        'tipoDato' => [
//            //'value' => 2
//            'value' => $_GET['type']
//        ],
//        'dataIniziale' => [
//            //'value' => '2017-01-11'
//            'value' => $_GET['datefrom']
//        ],
//        'dataFinale' => [
//            //'value' => '2017-01-12'
//            'value' => $_GET['dateto']
//        ]
//    ];
    
    $rawParams = [
        'variabile' => [
            'param' => 'var', 
            'bind' => ':variabile',
            'type' => 'int'
        ],
        'tipoDato' => [
            'param' => 'type',
            'bind' => ':tipoDato',
            'type' => 'int'
        ],
        'dataIniziale' => [
            'param' => 'datefrom',
            'bind' => ':dataIniziale',
            'type' => 'str'
        ],
        'dataFinale' => [
            'param' => 'dateto',
            'bind' => ':dataFinale',
            'type' => 'str'
        ]
    ];
    
    foreach ($rawParams as $keyParam => $params) {
        foreach ($params as $key => $value) {
            $bindParams[$keyParam][$key] = $value;
            if ($key === 'param') {
                if (array_key_exists($value, $queryParams)) {
                    $bindParams[$keyParam]['value'] = $queryParams[$value];
                } else {
                    $bindParams[$keyParam]['value'] = null;
                }
            }
        }
    }
    
    //$bindParams = array_merge_recursive($rawParams, $queryParams);

    $pdo = Db::connect($dbName);

    $stmt = Db::query($pdo, $rawQuery, $bindParams);

    $records = Db::fetch($stmt);

    $response = [
        'ok' => true,
        'url' => $url,
        'path' => $path,
        'method' => $method,
        'base' => $baseRegex,
        'queryType' => $queryFile,
        'queryParams' => $queryParams,
        'db' => $dbName,
        'table' => $queryFile,
        'bindParams' => $bindParams,
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
