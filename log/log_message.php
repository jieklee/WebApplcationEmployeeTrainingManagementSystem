<?php

function log_message($error = '', $message = ''){
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $time = date("H:i:s");
    $error = strtoupper($error);
    $error_message = "$time --- $error $message\n";

    $dir = '../log';
    if(!file_exists($dir)){
        $dir = 'log';
    }
    $file_name = $dir . '/error_log.php';
    $file = fopen($file_name, "a");
    fwrite($file, $error_message);
    fclose($file);
}