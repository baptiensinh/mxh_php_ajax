<?php
session_start();
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location: ../home/");
//     // exit;
// }
// Include config file
require_once "../includes/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $sql_email = 'SELECT *
    FROM users
    WHERE email = "' . $email . '" and pass="' . $password . '"';
    $result = $link->query($sql_email);
    // echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($email == $row["email"]) {
            // $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            echo '<script language="javascript">';
            // echo 'alert("Login successful.")';
            echo 'alert("Login successful\nWelcome back '. $_SESSION["username"].'")';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../home/"';
            echo '</script>';
        }

        //echo ("This is session<br>");
        // echo ($_SESSION["username"]."<br>");
        // echo ($_SESSION["id"]."<br>");

    } else {
        echo '<script language="javascript">';
        echo 'alert("Login unsuccessful.\nEmail or password is incorrect.\nYou will return Login, right now.")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../login/"';
        echo '</script>';
    }
    //echo ($sql);
}
