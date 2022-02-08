<?php

require_once('functions.php');

if (!empty($_SESSION['loggedin'])) {
    header('Location : index.php');
    exit;
}

require_once('headerInclude.php');
?>
<!-- Begin page content -->
<main role="main" class="container">
    <h1 class="text-center p-2">USER MANAGEMENT SYSTEM </h1>
    <?php

    if (!empty($_SESSION['message'])) {
        $message = $_SESSION['message'];
        $alertType = $_SESSION['success'] ? 'success' : 'danger';
        require 'view/message.php';
        unset($_SESSION['message'], $_SESSION['success']); //serve ad eliminare il messaggio USER DELETED quando si ricarica la pagina 
    }

    
    require_once 'controller/displayUser.php';

    ?>
</main>


<?php
require_once('view/footer.php');
?>