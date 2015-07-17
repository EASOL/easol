<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 7/17/2015
 * Time: 12:23 AM
 */
$csvHeader = [];

foreach($data as $d){
    $csvHeader[] = $d->COLUMN_NAME;
}


$out = fopen('php://output', 'w');
fputcsv($out, $csvHeader);

fclose($out);