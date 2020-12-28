<?php
session_start();
require_once "../includes/connectdb.php";
$showPost  = '';
$stt        = 1;
// if (isset($_SESSION["idAdmin"])) {
    $resultPost = $link->query("SELECT p.id as post_id, u.username as username, p.description as pdescription, 
                                       p.post_time as ptime, p.status_post as stt_post, p.images_url as img_url
                                from posts p join users u on p.user_id = u.id 
                                order by post_id DESC");
    if (mysqli_num_rows($resultPost) > 0) {
        while ($rowPost = mysqli_fetch_assoc($resultPost)) {
            // if ($rowPost['status_post'] == 0 || $rowPost['status_post'] == 2) 
            // { } 
            // else 
            // {
                $showPost = $showPost . ' <tr>
                <td>' . $stt++ . '</td>
                <td>' . $rowPost['post_id'] . '</td>
                <td>' . $rowPost['username'] . '</td>
                <td>' . $rowPost['pdescription'] . '</td>
                <td>' . $rowPost['ptime'] . '</td>
                <td>' . $rowPost['stt_post'] . '</td>';

                // <td>
                //     <a href="../home/newsfeed.php?ids=' . $rowPost['post_id'] . '" target="_blank">
                //         <img src="../images/' . $rowPost['img_url'] . '"" style=" width:150px;height:100px; object-fit: cover; ">
                //     </a>
                // </td>';

            //     if ($rowPost['status_post'] == 1) {
            //         $showPost = $showPost . '<td><img src="../home/Posts/check-mark.png" alt="" srcset=""></td>';
            //     } else if ($rowPost['status_photo'] == 0) {
            //         $showPost = $showPost . '<td><img src="../home/Posts/delete.png" alt="" srcset=""></td>';
            //     }
                $showPost = $showPost . '  
                    <td>
                       <a href="DeletePost.php?id=' . $rowPost['post_id'] . '" class="btn btn-danger">Delete</a>
                    </td>
                    <td>
                       <a href="DetailPost.php?id=' . $rowPost['post_id'] . '" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
                ';
            // }
        }
    }
// } else {
//     header("location:index.php");
// }
?>

<?php 
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="content-body" style="width: 86%; float: right; background-color: #242526; margin-right:5px;">
    <div class="content table-responsive table-full-width">
        <table class="table table-striped" style="color: white;">
            <thead>
                <th>STT</th>
                <th>Post ID</th>
                <th>Username</th>
                <th>Description</th>
                <th>Post Time</th>
                <th>Status Post</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php
                //TODO: show Post
                echo $showPost;
                ?>
            </tbody>

        </table>

    </div>

</div>
<!-- /.container-fluid -->


<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>