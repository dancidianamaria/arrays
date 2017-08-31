<?php

function select_output($output_method){

    global $fields;

    if (in_array(PRIMARY_KEY,$fields) === true){

        output_select_with_primary_key($output_method);
    }
    else {

        output_select($output_method);
    }
}

function output_select($output_method){


    if($output_method === "console"){

        output_select_console();
    }

    output_select_console();
}

function output_select_browser(){


}

function output_select_with_primary_key($output_method){

    if($output_method === "console"){

        output_select_pk_console();
    }

    output_select_pk_browser();

}

function output_select_pk_browser(){


}


function output_select_console()
{
    global $select;
    global $select_res;

    $select_res = [];

    foreach ($select as $key => $value) {

        $res_item = output_select_console_item($value);
        array_push($select_res,$res_item);
    }

}

function output_select_console_item($value){

    global $fields;

    $res_item = [];

    foreach ($fields as $field) {
        foreach ($value as $k => $v) {
            if ($k == $field) {

                echo $v . " ";
                array_push($res_item,$v);
            }

        }
    }

    echo PHP_EOL;
    return $res_item;
}

function output_select_pk_console()
{

    global $select;
    global $fields;
    global $select_res;

    $select_res = [];

    $pk_index = array_search(PRIMARY_KEY,$fields);


    foreach ($select as $key => $value) {

        $res_item = output_select_pk_console_item($value,$key,$pk_index);
        array_push($select_res,$res_item);

    }
}

function output_select_pk_console_item($value,$key,$pk_index){

    global $fields;

    $pos = 0;
    $added = 0;
    $res_item = [];

    foreach ($fields as $field) {
        foreach ($value as $k => $v) {
            if ($k == $field) {

                if($pos === $pk_index){
                    array_push($res_item,$key);
                    array_push($res_item,$v);
                    echo $key." ".$v." ";
                    $added = 1;
                    $pos ++;
                }
                else{
                    array_push($res_item,$v);
                    echo $v." ";
                    $pos ++;
                }

            }
        }
    }
    if ($added === 0){
        array_push($res_item,$key);
        echo $key." ";
    }
    echo PHP_EOL;
    return $res_item;
}