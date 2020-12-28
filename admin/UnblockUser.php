<?php
session_start();
require_once "../includes/connectdb.php";
// if (isset($_SESSION["idAdmin"])) {
    $userID = $_GET['id'];

    // Get user from table user by user id
    $resultUser = $link->query("SELECT * from users where id = " . $userID . "");
    $rowUser = mysqli_fetch_assoc($resultUser);

    // Update status_user in table users
    $link->query("UPDATE users SET status_user = 0 WHERE id = " . $rowUser['id'] . "");

// } else {
//     header("location:index.php");
// }
