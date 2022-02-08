<?php


return [
    'mariadb_host' => 'localhost',
    'mariadb_user' => 'root',
    'mariadb_password' => 'root',
    'mariadb_db' => 'corsophp',
    'recordsPerPage' => 10,
    'recordsPerPageOption' => [
        5, 10, 20, 30, 50, 100
    ],
    'orderByColumns' => [

        'id', 'email', 'fiscalcode', 'age', 'username'
    ],
    'numLinkNavigator' => 5,
    'roletypes' => [
        'user', 'editor', 'admin'
    ],


];
