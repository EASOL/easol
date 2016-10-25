<?php
/*
| -------------------------------------------------------------------
| DATABASE SETTINGS FOR CONTINUOUS INTEGRATION ENVIRONMENT
| -------------------------------------------------------------------
| This file provides default database settings for CI purposes
*/

defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'testing';
$query_builder = TRUE;

$db['testing'] = array(
    'dsn'   => '',
    'hostname' => $_ENV['CI_DATABASE_HOSTNAME'],
    'username' => $_ENV['CI_DATABASE_USERNAME'],
    'password' => $_ENV['CI_DATABASE_PASSWORD'],
    'database' => $_ENV['CI_DATABASE_NAME'],
    'dbdriver' => 'sqlsrv',
    'dbprefix' => '',
    'pconnect' => TRUE,
    'db_debug' => TRUE,
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
$db['testing']['port'] = 1433;