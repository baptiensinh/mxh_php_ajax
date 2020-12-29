<?php
session_start();
    require_once "../includes/connectdb.php";
$id = $_GET['id'];
$showphotoid = "";
$countpost=0;
                   
$sql_showphotoid = 'SELECT * FROM photos
                        WHERE user_id = "' . $id . '" 
                    ORDER BY id DESC';
$result_showphotoid = $link->query($sql_showphotoid);

if(!empty($result_showphotoid)){
    if (mysqli_num_rows($result_showphotoid) > 0) {
        while ($row_showphotoid = mysqli_fetch_assoc($result_showphotoid)) {
            // isset:exist
            if (isset($_SESSION['id']) && $_SESSION['id'] ==  $id) {
                if ($row_showphotoid["status_photo"] == 1) {$countpost++;};
                if ($row_showphotoid["status_photo"] == 0 || $row_showphotoid["status_photo"] == 1) {
                    $showphotoid = $showphotoid . '
                <div class="col-md-12 col-lg-4 col-md-3 pt-4 item">
                    <div class="card ds-card">
                        <a class="lightbox" href="../home/newsfeed.php?id=' . $row_showphotoid["id"] . '">
                            <img class="img-fluid image scale-on-hover box-profile" src="../images/' . $row_showphotoid["images_url"] . '">
                        </a>
                        <div class="card-body">           
                            <div class="text-center">
                                <button class="btndelete btn" id="'.$row_showphotoid["id"].'">DELETE</button>                           
                                <button class="btnpost btn" id="'.$row_showphotoid["id"].'">POST</button>
                            </div>    
                        </div>
                    </div>
                </div>
            ';
                }
            } else {
                if ($row_showphotoid["status_photo"] == 1) {
                    $countpost++;
                    $showphotoid = $showphotoid . '
                <div class="col-md-12 col-lg-4 col-md-3 pt-4 item">
                    <div class="card ds-card">
                        <a class="lightbox" href="../home/newsfeed.php?id=' . $row_showphotoid["id"] . '">
                            <img class="img-fluid image scale-on-hover box-profile" src="../images/' . $row_showphotoid["images_url"] . '">
                        </a>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            ';
                }
            }
        }
    }
}
    echo $showphotoid;

?>