<?php
session_start(); 
if(!empty($_SESSION['loggedin'])){
    header('Location : index.php');
    exit;
} 
$bytes = random_bytes(32);
$token = bin2hex($bytes); //conversione esadecimale 
$_SESSION['csrf'] = $token; //mettiamo token in sessione e poi passiamo in campo nascosto (type hidden)

require_once 'view/top.php';
?><section id="container" class="container  d-flex flex-column min-vh-100">
<div id="loginform">
<h1 style="text-align:center">LOGIN </h1>

    <form action="verify-login.php" method="post">
        <input type="hidden" name="_csrf" value="<?=$token?>">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" required class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" required class="form-control"  name ="password" id="password" placeholder="Password">
            </div>
            <div class=" form-group form-check">
                <input type="checkbox" name="rememberme" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class=" form-group form-check">

                <button type="submit" class="btn btn-primary">LOGIN</button>
            </div>
        </form>

    </div>
</section>







<?php
require_once 'view/footer.php';
?>