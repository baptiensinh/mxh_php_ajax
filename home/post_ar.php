<?php
session_start();
require_once "../includes/connectdb.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["username"])) {
        $des = $_POST['des'];
        $id_username = $_SESSION["id"];
        //$images_description = $_POST['images_description'];
        // TODO: for image upload
        //echo $_FILES["images"]["tmp_name"];
        $sql_ipost = 'INSERT INTO posts(user_id, description) VALUES ("'.$id_username.'","'.$des.'")';
        $result_ipost = $link->query($sql_ipost);
        if($result_ipost){
            echo '<script language="javascript">';
            echo 'alert("successfully")';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "/phpmxh/home/"';
            echo '</script>';
        }
        
        }
    }
 else {
    echo "Nothing here";
}
mysqli_close($link);