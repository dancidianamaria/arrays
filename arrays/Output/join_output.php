<?php

function output($database, $header) {

    output_header($header);

    echo PHP_EOL;

    $primary_key_location = primary_key_location($header);

    output_database($database,$primary_key_location);
}

//function output_database($database)
//{
//    foreach ($database as $row_key=>$row_value){
//
//        foreach ($row_value as $attr){
//
//            if (is_array($attr) == false){
//
//                echo $attr."  ";
//            } else {
//                foreach ($attr as $table_name => $table_values) {
//
//
//                    foreach ($table_values as $table_value) {
//
//                        if (is_array($table_value) == false) {
//
//                            echo $table_value . "  ";
//                        } else {
//                            if (empty($table_value) == false) {
//                                $count_displayed = 0;
//                                while ($count_displayed <= MAX_DISPLAYED) {
//                                    echo array_values($table_value)[$count_displayed] . "  ";
//                                    $count_displayed++;
//                                }
//                            } else {
//                                echo "                    ";
//                            }
//
//                        }
//
//                    }
//                }
//            }
//        }
//        echo PHP_EOL;
//    }
//}

function output_database($database)
{

    foreach ($database as $row_key=>$row_value){
        echo "<tr style='border: 2px solid black;'>";
        foreach ($row_value as $attr){
            if (is_array($attr) == false){
                echo "<td style='border: 2px solid black;'>" . $attr. "</td>";
            } else {
                foreach ($attr as $table_name => $table_values) {
                    foreach ($table_values as $table_value) {
                        if (is_array($table_value) == false) {
                            echo "<td style='border: 2px solid black;'>" . $table_value . "</td>";
                        } else {
                            if (empty($table_value) == false) {
                                $count_displayed = 0;
                                while ($count_displayed <= MAX_DISPLAYED) {
                                    echo array_values($table_value)[$count_displayed] . "  ";
                                    $count_displayed++;
                                }
                            } else {
                                echo "                    ";
                            }
                        }
                    }
                }
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}

function primary_key_location($header){
    foreach ($header as $key=>$attr){
        if(is_array($attr) === false and $attr == PRIMARY_KEY){
            return $key;
        }
    }
}

//function output_header($header)
//{
//    foreach ($header as $row_key=>$row_name) {
//        if (is_array($row_name) == false){
//            echo $row_name."  ";
//        } else {
//
//            foreach ($row_name as $attr) {
//                if (to_be_displayed($attr) === true) {
//                    echo $row_key . "." . $attr . "  ";
//                }
//            }
//        }
//
//    }
//}

function output_header($header)
{
    echo "<table style='border: 2px solid black;'>";
    echo "<tr style='border: 2px solid black;'>";
    foreach ($header as $row_key=>$row_name) {
        if (is_array($row_name) == false){
            if (to_be_displayed($row_name) === true){
            echo "<th style='border: 2px solid black;'>" . $row_name . "</th>";
        }} else {
            foreach ($row_name as $attr) {
                if (to_be_displayed($attr) === true) {
                    echo "<th style='border: 2px solid black;'>" . $row_key . "." . $attr . "</th>";
                }
            }
        }
    }
    echo "</tr>";
}

function to_be_displayed($attr)
{
    if (in_array($attr,JOIN_ON) === true){
        return false;
    }

    return true;
}