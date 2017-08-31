<?php

function execute_select(array $input, array $database)
{
    if (!isset($input['s'])) {
        return $database;
    }

    $selectedFields = explode(',', $input['s']);

    foreach ($database as $userId => $dbRow) {
        foreach ($dbRow as $columnName => $columnValue) {
            if (in_array($columnName, $selectedFields) === true) {
                $select[$userId][$columnName] = $columnValue;
            }
        }
    }

    return $select;

}

function exec_select_first_line($userId, $row, $selectedFields)
{
}
