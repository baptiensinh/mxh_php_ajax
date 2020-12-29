<?php
session_start();
require_once "../includes/connectdb.php";


$id=$_GET["id"];

$sql_insert = "SELECT * from posts
WHERE  id=' $id ';";
$insert=mysqli_query($link, $sql_insert);
if(mysqli_num_rows($insert) > 0){
        $row=mysqli_fetch_assoc($insert);
       if($row["user_id"]==$_SESSION["id"]){
        $sql_insert="DELETE FROM posts WHERE id='$id';";
        $insert=mysqli_query($link, $sql_insert);
        if($insert){
            echo '<script language="javascript">';
            echo 'alert("successfully")';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../home"';
            echo '</script>';
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("ERR")';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = ""';
            echo '</script>';
        }
   }
}


?>