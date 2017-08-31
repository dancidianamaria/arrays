<?php

require_once "Database/input.php";
require_once "Operations/from.php";
require_once "Operations/select.php";
require_once "Operations/join.php";
require_once "Output/select_output.php";
require_once "Output/join_output.php";
require_once "constants.php";

try {
    $input_method = input_method();
    $input = get_input_params($input_method);

    $input = verify_params($input);
    list($header, $info) = csvToArray($input['f']);



    $database = moveIdsAsRowKeys($header, $info);

    $database = execute_select($input, $database);

    $database = execute_join($input, $database, $header);

    if(strlen($_REQUEST["j"])>1) {
        $header = array_pop($database);
    }

    output($database, $header);


} catch (Exception $e) {

    echo $e->getMessage();

}