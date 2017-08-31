<?php

function input_method()
{
    return php_sapi_name() === 'cli'
        ? "console"
        : "browser";
}

function get_input_params($input_method)
{
    if ($input_method === "console") {

        $shortopts = "f:";  // from
        $shortopts .= "s:"; // select
        $shortopts .= "j::";
        $shortopts .= "w::"; // where; optional

        $options = getopt($shortopts);

        return $options;

    } else {

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            return $_POST;
        }

        return $_GET;
    }

}

function verify_params($options)
{

    foreach ($options as $key => $option){
        if($option == ""){
            unset($options[$key]);
        }
    }

//    $no_options = count($options);
//
//    for ($i=0;$i<$no_options;$i++){
//        if($options[$i] == ""){
//            unset($options[$i]);
//        }
//    }

//    if(isset($options['s']) === true and $options['s'] == ""){
//        unset($options['s']);
//    }
//
//    if(isset($options['f']) === true and $options['f'] == ""){
//        unset($options['f']);
//    }
//
//    if(isset($options['j']) == true and $options['j'] == ""){
//        unset($options['j']);
//    }

    if (!isset($options['f'])) {

        throw new Exception("From parameter missing! Error!");
    }

    return $options;
}