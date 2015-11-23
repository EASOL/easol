<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'mssql';
$query_builder = TRUE;

/* Connect MSSQL Server*/
$db['mssql']['dsn'] = '';
$db['mssql']['hostname'] = 'easol';
$db['mssql']['username'] = 'easol_dev@ngbivv3p2g';
$db['mssql']['password'] = '8#rrErBJia26cb';
$db['mssql']['database'] = 'easol_dev';
$db['mssql']['dbdriver'] = 'odbc';
$db['mssql']['dbprefix'] = '';
$db['mssql']['pconnect'] = FALSE;
$db['mssql']['db_debug'] = TRUE;
$db['mssql']['cache_on'] = FALSE;
$db['mssql']['cachedir'] = '';
$db['mssql']['char_set'] = 'utf8';
$db['mssql']['dbcollat'] = 'utf8_general_ci';
$db['mssql']['swap_pre'] = '';
$db['mssql']['autoinit'] = TRUE;
$db['mssql']['stricton'] = FALSE;
$db['mssql']['port'] = 1433;