<?php
require_once "../includes/session.php";
require_once "../includes/connectdb.php";


$userpost="";
$post_id=$_GET["id"];
if (isset($_GET["id"])) {
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
        
            $show_avatar_sugg="";
            $username_sugg="";
            $show_content = '';
    $id_get = $_GET["id"];
    //src="images/Images/014.jpg"
    //TODO: code redrict
    //TODO: get id image
    $sql = 'SELECT *
                FROM photos
                WHERE id = ' . $id_get . '
        ';
    $result = $link->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row["status_photo"] == 2) {
        echo '<script language="javascript">';
        echo 'alert("Image was deleted");';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../home/profile.php?id=' . $row["user_id"] . '"';
        echo '</script>';
    }
    $url = ' src="../images/' . $row["images_url"] . '" ';
    $download_image = '../images/' . $row["images_url"] . '';
    $description = $row["description"];
    //TODO:get username
    $sql2 = 'SELECT * FROM users WHERE id = "' . $row["user_id"] . '"';
    $result2 = $link->query($sql2);
    $row2 = mysqli_fetch_assoc($result2);
    //TODO: show avatar
    $userpost = $row2["username"];
    if ($row2["avatar_url"] == null) {
        $show_avatar = '<a href="../home/profile.php?id=' . $row2["id"] . '">
                    <img class="box-icon float-left" src="images/user.jpg" alt="" sizes="" srcset="">
                    </a> ';
    } else {
        $show_avatar = '<a href="../home/profile.php?id=' . $row2["id"] . '">
                    <img class="box-icon float-left" src="../images/avatar/' . $row2["avatar_url"] . '" alt="" sizes="" srcset="">
                    </a>
                    ';
    }
    //TODO: just for recommend
} else {
    $ids_get = $_GET["ids"];
    $sql = 'SELECT *  FROM photos WHERE id = ' . $ids_get . '';
    $result = $link->query($sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['status_photo'] == 2) {
        echo '<script language="javascript">';
        echo 'alert("Image was deleted");';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location.href = "../home"';
        echo '</script>';
    }
    $url = '
            src="../images/' . $row["images_url"] . '"
            ';
    $download_image = '../images/' . $row["images_url"] . '';
    $show_avatar = '
                    <img class="box-icon float-left" src="images/user.png" alt="" sizes="" srcset="">
                    
                    ';
}

// else {
//     echo '<script language="javascript">';
//     echo 'alert("Nothing here.\nYou will be return home.\nThank you!")';
//     echo '</script>';
//     echo '<script language="javascript">';
//     echo 'window.location.href = "../home/"';
//     echo '</script>';
// }

