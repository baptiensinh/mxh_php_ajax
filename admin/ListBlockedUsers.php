<?php
session_start();
require_once "../includes/connectdb.php";
$showBlockedUser    = '';
$stt                = 1;
// if (isset($_SESSION["idAdmin"])) {
    $resultBlockedUser = $link->query("SELECT * from users where status_user = 1");
    if (mysqli_num_rows($resultBlockedUser) > 0) {
        while ($rowBlockedUser = mysqli_fetch_assoc($resultBlockedUser)) {
            $showBlockedUser = $showBlockedUser . '<tr>
                <td>' . $stt++ . '</td>
                <td>' . $rowBlockedUser["id"] . '</td>
                <td>' . $rowBlockedUser["email"] . '</td>
                <td>' . $rowBlockedUser["updated_time"] . '</td>
                <td>
                    <a href="UnblockUser.php?id=' . $rowBlockedUser["id"] . '" class="btn btn-outline-primary">
                        Unblock
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

<div class="content-body" style="width: 86%; float: right; background-color: #242526; margin-right:5px;">
    <table class="table table-striped" style="color: white;">
        <thead>
            <th>STT</th>
            <th>User ID</th>
            <th>Email</th>
            <th>Updated Time</th>
            <th></th>
        </thead>
        <tbody>
            <?php
            // Show list deleted users
            echo $showBlockedUser;
            ?>
        </tbody>
    </table>
</div>


<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>