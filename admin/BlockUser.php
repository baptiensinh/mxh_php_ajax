<?php
session_start();
require_once "../includes/connectdb.php";
// if (isset($_SESSION["idAdmin"])) {
    $userID = $_GET['id'];

    // Get user from database
    $result = $link->query("SELECT * FROM users WHERE id = " . $userID . " ");
    $rowUser = mysqli_fetch_assoc($result);

    // Update status_photo for user
    // status_post = 0 ---> unapproved posts
    // status_post = 1 ---> approved posts
    // status_post = 2 ---> blocked user

    $link->query("UPDATE posts SET status_post = 1 WHERE user_id = " . $rowUser['id'] . "");
    
    // Update status_user = 1 for delete in table users
    $link->query("UPDATE users SET status_user = 1 WHERE id = " . $rowUser['id'] . "");

    header("Location: ListUsers.php");
// } 
// else 
// {
//     header("Location: index.php");
// }
