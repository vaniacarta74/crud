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
    $id = isset($_GET['id']) ? '&id=' . $_GET['id'] : null;
    $taditional = 'src/index.php?db=' . $_GET['db'] . '&table=' . $_GET['table'] . $id . '&';
    $restful = 'api/' . $_GET['db'] . '/' . $_GET['table'] . (isset($id) ? '/' . $_GET['id'] : null) . '?';
    $url = str_replace($taditional, $restful, $_SERVER['REQUEST_URI']);
    $method = 'GET';
    
    //$url = $_SERVER['REQUEST_URI'];
    //$method = $_SERVER['REQUEST_METHOD'];
    
    $path = strtok($url, '?');
    
//    $db = [
//        'sscp' => 'SSCP_data',
//        'spt' => 'SPT',
//        'utz' => 'dbutz',
//        'core' => 'dbcore',
//        'umd' => 'dbumd'
//    ];
//    
//    foreach ($db as $alias => $name) {
//        if (strpos($path, $alias) !== false) {
//            $dbName = $name;
//            $dbAlias = $alias;
//            break;
//        }
//    }
//    
//    $routes = [
//        'dati_acquisiti' => 'dati_acquisiti',
//        'variabili' => 'variabili'
//    ];
//    
//    foreach ($routes as $route => $table) {
//        if (strpos($path, $route) !== false) {
//            $queryTable = $table;
//            $queryRoute = $route;
//            break;
//        }
//    }  
    
//    $baseRegex = $dbAlias . '\/' . $queryRoute;
//    if (preg_match('/' . $baseRegex  . '$/', $path) && $method == 'GET') {
//        $crud = 'R';
//        $queryFile = 'select_' . $queryTable;
//        $queryParams = $_GET;
//    } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches) && $method == 'GET') {
//        $crud = 'R';
//        $queryFile = 'select_' . $queryTable . '_by_id';
//        $queryParams['id'] = $matches[1];
//    } elseif (preg_match('/' . $baseRegex  . '$/', $path) && $method == 'POST') {
//        $crud = 'C';
//        $queryFile = 'insert_' . $queryTable;
//        $post = file_get_contents('php://input');
//        $queryParams = json_decode($post, true);
//    } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches) && $method == 'PUT') {
//        $crud = 'U';
//        $queryFile = 'update_' . $queryTable;
//        $queryParams = $_GET;
//        $queryParams['id'] = $matches[1];
//    } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches) && $method == 'PATCH') {
//        $crud = 'U';
//        $queryFile = 'update_' . $queryTable;
//        $queryParams = $_GET;
//        $queryParams['id'] = $matches[1];
//    } elseif (preg_match('/' . $baseRegex  . '\/([0-9]+)$/', $path, $matches) && $method == 'DELETE') {
//        $crud = 'D';
//        $queryFile = 'delete_' . $queryTable;
//        $queryParams['id'] = $matches[1];
//    } else {
//        $crud = 'ND';
//        $queryFile = 'NODEF';
//        $queryParams = [];
//    } 
    
    $router = new Router($path, $method);
    $queryParams = $router->getQueryParams();
    $urlParams = $router->getUrlParams();

    $validator = new Validator($queryParams, $urlParams);
    $rawParams = $validator->getRawParams();
    
    //include __DIR__ . '/inc/query/' . $queryTable . '/' . $queryFile . '.php';
    
    foreach ($rawParams as $keyParam => $params) {
        foreach ($params as $key => $value) {
            $bindParams[$keyParam][$key] = $value;
            if ($key === 'param') {
                if (array_key_exists($value, $urlParams)) {
                    $bindParams[$keyParam]['value'] = $urlParams[$value];
                } else {
                    $bindParams[$keyParam]['value'] = null;
                }
            }
        }
    }
    
    switch ($crud) {
        case 'C':
            $pdo = Db::connect($dbName);
            $stmt = Db::query($pdo, $rawQuery, $bindParams);
            $id = $pdo->lastInsertId();
            $queryParams1 = ['id' => intval($id)];
            include __DIR__ . '/inc/query/' . $queryTable . '/select_' . $queryTable . '_by_id.php';    
            foreach ($rawParams as $keyParam => $params) {
                foreach ($params as $key => $value) {
                    $bindParams1[$keyParam][$key] = $value;
                    if ($key === 'param') {
                        if (array_key_exists($value, $queryParams1)) {
                            $bindParams1[$keyParam]['value'] = $queryParams1[$value];
                        } else {
                            $bindParams1[$keyParam]['value'] = null;
                        }
                    }
                }
            }
            $stmt = Db::query($pdo, $rawQuery, $bindParams1);
            $records = Db::fetch($stmt);
            break;
        case 'R':
            $pdo = Db::connect($dbName);
            $stmt = Db::query($pdo, $rawQuery, $bindParams);
            $records = Db::fetch($stmt);
            break;
        case 'U':
            $pdo = Db::connect($dbName);            
            foreach ($bindParams as $keyParam => $params) {
                if (isset($params['value']) && $params['param'] !== 'id') {
                    $arrSet[] = substr($params['bind'], 1) . '=' . $params['bind'];
                }
            }
            $replaceStrings[] = implode(',', $arrSet);            
            $bindQuery = str_replace($tableParams, $replaceStrings, $rawQuery);
            foreach ($bindParams as $keyParam => $params) {
                if (isset($params['value'])) {
                    foreach ($params as $key => $value) {
                        $bindParams1[$keyParam][$key] = $value;
                    }
                }
            }
            $stmt = Db::query($pdo, $bindQuery, $bindParams1);
            $queryParams1 = ['id' => $bindParams1['id']['value']];
            include __DIR__ . '/inc/query/' . $queryTable . '/select_' . $queryTable . '_by_id.php';    
            foreach ($rawParams as $keyParam => $params) {
                foreach ($params as $key => $value) {
                    $bindParams2[$keyParam][$key] = $value;
                    if ($key === 'param') {
                        if (array_key_exists($value, $queryParams1)) {
                            $bindParams2[$keyParam]['value'] = $queryParams1[$value];
                        } else {
                            $bindParams2[$keyParam]['value'] = null;
                        }
                    }
                }
            }
            $stmt = Db::query($pdo, $rawQuery, $bindParams2);
            $records = Db::fetch($stmt);
            break;
        case 'D':
            $pdo = Db::connect($dbName);
            $stmt = Db::query($pdo, $rawQuery, $bindParams);
            $records = [
                'id' => $bindParams['id']['value'],
                'deleted' => true
            ];
            break;
    }
    
    $response = [
        'ok' => true,
        'url' => $url,
        'path' => $path,
        'method' => $method,
        'base' => $baseRegex,
        'queryType' => $queryFile,
        'queryParams' => $queryParams,
        'queryParams1' => $queryParams1,
        'db' => $dbName,
        'table' => $queryFile,
        'bindParams' => $bindParams,
        'bindParams1' => $bindParams1,
        'bindParams2' => $bindParams2,
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
