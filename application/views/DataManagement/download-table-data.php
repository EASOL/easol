<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 7/15/2015
 * Time: 5:10 PM
 */
$di = 0;
$csvHeader = [];
$csvData=[];
foreach($data as $d){
    if($di==0){
        foreach($d as $column => $colData){
            $csvHeader[] = $column;
        }
    }
    foreach($d as $column => $colData){
        $csvData[$di][] = $colData;
    }
    $di++;
}


$out = fopen('php://output', 'w');
fputcsv($out, $csvHeader);

foreach ($csvData as $fields) {
    fputcsv($out, $fields);
}

fclose($out);