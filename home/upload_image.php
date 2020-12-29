<?php
session_start();
require_once "../includes/connectdb.php";

// print_r($_POST);
extract($_POST);
$error=array();
$f="../images/";
$extension=array("jpeg","jpg","png","gif");
//print_r($_FILES["images"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["username"])) {
        $id_username = $_SESSION["id"];
        //$images_description = $_POST['images_description'];
        // TODO: for image upload
        //echo $_FILES["images"]["tmp_name"];
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
                        
                        $sql = "INSERT INTO photos (user_id, status_photo, images_url) VALUES ('" . $id_username . "','0','" . $final_file . "')";
                        mysqli_query($link, $sql);
                        echo '<script language="javascript">';
                        echo 'alert("Upload successfully")';
                        echo '</script>';
                        echo '<script language="javascript">';
                        echo 'window.location.href = "profile.php"';
                        echo '</script>';
                    }
            else {
                    array_push($error,"$file_name, ");
                }
            // }
        }
    
        // ! just for debug
        // echo $title_image;
        // echo $image;
  
        //$sql2 = "INSERT INTO users (username,email, pass) VALUES ('" . $username . "','" . $email . "','" . $password . "');";
        // ! just for debug
        // echo $sql;
        //TODO: thực thi query cách 1
        // }
        //mysqli_query($link, $sql);
        //TODO: get id photos
    //     $sql2 = "SELECT * 
    //             FROM posts
    //             WHERE images_url = '" . $image . "'
    //     ";
        
    //     $result = $link->query($sql2);
    //     if (mysqli_num_rows($result) > 0) {
    //         $row = mysqli_fetch_assoc($result);
    //         if ($id_username == $row["user_id"]) {
    //             $_SESSION["id_image"] = $row["id"];
    //             // echo $_SESSION["id_image"];
    //             $url_images = '../home/newsfeed.php?id=' . $_SESSION["id_image"] . '';
    //             echo '<script language="javascript">';
    //             echo 'alert("Upload successfully")';
    //             echo '</script>';
    //             echo '<script language="javascript">';
    //             // echo 'window.location.href = "' . $url_images . '"';
    //             echo '</script>';
    //         }
    //     }
     
    // }   
    // else {

    //             // echo $_SESSION["id_image"];
    //             $url_images = '../home/newsfeed.php?ids=' . $_SESSION["id_image"] . '';
    //             echo '<script language="javascript">';
    //             echo 'alert("Upload successfully")';
    //             echo '</script>';
    //             echo '<script language="javascript">';
    //             echo 'window.location.href = "../login"';
    //             echo '</script>';
    //         }
        
    }
 }
 else {
    echo "Nothing here";
}
mysqli_close($link);
