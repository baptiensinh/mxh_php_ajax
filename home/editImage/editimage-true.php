<?php
require_once "../../includes/config.php";
session_start();
$get_title=$_POST["message"];
$get_description=$_POST["message1"];
$sql = 'UPDATE photos SET title="'.$get_title.'" WHERE id='.$_SESSION["id-img"].'';
$sql2 = 'UPDATE photos SET images_description="'.$get_description.'" WHERE id='.$_SESSION["id-img"].'';
if ($link->query($sql) === TRUE && $link->query($sql2) === TRUE) {
    echo '<script language="javascript">';
    echo 'alert("Title updated successfully");';
    echo '</script>';
    echo '<script language="javascript">';
    echo 'window.location.href = "../../home/newsfeed.php?id='.$_SESSION["id-img"].'"';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Title updated unsuccessfully");';
    echo '</script>';
    echo '<script language="javascript">';
    echo 'window.location.href = "../../home/newsfeed.php?id='.$_SESSION["id-img"].'"';
    echo '</script>';
}
// $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

// if ($conn->query($sql) === TRUE) {
//     echo "Record updated successfully";
// } else {
//     echo "Error updating record: " . $conn->error;
// }
// echo $sql;
// echo $get_title;
$link->close();