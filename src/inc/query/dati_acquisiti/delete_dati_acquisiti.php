<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace vaniacarta74\Crud\inc\query;

$rawQuery = "DELETE FROM
                dati_acquisiti
            WHERE
                id_dato = :id_dato";

$rawParams = [
    'id' => [
        'param' => 'id', 
        'bind' => ':id_dato',
        'type' => 'int'
    ]
];

