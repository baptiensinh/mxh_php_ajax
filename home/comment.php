<?php
    session_start();
    require_once "../includes/connectdb.php";
    // print_r($_SERVER["REQUEST_METHOD"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_SESSION["id"])){
        $post_id = $_GET['id'];
        $content_cmt = $_POST["cmt"];
        
        if (isset($_POST["cmt"]) && $_POST["cmt"]!=''){
        
            $sql_insert = 'INSERT INTO comments (post_id, user_id, content_cmt) VALUES ("'.$post_id.'","'.$_SESSION["id"].'","'.$content_cmt.'")';
            $insert = mysqli_query($link, $sql_insert);

            header("Location: index.php");
        }
        else{
            header("Location: index.php");

            echo '<script language="javascript">';
            echo 'alert("Vui lòng nhập bình luận!");';
            echo '</script>';
        }
    }
    else {
        header("Location: /login");
    }
}
else {
    header("Location: index.php");
}
?>