<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace vaniacarta74\Crud\inc\query;

$rawQuery = "SELECT
                variabile,
                valore,
                CONVERT(varchar, data_e_ora, 20) AS data_e_ora,
                tipo_dato
            FROM
                dati_acquisiti
            WHERE
                id_dato = :id_dato";

$rawParams = [
    'variabile' => [
        'param' => 'id', 
        'bind' => ':id_dato',
        'type' => 'int'
    ]
];

