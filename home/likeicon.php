<?php
session_start();
require_once "../includes/connectdb.php";


$id=$_GET['idd'];
$countl="";
$sql_insert = "SELECT * from icons
 WHERE  post_id=".$id. ";";
 $insert=mysqli_query($link, $sql_insert);
 if(mysqli_num_rows($insert) > 0){
    while($row=mysqli_fetch_assoc($insert)){
    if(($row["user_id"]==$_SESSION["id"]) && ($row["type_icon"]==1) ){

        $show='<button class="bttlike btn-primary btn btn-outline-secondary" id="'.$id.'" >Like</button>';
    }
    else{
        $show='<button class="bttlike btn btn-outline-secondary" id="'.$id.'" >Like</button>';
    }
    }
 }
echo $show;


?>