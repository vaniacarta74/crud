<?php

namespace vaniacarta74\Crud;

require __DIR__ . '/../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    $sync = new Sync();
    $distinct = $sync->getVarToSync();
    $maxData = $sync->getTargetAllMaxDates();
    $distData = $sync->getTargetVarMaxDates($distinct, $maxData);
    $newData = $sync->getSourceRecords($distData);
    $resInsertData = $sync->insertTargetRecords($newData);
    $response = $sync->setResponse($resInsertData);
    
    $code = $response['ok'] ? 200 : 400;
    http_response_code($code);
    echo json_encode($response);
} catch (\Exception $e) {
    http_response_code(400);
    Error::errorHandler($e, 1, 'cli');
    Error::noticeHandler($e, 2, 'json');
    exit();
}