<?php
function connect(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "chutcuagiang";
    $db = "db";

    $connect = new mysqli($dbhost,$dbuser,$dbpass,$db) or die("Connect fail: %s\n ".$connect->error);
    return $connect;
}
?>
