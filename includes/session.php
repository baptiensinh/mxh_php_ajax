<?php
session_start();
// $log_reg=$_SESSION["username"];
$log_reg = '';
if (isset($_SESSION["username"])) {
    $log_reg = '
            <li class="ds-hover nav-item text-white">
                <a class="nav-link pl-1" href="../home/profile.php?id='.$_SESSION["id"].'"> ' . $_SESSION["username"] . '</a>
            </li>
            <li class="ds-hover nav-item text-white ">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
        ';
        $log_reg_user = '
        <li class="text-white ">
            <a class="text-color" href="../home/profile.php?id='.$_SESSION["id"].'"> ' . $_SESSION["username"] . '</a>
        </li>';
        $id2=$_SESSION["id"];
        $username2=$_SESSION["username"];
        
      
} else {
    $log_reg = '
            <li class="ds-hover nav-item text-white">
                <a class="nav-link pl-1" href="../login">Login</a>
            </li>
            <li class="ds-hover nav-item text-white">
                <a class="nav-link" href="../register">Create a account</a>
            </li>
        ';
        $username2=null; 
        $log_reg_user=null;
}

?>