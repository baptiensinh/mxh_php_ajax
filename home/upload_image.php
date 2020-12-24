<?php
session_start();
require_once "../includes/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["username"])) {
        $id_username = $_SESSION["id"];
        $title_image = $_POST['title_image'];
        $images_description = $_POST['images_description'];
        // TODO: for image upload
        $file = $_FILES['image']['name'];
        $file_loc = $_FILES['image']['tmp_name'];
        $folder = "../images/";
        //TODO:  The strtolower() function converts a string to lowercase
        $new_file_name = strtolower($file);
        //TODO:  The str_replace() function replaces some characters with some other characters in a string
        $final_file = str_replace(' ', '-', $new_file_name);
        // ? rename to type md5
        $final_file = time() . '.jpg';
        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $image = $final_file;
        }
        // ! just for debug
        // echo $title_image;
        // echo $image;
        $sql = "INSERT INTO photos (id_user, status_photo , images_description, images_url) VALUES ('" . $id_username . "','0','" . $images_description . "','" . $image . "')";
        //$sql2 = "INSERT INTO users (username,email, pass) VALUES ('" . $username . "','" . $email . "','" . $password . "');";
        // ! just for debug
        // echo $sql;
        //TODO: thực thi query cách 1
        mysqli_query($link, $sql);
        //TODO: get id photos
        $sql2 = "SELECT * 
                FROM photos
                WHERE images_url = '" . $image . "'
        ";
        //TODO: thực thi query cách 2
        $result = $link->query($sql2);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($id_username == $row["id_user"]) {
                $_SESSION["id_image"] = $row["id"];
                $_SESSION["cap_image"] = $row["title"];
                // echo $_SESSION["id_image"];
                $url_images = '../home/newsfeed.php?id=' . $_SESSION["id_image"] . '';
                echo '<script language="javascript">';
                echo 'alert("Upload successfully")';
                echo '</script>';
                echo '<script language="javascript">';
                echo 'window.location.href = "' . $url_images . '"';
                echo '</script>';
            }
        }
    } else {
        $title_image = $_POST['title_image'];
        $images_description = $_POST['images_description'];
        // TODO: for image upload
        $file = $_FILES['image']['name'];
        $file_loc = $_FILES['image']['tmp_name'];
        $folder = "../images/";
        //TODO:  The strtolower() function converts a string to lowercase
        $new_file_name = strtolower($file);
        //TODO:  The str_replace() function replaces some characters with some other characters in a string
        $final_file = str_replace(' ', '-', $new_file_name);
        // ? rename to type md5
        //  ! $final_file = md5($final_file . $_SESSION["username"]) . '.jpg';
        // TODO: just check name
        $final_file = time() . '.jpg';
        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $image = $final_file;
        }
        $sql = "INSERT INTO photos_any (title, status_photo, images_url,images_description) VALUES ('" . $title_image . "','0','" . $image . "','" . $images_description . "')";
        //$sql2 = "INSERT INTO users (username,email, pass) VALUES ('" . $username . "','" . $email . "','" . $password . "');";
        // ! just for debug
        // echo $sql;
        //TODO: thực thi query cách 1
        mysqli_query($link, $sql);
        //TODO: get id photos
        $sql2 = "SELECT * 
                FROM photos_any
                WHERE images_url = '" . $image . "'
        ";
        //TODO: thực thi query cách 2
        $result = $link->query($sql2);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($image == $row["images_url"]) {
                $_SESSION["id_image"] = $row["id"];
                $_SESSION["cap_image"] = $row["title"];
                // echo $_SESSION["id_image"];
                $url_images = '../home/newsfeed.php?ids=' . $_SESSION["id_image"] . '';
                echo '<script language="javascript">';
                echo 'alert("Upload successfully")';
                echo '</script>';
                echo '<script language="javascript">';
                echo 'window.location.href = "' . $url_images . '"';
                echo '</script>';
            }
        }
    }
} else {
    echo "Nothing here";
}
mysqli_close($link);
