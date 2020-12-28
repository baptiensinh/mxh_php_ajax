<?php
require_once "../includes/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $sql = 'INSERT INTO users (username, email, pass) VALUES ("' . $username . '","' . $email . '","' . $password . '")';
    if ($link->query($sql) === TRUE) {
        echo '<script language="javascript">';
        echo 'alert("Add User successfully!")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "ListUsers.php"';
        echo '</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo '<script language="javascript">';
        echo 'alert("Add user unsuccessfully!")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "ListUsers.php"';
        echo '</script>';
    }
}
