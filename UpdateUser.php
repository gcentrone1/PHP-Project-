<?php
session_start();
if(!empty($_SESSION['loggedin'])){
    header('Location : index.php');
    exit;
} 
require_once('headerInclude.php');

?>
<main role="main" class="container">
    <h1 class="text-center p-2">USER MANAGEMENT SYSTEM </h1>
    <?php
    $id = getParam('id', 0);
    $action = getParam('action', '');
    $orderDir = getParam('orderDir', 'DESC');
    $search = getParam('search', '');
    $page = getParam('page', 1);

    $orderBy = getParam('orderBy', 'id');
    $paramsArray = compact('orderBy','orderDir','page','search');
    $defaultParams = http_build_query($paramsArray, '','&amp;');

    if ($id) {
        $user = getUser($id);
    } else {

        $user = [
            'username' => '',
            'email' => '',
            'age' => '',
            'fiscalcode' => '',
            'id' => '',
            'password' => '',
            'roletype' => 'user',
        ];
    }
    require_once('view/formUpdate.php');

    ?>
</main>
<?php
require_once('view/footer.php');

?>