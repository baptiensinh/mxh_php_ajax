<?php
session_start();
require_once "../includes/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldpass = $_POST["passold"];
    $newpass = $_POST["passnew"];
    $sql2 = 'UPDATE users SET pass="' . $newpass . '" and WHERE id=' . $_SESSION["id"] . '';
    if ($oldpass == $newpass) {
        echo '<script language="javascript">';
        echo 'alert("The password cannot be identical")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../home/changepass.php?id=' . $_SESSION["id"] . '"';
        echo '</script>';
    } else {
        $sql = 'SELECT *  FROM users WHERE id='. $_SESSION["id"] .' and pass="' . $oldpass . '"';
        $result = $link->query($sql);
        if (mysqli_num_rows($result) == 1) {
            $sql2 = 'UPDATE users SET pass="' . $newpass . '" WHERE id=' . $_SESSION["id"] . '';
            if ($link->query($sql2) === TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Updated password successfully")';
                echo '</script>';
                echo '<script language="javascript">';
                echo 'window.location.href = "../home/profile.php?id=' . $_SESSION["id"] . '"';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo "Error updating record: " . $link->error;
                echo 'alert("Updated password unsuccessfully")';
                echo '</script>';
                echo '<script language="javascript">';
                echo 'window.location.href = "../home/changepass.php?id=' . $_SESSION["id"] . '"';
                echo '</script>';
            }
        } else {
            echo '<script language="javascript">';
            echo 'alert("Updated password unsuccessfully.\nOld password not true")';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../home/changepass.php?id=' . $_SESSION["id"] . '"';
            echo '</script>';
        }
    }
}
$link->close();