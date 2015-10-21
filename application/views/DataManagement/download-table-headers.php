<?php

$csvHeader = [];

foreach($data as $d){
    $csvHeader[] = $d->COLUMN_NAME;
}


$out = fopen('php://output', 'w');
fputcsv($out, $csvHeader);

fclose($out);