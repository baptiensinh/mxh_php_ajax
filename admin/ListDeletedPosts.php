<?php
session_start();
require_once "../includes/connectdb.php";
$showPost    = '';
$stt                = 1;
// if (isset($_SESSION["idAdmin"])) {
    $resultPost = $link->query("SELECT p.id as id, u.username as username, p.description as pdescription, p.create_time as ptime 
                                from posts p join users u on p.user_id = u.id 
                                where status_post = 0");
    if (mysqli_num_rows($resultPost) > 0) {
        while ($rowPost = mysqli_fetch_assoc($resultPost)) {
            $showPost = $showPost . '<tr>
                <td>' . $stt++ . '</td>
                <td>' . $rowPost["id"] . '</td>
                <td>' . $rowPost["username"] . '</td>
                <td>' . $rowPost["pdescription"] . '</td>
                <td>' . $rowPost["ptime"] . '</td>
                <td>
                    <a href="PermanentDelete.php?id=' . $rowPost["id"] . '" class="btn btn-outline-danger">
                    Permanently Delete
                    </a>
                </td>
            </tr>';
        }
    }
// } else {
//     header("Location: index.php");
// }
?>

<?php 
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="" style="width: 86%; float: right; background-color: #242526; margin-right:5px;">
    <table class="table table-striped" style=" color: white;">
        <thead>
            <th>STT</th>
            <th>Post ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Create Time</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            // Show list deleted users
            echo $showPost;
            ?>
        </tbody>
    </table>
</div>


<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>