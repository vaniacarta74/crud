<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace vaniacarta74\Crud\inc\query;

$rawQuery = "INSERT INTO
                dati_acquisiti
                (variabile, valore, data_e_ora, tipo_dato)
            VALUES
                (:variabile, :valore, :data_e_ora, :tipo_dato)";

$rawParams = [
    'variabile' => [
        'param' => 'var', 
        'bind' => ':variabile',
        'type' => 'int'
    ],
    'tipoDato' => [
        'param' => 'type',
        'bind' => ':tipo_dato',
        'type' => 'int'
    ],
    'data_e_ora' => [
        'param' => 'date',
        'bind' => ':data_e_ora',
        'type' => 'str'
    ],
    'valore' => [
        'param' => 'val',
        'bind' => ':valore',
        'type' => 'int'
    ]
];

