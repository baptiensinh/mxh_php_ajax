<?php
session_start();
require_once "../includes/connectdb.php";


$count=0;
$show="";
$sql_insert = "SELECT * from icons
 WHERE  post_id=".$_GET['idd']. ";";
 $insert=mysqli_query($link, $sql_insert);
 if(mysqli_num_rows($insert) > 0){

    while($row=mysqli_fetch_assoc($insert)){
        if($row["type_icon"]==1){
        $count++;}
    }
 }
$sql_insert = "SELECT * from icons
 WHERE user_id= " .$_SESSION['id'] ." and post_id=".$_GET['idd']. ";";
$insert=mysqli_query($link, $sql_insert);

if(mysqli_num_rows($insert) > 0){

    $row=mysqli_fetch_assoc($insert);
    if($row["type_icon"]==1){
    $sql_insert = "UPDATE icons set type_icon = 0
             WHERE user_id= " .$_SESSION['id'] ." and post_id=".$_GET['idd']. ";";
    if($insert){
        $count=$count-1;
        $show=$show.''.$count.'likes';
    }

    $insert=mysqli_query($link, $sql_insert);
    }
    else{
        $sql_insert = "UPDATE icons set type_icon=1
             WHERE user_id= " .$_SESSION['id'] ." and post_id=".$_GET['idd']. ";";
        $insert=mysqli_query($link, $sql_insert);
        if($insert){
            $count++;
            $show=$show.''.$count.'likes';
        }
        else{
            // echo '<script language="javascript">';
            // echo 'alert("err1");';
            // echo '</script>';
            // echo '<script language="javascript">';
            // // echo 'window.location.href = "../home"';
            // echo '</script>';
            $show=$show.''.$count.'likes';
            }
    }
    // if($insert){
    //     $count++;
    //     $show=$show.''.$count.'likes';
    // }
    // else{
    // // echo '<script language="javascript">';
    // // echo 'alert("err1");';
    // // echo '</script>';
    // // echo '<script language="javascript">';
    // // // echo 'window.location.href = "../home"';
    // // echo '</script>';
    // }
}else{

if(isset($_SESSION["id"]) && isset($_GET['idd'])){
    $id = $_GET['idd'];
        $sql_insert = "INSERT INTO icons (user_id,post_id, type_icon) VALUES
            ('" . $_SESSION["id"] . "','" . $_GET["idd"] . "','" . 1 . "');";

        $insert=mysqli_query($link, $sql_insert);
        if($insert){
            $count++;
            $show=$show.''.$count.'likes';
        }
        else{
        // echo '<script language="javascript">';
        // echo 'alert("err2);';
        // echo '</script>';
        // echo '<script language="javascript">';
        //  echo 'window.location.href = "../home"';
        // echo '</script>';
        // $count++;
        $show=$show.''.$count.'likes';
        }
    }
    else{
        echo $_SESSION['id'];
        echo '<script language="javascript">';
                 echo 'window.location.href = "../login"';
                echo '</script>';
    }
}
echo $show;

?>