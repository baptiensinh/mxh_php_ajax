<?php
session_start();
require_once "../includes/connectdb.php";

$sql_insert = "SELECT * relationships
 WHERE (user1= " .$_SESSION['id'] ." and user2=".$_GET['id']. ") or (user2= " .$_SESSION['id'] ." and user1=".$_GET['id']. ") ;";

$insert=mysqli_query($link, $sql_insert);
if(isset($insert)&& isset($_GET['id'])){
    $sql_insert = "UPDATE relationships set friend_stt=0
             WHERE (user1= " .$_SESSION['id'] ." and user2=".$_GET['id']. ") or (user2= " .$_SESSION['id'] ." and user1=".$_GET['id']. ") ;";
    $insert=mysqli_query($link, $sql_insert);
}else{

if(isset($_SESSION["id"]) && isset($_GET['id'])){
    $id = $_GET['id'];
        $sql_insert = "INSERT INTO relationships (user1,user2, friend_stt,user_invite) VALUES
            ('" . $_SESSION["id"] . "','" . $_GET["id"] . "','" . 0 . "','" .$_SESSION["id"]. "');";

        $insert=mysqli_query($link, $sql_insert);
    }
    else{
        echo '<script language="javascript">';
                echo 'window.location.href = "../login"';
                echo '</script>';
    }
}
if($insert){
    echo '<script language="javascript">';
    echo 'alert("has sent a friend invitation");';
    echo '</script>';
    echo '<script language="javascript">';
    echo 'window.location.href = "../home"';
    echo '</script>';
}
else{
echo '<script language="javascript">';
echo 'alert("Lời mời chưa được đồng ý hoặc các bạn đã là bạn bè");';
echo '</script>';
echo '<script language="javascript">';
echo 'window.location.href = "../home"';
echo '</script>';
}

?>