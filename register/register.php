<?php
// Include config file
require_once "../includes/connectdb.php";
include_once "../login/login.php";
echo $_SERVER["REQUEST_METHOD"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $avt_url='user.png';
    //query
    $sql_user = 'SELECT *
    FROM users
    WHERE username = "' . $username . '"';
    $sql_email = 'SELECT *
    FROM users
    WHERE email = "' . $email . '"';
    $sql_insert = "INSERT INTO users (username,email, pass,avatar_url) VALUES ('" . $username . "','" . $email . "','" . $password . "','" .$avt_url. "');";
    //excuet
    //echo ($sql);
    $result_user = $link->query($sql_user);
    $result_email = $link->query($sql_email);
    //echo ($result);
    if (mysqli_num_rows($result_user) > 0) {
        echo '<script language="javascript">';
        echo 'alert("This username is already taken.\nYou will be return register.\nThank you!")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../register/"';
        echo '</script>';
        //header("location: ../login/");
    } elseif (mysqli_num_rows($result_email) > 0) {
        echo '<script language="javascript">';
        echo 'alert("This email is already taken.\nYou will be return register.\nThank you!")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../register/"';
        echo '</script>';
    } else {
        //$sql_insert = "INSERT INTO users (username,email, pass) VALUES ('" . $username . "','" . $email . "','" . $password . "');";
        mysqli_query($link, $sql_insert);
        echo '<script language="javascript">';
        echo 'alert("Sign up successfully.\nLogin now.\nAutomatically switch to login.")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../login/"';
        echo '</script>';
    }
    //     echo ($sql);
    //     echo ($sql_insert);
    //     echo ($result);
    // } else {
    //     echo '<script language="javascript">';
    //     echo 'alert("Oops! Something went wrong, Return Register.")';
    //     echo '</script>';
    //     header("location: index.html");
}
mysqli_close($link);
