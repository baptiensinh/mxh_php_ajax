<?php
    session_start();
    require_once "../includes/connectdb.php";
    
    
    
    if(isset($_SESSION["id"]) && isset($_GET['id'])){
        $id = $_GET['id'];
            // $sql_insert = "INSERT INTO relationships (user1,user2, friend_stt,user_invite) VALUES
            //     ('" . $_SESSION["id"] . "','" . $_GET["id"] . "','" . 0 . "','" .$_SESSION["id"]. "');";
            $sql_insert="UPDATE relationships set friend_stt=1 where user1='$id' && user2='".$_SESSION["id"]."'";
            
            $insert=mysqli_query($link, $sql_insert);
            if($insert){
                echo '<script language="javascript">';
                echo 'alert("Success");';
                echo '</script>';
                echo '<script language="javascript">';
                echo 'window.location.href = "../home"';
                echo '</script>';
            }
            else{
    
            echo '<script language="javascript">';
            echo 'alert("Lời mời chưa được đồng ý hoặc các bạn đã là bạn bè");';
            echo '</script>';
        }
    
    
    }
    else{
        echo '<script language="javascript">';
                echo 'window.location.href = "../login"';
                echo '</script>';
    }
    
?>