<?php
require_once "../includes/config.php";
session_start();
//TODO: get id image need delete
$id = $_GET["id"];
$stt = 2;
//TODO: show user name
$sql_showusername = 'SELECT * FROM users WHERE id=(SELECT id_user FROM photos WHERE id=' . $id . ')';
$result_showusername = $link->query($sql_showusername);
$showusername = '';
$row_showusername = mysqli_fetch_assoc($result_showusername);
if (mysqli_num_rows($result_showusername) > 0) {
    if (isset($_SESSION['id']) && $_SESSION['id'] ==  $row_showusername["id"]) {
        //TODO: delete image here
        //DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste';
        $sql = 'UPDATE photos SET status_photo=' . $stt . ' WHERE id=' . $id . '';
        if ($link->query($sql) === TRUE) {
            echo '<script language="javascript">';
            echo 'alert("Delete success");';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../home/profile.php?id=' . $row_showusername["id"] . '"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Delete unsuccess");';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../home/profile.php?id=' . $row_showusername["id"] . '"';
            echo '</script>';
        }
    } else {
        //TODO: sure -> out
        echo '<script language="javascript">';
        echo 'alert("Website not available");';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../home/"';
        echo '</script>';
    }
} else {
    echo '<script language="javascript">';
    echo 'alert("Website not available");';
    echo '</script>';
    echo '<script language="javascript">';
    echo 'window.location.href = "../home/"';
    echo '</script>';
}
