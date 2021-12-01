<?php
ob_start();
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "sef_etms";

$db_connect = mysqli_connect($host, $user, $password, $database);

if(!$db_connect){
    die();
}