<?php
require_once "../includes/connectdb.php";
session_start();
//TODO: get id image need delete
$id = $_GET["id"];
$delete = 2;
//TODO: show user name
$sql_showusername = 'SELECT * FROM users WHERE id=(SELECT id_user FROM photos WHERE id=' . $id . ')';
$result_showusername = $link->query($sql_showusername);
$showusername = '';
$show="";
$row_showusername = mysqli_fetch_assoc($result_showusername);
if (mysqli_num_rows($result_showusername) > 0) {
    if (isset($_SESSION['id']) && $_SESSION['id'] ==  $row_showusername["id"]) {
        //TODO: delete image here
        //DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste';
        $sql = 'UPDATE photos SET status_photo=' . $delete . ' WHERE id=' . $id . '';
        if ($link->query($sql) === TRUE) {
            $show=$show. '<script language="javascript">
             alert("Delete success");
             </script>';

        } else {
            $show=$show. '<script language="javascript">
            alert("Err");
            </script>';

        }
    } else {
        //TODO: sure -> out
        $show=$show. '<script language="javascript">
        alert("Website not available");
        </script>
        <script language="javascript">
        window.location.href = "../home/";
       </script>';
    }
} else {
    $show=$show. '<script language="javascript">
    alert("Website not available");
    </script>
    <script language="javascript">
    window.location.href = "../home/";
   </script>';
}
echo $show;
