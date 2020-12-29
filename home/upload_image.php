<?php
session_start();
require_once "../includes/connectdb.php";

// print_r($_POST);
extract($_POST);
$error = array();
$f = "../images/";
$extension = array("jpeg","jpg","png","gif");
//print_r($_FILES["images"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["username"])) {
        $id_username = $_SESSION["id"];
        //$images_description = $_POST['images_description'];
        // TODO: for image upload
        //echo $_FILES["images"]["tmp_name"];
        $sql_ipost = 'INSERT INTO posts(user_id, description) VALUES ("'.$id_username.'","")';
        $result_ipost = $link->query($sql_ipost);

        foreach($_FILES["images"]["tmp_name"] as $key=>$tmp_name) {
            $file_name = $_FILES['images']['name'][$key];
            $file_tmp = $_FILES['images']['tmp_name'][$key];

            //TODO:  The strtolower() function converts a string to lowercase
            $new_file_name = strtolower($file_name);
            // echo $new_file_name;
            //TODO:  The str_replace() function replaces some characters with some other characters in a string
            $final_file = str_replace(' ', '-',$new_file_name);

            $final_file = time().rand(1000,9999).".jpg";


            // $ext=pathinfo($file_name,PATHINFO_EXTENSION);
            
            // if(in_array($ext,$extension)) {
                
            if (move_uploaded_file($file_tmp, $f . $final_file)) {
                        //$image = $final_file;
                        $sql_get_pid = 'SELECT id FROM posts ORDER BY id DESC LIMIT 1';
                        $result_get_pid = $link->query($sql_get_pid);
                        $row_get_pid = mysqli_fetch_assoc($result_get_pid);

                        $sql_iphoto = 'INSERT INTO photos (user_id, status_photo, images_url) VALUES ("'. $id_username . '", "1", "' . $final_file . '")';
                        mysqli_query($link, $sql_iphoto);

                        $sql_get_iphoto = 'SELECT id FROM photos ORDER BY id DESC LIMIT 1';
                        $result_get_iphoto = $link->query($sql_get_iphoto);
                        $row_get_iphoto = mysqli_fetch_assoc($result_get_iphoto);

                        $sql_ipp = 'INSERT INTO posts_photos (photo_id, post_id, stt_group) VALUES ("'. $row_get_iphoto["id"] . '","' . $row_get_pid["id"] . '", "1")';
                        mysqli_query($link, $sql_ipp);

                        echo '<script language="javascript">';
                        echo 'alert("Upload successfully")';
                        echo '</script>';
                        echo '<script language="javascript">';
                        echo 'window.location.href = "profile.php?id='.$id_username.'"';
                        echo '</script>';
                    }
            else {
                    array_push($error,"$file_name, ");
                }
            // }
        }
        
    }
 }
 else {
    echo "Nothing here";
}
mysqli_close($link);