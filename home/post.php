<?php
session_start();
require_once "../includes/connectdb.php";


$id=$_GET["id"];
function likess($l,$link){
    $countl=0;
    $sql_insert = "SELECT * from icons
     WHERE  post_id=".$l. ";";
     $insert=mysqli_query($link, $sql_insert);
     if(mysqli_num_rows($insert) > 0){
        while($row=mysqli_fetch_assoc($insert)){
            if($row["type_icon"]==1){
           $countl++;
        }
        }
     }
    
     return $countl;
    }
    function mylikes($l,$link){
        $countl="";
        $sql_insert = "SELECT * from icons
         WHERE  post_id=".$l. ";";
         $insert=mysqli_query($link, $sql_insert);
         if(mysqli_num_rows($insert) > 0){
            while($row=mysqli_fetch_assoc($insert)){
            if(($row["user_id"]==$_SESSION["id"]) && ($row["type_icon"]==1) ){
                $countl="btn-primary";
            }
            }
         }
         return $countl;
        }
$show_content="";
$sql_show_recommend = 'SELECT * FROM posts WHERE user_id='.$id.' ORDER BY id DESC';
$result_recommend = $link->query($sql_show_recommend);
if(!empty($result_recommend)){
    if  (mysqli_num_rows($result_recommend) > 0) {
        while ($row_r = mysqli_fetch_assoc($result_recommend)) {
            $sql_get_info       = 'SELECT * FROM users WHERE id = ' . $row_r["user_id"] . '';;
            $result_get_info    = $link->query($sql_get_info);
            $row_get_info       = mysqli_fetch_assoc($result_get_info);

            if ($row_r["status_post"] == 0 ) {
                $sql_get_photo      = 'SELECT p.images_url AS img_url, p.id AS photo_id FROM photos p JOIN posts_photos pp ON p.id=pp.photo_id WHERE pp.post_id = '.$row_r["id"].' AND status_photo = 1';
                $result_get_photo   = $link->query($sql_get_photo);

                $show_content = $show_content . ' 
                <div class="col-md-12 col-lg-12 pt-4 item">
                    <div class="card ds-card">
                        <div class="card-body" >
                            <a href="../home/profile.php?id=' . $row_r["user_id"] . '">
                            <img class="box-icon-profile float-left img-re" src="../images/avatar/' . $row_get_info["avatar_url"] . '" alt="" sizes="" srcset="">
                            </a>
                            <div class="name-re-content">
                                <a  href="profile.php?id=' . $row_get_info["id"] . '">' . $row_get_info["username"] . '</a>
                            </div>
                        </div>';
                        
                        if  ( mysqli_num_rows($result_get_photo) > 0) {
                            while ($row_img = mysqli_fetch_assoc($result_get_photo)) {
                                
                                $show_content = $show_content .'
                                <a class="lightbox" href="newsfeed.php?id=' . $row_img["photo_id"] . '" align="center">
                                <img class="img-fluid image scale-on-hover box-profile" style="width:500px; height:350px" src="../images/'.$row_img["img_url"].'">
                                </a>';
                                }
                            }
                        $show_content = $show_content .'
                        
                        <div class="card-body">
                            <div id="btnlike" >
                            <button class="bttlike '.mylikes($row_r["id"],$link).' btn btn-outline-secondary" id="'.$row_r["id"].'" >Like</button>
                            </div>
                            <p id="likes">'.likess($row_r["id"],$link).' likes</p>
                            <hr>
                            <div class="comment-css">';

                        $sql_get_cmt = 'SELECT * FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = '.$row_r["id"].'';
                        $result_get_cmt = $link->query($sql_get_cmt);
                            if (mysqli_num_rows($result_get_cmt) > 0){
                                while ($row_cmt = mysqli_fetch_assoc($result_get_cmt))
                                {
                                    $show_content = $show_content .'
                                    <div class="card-body" >
                                    <a href="../home/profile.php?id=' . $row_cmt["user_id"] . '">
                                    <img class="box-icon-profile float-left img-re" style="width: 40px; height: 40px;" src="../images/avatar/' . $row_cmt["avatar_url"] . '" alt="" sizes="" srcset="">
                                    </a>
                                    <div class="name-re-content" style="margin-left: 15px">
                                        <a  href="profile.php?id=' . $row_cmt["user_id"] . '">' . $row_cmt["username"] . '</a>
                                    </div>
                                    </div>
                                    <div style="margin-left: 60px">
                                        <p>'.$row_cmt["content_cmt"].'</p> 
                                    </div>';
                                }
                            }

                            $show_content = $show_content .'
                                <hr>
                                <form action="comment.php?id='.$row_r["id"].'" class="comment-form" method="POST">
                                    
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control cmt" name="cmt" placeholder="Add a Comment ..." aria-label="Comment" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button type="submit">OK</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>          
            ';
        }
    }
    }
}
echo $show_content;


?>