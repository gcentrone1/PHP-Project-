<?php

require_once 'functions.php';
require_once 'model/user.php';
require_once 'view/top.php';


$pageUrl = $_SERVER['PHP_SELF'];
$updateUrl = ('updateUser.php');
$deleteUrl = ('controller/updateRecord.php');
$orderDir = getParam('orderDir', 'DESC');

$orderBy = getParam('orderBy', 'id');

$orderByColumns =  getConfig('orderByColumns', ['id', 'surname', 'email', 'fiscalcode', 'age', 'roletype']);

$recordsPerPage = getParam('recordsPerPage', getConfig('recordsPerPage'));

$recordsPerPageOption = getConfig('recordsPerPageOption', [5, 10, 20, 30, 50]);

$search = getParam('search', '');
$page = getParam('page', 1);

require_once('view/navbar.php');
?>