//TODO: show images recommend
$show_content=";";
$show_content = $show_content .'
<div class="comment-css overflow-auto">';

  $sql_get_cmt = 'SELECT * FROM comments c JOIN users u ON c.user_id = u.id WHERE post_id = '.$post_id.'';
  $result_get_cmt = $link->query($sql_get_cmt);
      if (mysqli_num_rows($result_get_cmt) > 0){
          while ($row_cmt = mysqli_fetch_assoc($result_get_cmt))
          {
              $show_content = $show_content .' <div class="card-body">
              <div id="btnlike" >
              <button class="bttlike '.mylikes($post_id,$link).' btn btn-outline-secondary" id="'.$post_id.'" >Like</button>
              </div>
              <p id="likes">'.likess($post_id,$link).' likes</p>
              <hr>
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
          </div>
          <form action="comment.php?id='.$post_id.'" class="comment-form" method="POST">
              
              <div class="input-group mb-3">
                  <input type="text" class="form-control cmt" name="cmt" placeholder="Add a Comment ..." aria-label="Comment" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                      <button class="btn-success" type="submit">OK</button>
                  </div>
              </div>
          </form>
        ';


            //TODO: SELECT * FROM users WHERE id=(SELECT user_id FROM photos WHERE id= 1)
            $show_recommend="";
            $sql_get_photo = 'SELECT p.images_url AS img_url, p.id AS photo_id FROM photos p JOIN posts_photos pp ON p.id=pp.photo_id WHERE pp.post_id = '.$post_id.' AND status_photo = 1';
            $result_get_photo   = $link->query($sql_get_photo);
            if( mysqli_num_rows($result_get_photo) > 0) {
                while ($row_img = mysqli_fetch_assoc($result_get_photo)) {
            $show_recommend = $show_recommend . '  
                <div class="row ds-box">
                    <div class="col-md-5 col-sm-12 dropdown">
                        <a href="../home/newsfeed.php?id=' . $post_id . '">
                            <img class="ds-thum" src="../images/' . $row_img["img_url"] . '" alt="" srcset="">
                        <div class="dropdown-content">
                            <img class="ds-thum-ho" src="../images/' . $row_img["img_url"] . '" alt="Cinque Terre">
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        </a>
                    </div>
                </div>   
                <div class="d-flex p-2"></div> 
                ';
                }
            }
        



// $sql_recommend = 'SELECT * FROM photos';

$link->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BLUESKY - <?php
                        //TODO: caption here
                        echo $userpost;
                        ?></title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/owl/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="css/hover.css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="grid-gallery.css">
</head>

<body>

<nav class="nava navbar navbar-expand-lg fixed-top fix-z-1">

<a class="navbar-brand ds-hover nav-link" href="../home/">
    <img src="images/7.png" width="120" height="auto" alt="logo">
</a>
<!--TODO:SEARCH-->
<form action="search.php" class="searchcss" method="POST">
    <div class="input-group mb-3 ">
         <div class="input-group-prepend">
             <button class="input-group-text" id="search">Search</button>
         </div>
         
      <input class="form-control" type="search" name="search" id="search" placeholder="...">
 </div>

    
</div>
</form>
<!--TODO:END SEARCH-->
<!--TODO: upload image-->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="nav navbar-nav ml-auto">
        <!-- TODO: PHP USER -->
        <?php echo $log_reg; ?>
    </ul>
</div>
</nav>
    <div class="pt-5"></div>
    <!--TODO:This post-->
        <div class="container ">
            <div class="row">
                <div class="col-md-8 col-sm-12 mx-auto">
                    <div class="card transform-on-hover w-100">
                        <div class="card-header bg-transparent">
                            <?php
                            echo $show_avatar;
                            ?>
                            <a class="d-inline-flex p-2 ds-username-title" href="#">
                                <!-- //TODO: user here -->
                                <?php
                                if (isset($row2["username"])) {
                                    $showuser = '<a style="font-size: 25px" href="../home/profile.php?id=' . $row2["id"] . '">' . $row2["username"] . '</a>';
                                    echo $showuser;
                                } else {
                                    echo "Anonymous";
                                }
                                ?>
                            </a>
                            <img class="d-inline-flex float-right p-2" src="images/more.png" alt="" srcset="" data-toggle="modal" data-target="#viewMore">
                        </div>
                        <div class="card-body bg-transparent">
                            <img class="card-img-top img-fluid" <?php
                                                                // TODO: IMAGE CENTER HERE
                                                                echo $url;
                                                                ?> alt="Card image cap">
                        </div>
                    </div>             
                </div>
                <div class="col-md-4 col-sm-12">
                    <!--TODO: reconned-->

                    <div class="d-flex p-2"></div>
                            <div class="col=md-4">
                                <div class="row">
                                            <!-- <img class="box-icon-profile float-left img-re" src="images/user.jpg" alt="" sizes="" srcset=""> -->
                                            <?php
                                                echo $show_avatar;
                                            ?>
                                        <div class="name-re-nf"><?php echo $userpost;?></div>
                                </div>
                                <hr>
                                <div class="row pt-70">
                                            <!-- <img class="box-icon-profile float-left img-re" src="images/user.jpg" alt="" sizes="" srcset=""> -->
                                           
                                </div>
                                <hr>
                                <div class="row">
                                            <!-- <img class="box-icon-profile float-left img-re" src="images/user.jpg" alt="" sizes="" srcset=""> -->
                                            <?php
                                                echo $show_content;
                                            ?>
                                </div>
                            </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
                    echo $show_recommend;
            ?>
        </div>
    </div>
    <!--TODO: This view more-->
    <!-- Modal -->
    <div class="modal fade" id="viewMore" tabindex="-1" role="dialog" aria-labelledby="viewMoreCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="RnEpo Yx5HN     " role="presentation">
            <div class="pbNvD  fPMEg    " role="dialog">
                <div class="_1XyCr"><div class="piCib">
                    <div class="mt3GC">
                        <button class="" tabindex="0">Report</button>
                        <button class="" tabindex="0">Unfollow</button>
                        <button class="" tabindex="0">Share to...</button>
                        <button class="" tabindex="0">Copy Link</button>
                        <button class="" tabindex="0">Embed</button>
                        <button class="" tabindex="0">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    <!--TODO: This share-->



    </div>

    <script src="js/popper.min.js"></script>
    <script src="js/owl/owl.carousel.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/owl/owl.js"></script>
    <div  style="text-align:center " class="fixed-bottom">
         <ul class=" list-inline">
                    <li class="list-inline-item"><a class="" href="">Help</a></li>
                    <li class="list-inline-item"><a class=" " href="" rel="nofollow noopener noreferrer" target="_blank">About</a></li>
                    <li class="list-inline-item"><a class="" href="">Press</a></li>
                    <li class="list-inline-item"><a class="" href="">API</a></li>
                    <li class="list-inline-item"><a class="" href="">Jobs</a></li>
                    <li class="list-inline-item"><a class="" href="">Privacy</a></li>
                    <li class="list-inline-item"><a class="" href="">Terms</a></li>
                    <li class="list-inline-item"><a class="" href="">Locations</a></li>
                    <li class="list-inline-item"><a class="" href="">Top Accounts</a></li>
                    <li class="list-inline-item"><a class="" href="">Hashtags</a></li>
                    <li class="list-inline-item"><span class="">Language<select aria-label="Switch Display Language" class="hztqj">
                        <option value="af">Afrikaans</option>
                        <option value="cs">Čeština</option>
                        <option value="da">Dansk</option>
                        <option value="de">Deutsch</option>
                        <option value="el">Ελληνικά</option>
                        <option selected="selected" value="en">English</option>
                        <option value="en-gb">English (UK)</option>
                        <option value="es">Español (España)</option>
                        <option value="es-la">Español</option>
                        <option value="fi">Suomi</option>
                        <option value="fr">Français</option>
                        <option value="id">Bahasa Indonesia</option>
                        <option value="it">Italiano</option>
                        <option value="ja">日本語</option>
                        <option value="ko">한국어</option>
                        <option value="ms">Bahasa Melayu</option>
                        <option value="nb">Norsk</option>
                        <option value="nl">Nederlands</option>
                        <option value="pl">Polski</option>
                        <option value="pt-br">Português (Brasil)</option>
                        <option value="pt">Português (Portugal)</option>
                        <option value="ru">Русский</option>
                        <option value="sv">Svenska</option>
                        <option value="th">ภาษาไทย</option>
                        <option value="tl">Filipino</option>
                        <option value="tr">Türkçe</option>
                        <option value="zh-cn">中文(简体)</option>
                        <option value="zh-tw">中文(台灣)</option>
                        <option value="bn">বাংলা</option>
                        <option value="gu">ગુજરાતી</option>
                        <option value="hi">हिन्दी</option>
                        <option value="hr">Hrvatski</option>
                        <option value="hu">Magyar</option>
                        <option value="kn">ಕನ್ನಡ</option>
                        <option value="ml">മലയാളം</option><option value="mr">मराठी</option><option value="ne">नेपाली</option>
                        <option value="pa">ਪੰਜਾਬੀ</option><option value="si">සිංහල</option><option value="sk">Slovenčina</option>
                        <option value="ta">தமிழ்</option><option value="te">తెలుగు</option><option value="vi">Tiếng Việt</option>
                        <option value="zh-hk">中文(香港)</option><option value="bg">Български</option><option value="fr-ca">Français (Canada)</option>
                        <option value="ro">Română</option><option value="sr">Српски</option><option value="uk">Українська</option>
                    </select>
                        </span>
                    </li>
                </ul>
            <div >
            © 2020 BULE SKY FROM EARTH :))
            </div>
        </div>
</body>

</html>

