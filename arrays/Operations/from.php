<?php

function csvToArray($fileName)
{
    $table = readFromFile($fileName);

    return [
        extractHeader($table),
        $table
    ];
}

function readFromFile($from)
{
    $file = file_open($from);

    $lines = [];
    while (($line = fgetcsv($file)) !== false) {
        $lines[] = $line;
    }
    fclose($file);

    return $lines;
}

function extractHeader(array &$table)
{
    return array_shift($table);
}


function file_open($from) {

        $file = @fopen($from, "r");

        if ($file === false) {
            throw new Exception("The file ".$from." could not be open! Error!");
        }

        return $file;

}

function moveIdsAsRowKeys($header, $table)
{
    $database = [];

    $primary_key_location = array_keys($header, PRIMARY_KEY)[0];

    foreach ($table as $row) {
        $id_value = $row[$primary_key_location];
        unset($row[$primary_key_location]);
        $database[$id_value] = $row;
    }

    return $database;
}
