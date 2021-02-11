<?php

namespace vaniacarta74\Crud;

require __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    $distinct = Sync::getVarToSync();    
    $maxData = Sync::getTargetAllMaxDates();
    $distData = Sync::getTargetVarMaxDates($distinct, $maxData);
    $newData = Sync::getSourceRecords($distData);
    $resInsertData = Sync::insertTargetRecords($newData);
    $response = Sync::setResponse($resInsertData);
    
    $code = $response['ok'] ? 200 : 400;
    http_response_code($code);
    echo json_encode($response);
} catch (\Exception $e) {
    http_response_code(400);
    Error::errorHandler($e, 1, 'cli');
    Error::noticeHandler($e, 2, 'json');
    exit();
}