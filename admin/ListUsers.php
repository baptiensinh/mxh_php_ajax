<?php
session_start();
require_once "../includes/connectdb.php";
$showUser   = '';
$stt        = 1;
// if (isset($_SESSION["idAdmin"])) {
    $resultUser = $link->query("SELECT * from users");
    if (mysqli_num_rows($resultUser) > 0) {
        while ($row = mysqli_fetch_assoc($resultUser)) {
            if ($row['status_user'] == 1) 
            { }
            else {
                $showUser = $showUser . '<tr>
                        <td>' . $stt++ . '</td>
                        <td>' . $row["id"] . '</td>
                        <td>' . $row["username"] . '</td>
                        <td>' . $row["email"] . '</td>
                        <td>' . $row["status_user"] . '</td>
                        <td>' . $row["create_time"] . '</td>

                        <td>
                            <a href="BlockUser.php?id=' . $row["id"] . '" class="btn btn-outline-danger">
                                Block
                            </a>
                        </td>
                        </tr>';
            }
        }
    }
// } else {
//     header("Location: index.php");
// }
?>

<?php 
include('includes/header.php'); 
include('includes/navbar.php'); 
include('includes/scripts.php'); 
include('includes/footer.php');
?>

<div class="content-body" style="width: 86%; float: right; background-color: #242526;  margin-right:5px;">
    <!-- ? Page Heading -->
    <!-- <a href="ViewAddUser.php">               
        <button class="btn btn-primary">Add User</button>
    </a> -->
    <div class="content table-responsive table-full-width">
        <table class="table table-striped" style="color: white;">
            <thead>
                <th>STT</th>
                <th>User ID</th>
                <th>UserName</th>
                <th>Email</th>
                <th>Status User</th>
                <th>Created Time</th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                <?php
                    echo $showUser;
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
 
?>