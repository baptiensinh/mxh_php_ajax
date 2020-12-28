<?php
session_start();
require_once "../includes/connectdb.php";
// if (isset($_SESSION["idAdmin"])) {
    $postID = $_GET['id'];

    // Get post from database
    $result = $link->query("SELECT * FROM posts WHERE id = " . $postID . " ");
    $row = mysqli_fetch_assoc($result);

    // Update status_photo for user
    // status_post = 0 ---> deleted posts
    // status_post = 0 ---> unapproved posts
    // status_post = 1 ---> approved posts
    // status_post = 2 ---> blocked user

    $link->query("UPDATE posts SET status_post = -1 WHERE id = " . $row['id'] . "");

    header("Location: ListUsers.php");
} 
// else 
// {
//     header("Location: index.php");
// }
