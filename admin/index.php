<?php 
require_once "../includes/connectdb.php";
require_once "../includes/session.php";

include('includes/header.php'); 
include('includes/navbar.php'); 


if (!isset($username2)){
     header("location: /phpmxh/admin/login/login.php");
}

?>

<div class="content" style="margin-left:200px">
    <main>
        <div class="container-fluid">
            <?php
                require_once("home.php")
            ?>
        </div>
    </main>
</div>

<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>