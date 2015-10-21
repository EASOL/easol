<?php

$csvOutput=[];
$headers=[];
foreach($columns as $column){
    if(is_array($column)){
        $colName = $column['title'];
    }
    else
        $colName = $column;
    $headers[] =$colName;

}

$csvOutput[]=$headers;



foreach ($query->result() as $row) {
    $csvRow = [];


    foreach ($columns as $column) {
        $colType = 'text';
        if (is_array($column)) {
            $colName = $column['name'];
            if (array_key_exists('type', $column))
                $colType = $column['type'];
        } else
            $colName = $column;
        if (isset($row->$colName)) {
            $value = $row->$colName;
            if (isset($column['value'])) {
                $value = $column['value']($row);
            }

            if ($colType == 'url') {

                $csvRow[] = '=HYPERLINK("' . $column['url']($row) . '", "' . $value . '")';
            } else {
                $csvRow[] = $value;
            }
        }


    }
    $csvOutput[] = $csvRow;
}


//print_r($csvOutput);

$out = fopen('php://output', 'w');

foreach ($csvOutput as $fields) {
    fputcsv($out, $fields);
}

fclose($out);





?>