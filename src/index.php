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
//    $varId = isset($_GET['id']) ? '&id=' . $_GET['id'] : null;
//    $taditional = 'src/index.php?db=' . $_GET['db'] . '&table=' . $_GET['table'] . $varId . '&';
//    $restful = 'api/' . $_GET['db'] . '/' . $_GET['table'] . (isset($varId) ? '/' . $_GET['id'] : null) . '?';
//    $url = str_replace($taditional, $restful, $_SERVER['REQUEST_URI']);
//    $method = 'PATCH';
    
    $url = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    
    $path = strtok($url, '?');
    
    $router = new Router($path, $method);
    $dbName = $router->getDb();
    $resource = $router->getResource();
    $queryParams = $router->getQueryParams();
    $urlParams = $router->getUrlParams();

    $validator = new Validator($queryParams, $urlParams);
    $purgedQuery = $validator->getPurgedQuery();
    $validParams = $validator->getValidParams();
    
    $results = DbWrapper::dateTime($dbName, $purgedQuery, $validParams);
    
    $responder = new Responder($resource, $results);
    $response = $responder->getResponse();
    
    http_response_code(200);
    echo json_encode($response);
} catch (\Exception $e) {
    http_response_code(400);
    Error::errorHandler($e, 1, 'cli');
    Error::noticeHandler($e, 2, 'json');
    exit();
}
