<?php
session_start();
require_once "../includes/connectdb.php";



if(isset($_SESSION["id"]) && isset($_GET['id'])){
    $id = $_GET['id'];
        $sql_insert = "UPDATE relationships set friend_stt=2
             WHERE (user1= " .$_SESSION['id'] ." and user2=".$_GET['id']. ") or (user2= " .$_SESSION['id'] ." and user1=".$_GET['id']. ") ;";
        print_r($sql_insert);
        $insert=mysqli_query($link, $sql_insert);
        if($insert){
            echo '<script language="javascript">';
            echo 'alert("has delete a friend ");';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../home/profile.php?id=' . $_SESSION["id"] . '"';
            echo '</script>';

        }
        else{

        echo '<script language="javascript">';
        echo 'alert("ERR");';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../home/profile.php?id=' . $_SESSION["id"] . '"';
        echo '</script>';
    }


}
else{
    echo '<script language="javascript">';
            echo 'window.location.href = "../login"';
            echo '</script>';
}

?>