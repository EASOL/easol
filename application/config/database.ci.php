
<?php
/*
| -------------------------------------------------------------------
| DATABASE SETTINGS FOR CONTINUOUS INTEGRATION ENVIRONMENT
| -------------------------------------------------------------------
| This file provides default database settings for CI purposes
*/

defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'mssql';
$query_builder = TRUE;

/* Connect MSSQL Server*/
$db['mssql']['dsn'] = '';
$db['mssql']['hostname'] = $_ENV['CI_DATABASE_HOSTNAME'];
$db['mssql']['username'] = $_ENV['CI_DATABASE_USERNAME'];
$db['mssql']['password'] = $_ENV['CI_DATABASE_PASSWORD'];
$db['mssql']['database'] = $_ENV['CI_DATABASE_NAME'];
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

?>