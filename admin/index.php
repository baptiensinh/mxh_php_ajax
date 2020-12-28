<?php 
include('includes/header.php'); 
include('includes/navbar.php'); 
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