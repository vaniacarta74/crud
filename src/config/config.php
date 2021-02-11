<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\config;

require_once('php_Router.inc.php');

$now = new \DateTime('NOW', new \DateTimeZone('Europe/Rome'));
define('START', $now->format('Y-m-d H:i:s.u'));

define('DEBUG_LEVEL', 1);
define('ERROR_LOG', __DIR__ . '/../../log/error.log');
