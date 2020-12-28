<?php
session_start();
require_once "../includes/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $sql = 'SELECT *
    FROM admins
    WHERE email = "' . $email . '" and pass="' . $password . '"';
    $result = $link->query($sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($email == $row["email"]) {
            $_SESSION["idAdmin"] = $row["id"];
            $_SESSION["usernameAdmin"] = $row["username"];
            echo '<script language="javascript">';
            // echo 'alert("Login successful.")';
            echo 'alert("Login successful\nWelcome back '. $_SESSION["username"].'")';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "index.php"';
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
        echo 'window.location.href = "index.php"';
        echo '</script>';
    }
}