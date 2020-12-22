<?php
session_start();
require_once "../includes/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["username"])) {
        $id_username = $_SESSION["id"];
        // TODO: for image upload
        $file = $_FILES['image']['name'];
        $file_loc = $_FILES['image']['tmp_name'];
        $folder = "../images/avatar/";
        //TODO:  The strtolower() function converts a string to lowercase
        $new_file_name = strtolower($file);
        //TODO:  The str_replace() function replaces some characters with some other characters in a string
        $final_file = str_replace(' ', '-', $new_file_name);
        // ? rename to type md5
        $final_file = time() . '.jpg';
        if (move_uploaded_file($file_loc, $folder . $final_file)) {
            $image = $final_file;
        }
        $sql = 'UPDATE users SET avatar_url = "' . $image . '" WHERE id = ' . $id_username . '';
        if ($link->query($sql) === TRUE) {
            echo '<script language="javascript">';
            echo 'alert("Change avatar success");';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../home/profile.php?id=' . $id_username . '"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Change avatar unsuccess");';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../home/profile.php?id=' . $id_username . '"';
            echo '</script>';
        }
    }
} else {
    echo "Nothing here";
}
mysqli_close($link);
