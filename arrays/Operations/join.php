<?php

require_once "join.php";

function execute_join($input, array $database, array $header)
{
    if (!isset($input['j'])) {
        return $database;
    }

    $tableNames = get_tables_for_join($input['j']);

    foreach ($tableNames as $tableName) {

        list($joinHeader, $joinTable) = csvToArray($tableName);

        $fkIndex = get_table_fk(JOIN_ON, $joinHeader);

        $table_name = str_replace('.csv', '', $tableName);

        $header[$table_name] = $joinHeader;

        foreach ($database as $userId => $row) {
            $database[$userId][$table_name] = array_filter($joinTable, function ($element) use ($userId, $fkIndex) {
                return $element[$fkIndex] == $userId;
            });

            $join_table_len = count($database[$userId][$table_name])*4;

            for($k=0;$k<$join_table_len;$k++) {

                unset($database[$userId][$table_name][$k][$fkIndex]);
            }
        }
    }

    array_push($database,$header);

    return $database;
}


function get_table_fk(array $foreignKeys, array $table_header)
{
    foreach ($foreignKeys as $foreignKey) {
        if (($fkIndex = array_search($foreignKey, $table_header)) !== false) {
            return $fkIndex;
        }
    }
}

function add_to_database($line, $table, $fk)
{

    global $database, $header;

    $table_name = explode(".", $table);
    $table_name = $table_name[0];

    foreach ($database as $key => $value) {
        $pos = array_search($fk, $header);

        if (isset($line[$pos]) and $key == $line[$pos]) {

            unset($line[$pos]);

            array_push($database[$key][$table_name], $line);

            if(isset($header[$table_name][$pos])){

                unset($header[$table_name][$pos]);
            }
        }

    }
}

function get_tables_for_join($join)
{
    return explode(",", $join);
}