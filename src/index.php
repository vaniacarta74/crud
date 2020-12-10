<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace vaniacarta74\Crud;

require __DIR__ . '/../vendor/autoload.php';

echo HOST . '<br/>';
echo RDBMS . '<br/>';
echo MSSQL_HOST . '<br/>';
echo MSSQL_USER . '<br/>';
echo MSSQL_PASSWORD . '<br/>';

//echo Db::printConnectionString() . '<br/>';
//
//$dsn = "dblib:host=MacBook\SQL_SERVER_DEV;dbname=SSCP_data;";
//
//$db = new \PDO($dsn, "sa", "Race14Maggio2016");

$pdo = Db::getPDO('SSCP_data');

$query = "SELECT * FROM variabili WHERE id_variabile = 1";

$stmt = $pdo->query($query);

foreach ($stmt as $row) {
    var_dump($row);
}

var_dump($stmt);

$pdo = Db::getPDO('SPT');

$query = "SELECT * FROM variabili WHERE id_variabile = 51012";

$stmt = $pdo->query($query);

foreach ($stmt as $row) {
    var_dump($row);
}

var_dump($stmt);

$pdo = Db::getPDO('SSCP_data');

$query = "SELECT * FROM variabili WHERE id_variabile = 1";

$stmt = $pdo->query($query);

foreach ($stmt as $row) {
    var_dump($row);
}

var_dump($stmt);

