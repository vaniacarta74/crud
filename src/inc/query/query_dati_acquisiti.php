<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace vaniacarta74\Crud\inc\query;

$selectQuery = "SELECT
                    variabile,
                    valore,
                    CONVERT(varchar, data_e_ora, 20) AS data_e_ora,
                    tipo_dato
                FROM
                    dati_acquisiti
                WHERE
                    variabile = :variabile AND
                    tipo_dato = :tipoDato AND
                    data_e_ora >= :dataIniziale AND
                    data_e_ora < :dataFinale
                ORDER BY
                    data_e_ora";

$selectParams = [
    'variabile' => [
        'bind' => ':variabile',
        'type' => 'int'
    ],
    'tipoDato' => [
        'bind' => ':tipoDato',
        'type' => 'int'
    ],
    'dataIniziale' => [
        'bind' => ':dataIniziale',
        'type' => 'str'
    ],
    'dataFinale' => [
        'bind' => ':dataFinale',
        'type' => 'str'
    ]
];

