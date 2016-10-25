<?php 

$info = ['Database'=>'easol_dev', 'UID'=>'easol_dev_dba', 'PWD'=>$_ENV['CI_DATABASE_PASSWORD']];
 
$conn = sqlsrv_connect('oqc2uoyejf.database.windows.net', $info);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
/*

$serverName = "serverName\sqlexpress"; //serverName\instanceName
$connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password");

'hostname'     => 'tcp:oqc2uoyejf.database.windows.net,1433',
    'username'     => 'easol_dev_dba',
    'password'     => '%Z!A8iVnH6e$OKMk',
    'database'     => 'easol_dev',
    'dbdriver'     => 'sqlsrv',*/
?>
