<?php
    $host='localhost';
    $data='ToDo';
    $user='admin'; 
    $pass='admin';
    //$chrs='utf8bm4';
    $attr="mysql:host=$host;dbname=$data;"; //+charset=$chrs;
    $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
?>