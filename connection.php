<?php


//var_dump($config);
$config = require('congif.php');
$mysqli = new mysqli(
    $config['mariadb_host'],
    $config['mariadb_user'],
    $config['mariadb_password'],
    $config['mariadb_db'],
);
//unset è come se azzerasse la variabile nonopstate sia stata definita. in pratica ora non esiste più 

if ($mysqli->connect_error) {
    die($mysqli->connect_error);
}
