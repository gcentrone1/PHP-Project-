<?php
 if (!in_array($orderBy, getConfig('orderByColumns'))) {
    $orderBy = 'id';
}
$params = [
    'orderBy' => $orderBy,
    'orderDir' => $orderDir,
    'recordsPerPage' => $recordsPerPage,
    'search' => $search,
    'page' => $page
];
$orderByParams = $orderByNavigator = $params;
unset($orderByParams['orderBy']);
unset($orderByParams['orderDir']);
unset($orderByNavigator['page']);
$orderByQueryString = http_build_query($orderByParams, '&amp;');
$navOrderByQueryString = http_build_query($orderByNavigator, '&amp;');
$users = getUsers($params);
$totalUsers = countUsers($params);

$numPages = ceil($totalUsers / $recordsPerPage / 2);
require_once('view/usersList.php');

?>