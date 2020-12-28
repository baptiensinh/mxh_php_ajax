<?php
session_start();
require_once "../includes/connectdb.php";
// if (isset($_SESSION["idAdmin"])) {
    $postID = $_GET['id'];

    // Get post from database
    $result = $link->query("SELECT * FROM posts WHERE id = " . $postID . " ");
    $row = mysqli_fetch_assoc($result);

    // Update status_photo for user
    // status_post = -1 ---> deleted posts
    // status_post = 0 --->  posts
    // status_post = 1 ---> blocked user

    $link->query("DELETE FROM posts WHERE status_post = -1 and id = ".$row['id']."");

    header("Location: ListUsers.php");
// } 
// else 
// {
//     header("Location: index.php");
// }
