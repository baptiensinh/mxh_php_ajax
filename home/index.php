    <?php
    require_once "../includes/session.php";
    require_once "../includes/connectdb.php";



    $show_avatar_sugg="";
    $username_sugg="";
    $show_content = '';
    $sql_lastid = 'SELECT id FROM posts  ORDER BY id DESC LIMIT 1'; //lay so luong hinh anh
    $result_lastid = $link->query($sql_lastid);
    $row_lastid = mysqli_fetch_assoc($result_lastid);
    $start_id = 1;
    $end_id = $row_lastid["id"];
    $sql_show_recommend = 'SELECT * FROM posts 
                    WHERE id between ' . $start_id . ' and ' . $end_id . ' ORDER BY id DESC'; 
    $result_recommend = $link->query($sql_show_recommend);
     // echo '<div>link: '. $result_recommend .'</div>';
    //print_r(mysqli_fetch_assoc($result_recommend));
    // get avt
    $sqlav = 'SELECT *
    FROM users
    WHERE username = "' . $username2 . '";';
    //print_r( $row_lastid);
    $resultav = $link->query($sqlav);
    //echo '<div>link: '. $link->query($sqlav) .'</div>';
    $rowav = mysqli_fetch_assoc($resultav);
    // $friends=get_friends($rowav["id"],$link);
    // $invites=get_invites($rowav["id"],$link);

    //$ivs=get_inv_sent($rowav["id"],$link);

    //print_r($not_fr);
    //TODO: show avatar
    // echo '<div>link: '. $username2 .'</div>';
    if ($rowav["avatar_url"] == null && $username2==null) {
    $show_avatar = '<a href="../login">
        <img class="box-icon-profile float-left img-re" src="images/user.png" alt="" sizes="" srcset="">
        </a>
        ';
    } else {

            $not_fr=not_friends($rowav["id"],$link);
            // Suggestions user
                // kiem tra ban be hay chưa
                $not_friends=not_friends($rowav["id"],$link);
                foreach($not_friends as $value)
                {   
                    $sql_fr1="SELECT * FROM users 
                    WHERE id=$value;"; 
                }
              //lay so luong user
                // $sql_fr = 'SELECT COUNT(id)
                // FROM users
                // WHERE id != '.$_SESSION["id"] .';'; 
                // $result_fr = $link->query($sql_fr);
                // // print_r($result_lastid);
                // $row_fr = mysqli_fetch_assoc($result_fr);

                $rand2=array(0);
                for ($i=1;$i<8;$i++){
                    // $rand=rand(1,count($not_friends));
                    $t=array_rand($not_friends,1);
                    // echo "abc";
                    // print_r($rand2);
                    if ($t!=$_SESSION["id"]&& !in_array($t, $rand2)){
                        // echo "if";
                        
                        
                        $sql_fr = 'SELECT *
                            FROM users
                            WHERE id = '. $not_friends[$t] .';';
                        $result_fr = $link->query($sql_fr);
                        if ($result_fr && $result_fr->num_rows > 0){
                            $suggestions=mysqli_fetch_assoc($result_fr);

                            $show_avatar_sugg= $show_avatar_sugg.'<div class="row m-0 pl-2">
                            
                                <a href="../home/profile.php?id=' . $suggestions["id"] . '">
                                    <img class="box-icon-profile float-left img-re-sug" src="../images/avatar/' . $suggestions["avatar_url"] . '" alt="" sizes="" srcset="">
                                </a>
                                <div class="name-re-sugg">'.$suggestions["username"].'
                                    <div class="blockquote-footer">Suggested for you</div>
                                </div>
                                <a class="ml-5" href="../home/addfriend.php?id=' . $suggestions["id"] . '"">Add Friend</a>


                            </div> ';
                            array_push($rand2,$t);
                        }
                    }
                }
    //// end Suggestions user
    $show_avatar = '<a href="../home/profile.php?id=' . $rowav["id"] . '">
        <img class="box-icon-profile float-left img-re" src="../images/avatar/' . $rowav["avatar_url"] . '" alt="" sizes="" srcset="">
        </a>
        ';
    }
    // $row_r = mysqli_fetch_assoc($result_recommend);
    // print_r($row_r); 
    // $sql_get_avt = 'SELECT avatar_url FROM users WHERE id=(SELECT id_user FROM photos WHERE id= ' . $row_r["id"] . ') ';
    // $result_get_avt = $link->query($sql_get_avt); 
    // $row_get_avt = mysqli_fetch_assoc($result_get_avt);
    //print_r(mysqli_fetch_assoc($result_recommend));
    if(!empty($result_recommend)){
        if  (mysqli_num_rows($result_recommend) > 0) {
            while ($row_r = mysqli_fetch_assoc($result_recommend)) {
                //print_r(mysqli_num_rows($result_recommend));
                $sql_getid = 'SELECT * FROM users WHERE id=(SELECT user_id FROM posts WHERE id= ' . $row_r["id"] . ') ';
                //print_r($row_r["status_photo"]);
                $sql_get_avt = 'SELECT avatar_url FROM users WHERE id=(SELECT user_id FROM posts WHERE id= ' . $row_r["id"] . ') ';
                $result_getid = $link->query($sql_getid);
                $result_get_avt = $link->query($sql_get_avt); 
                $row_get_avt = mysqli_fetch_assoc($result_get_avt);
            // print_r($row_get_avt);
                $row_getid = mysqli_fetch_assoc($result_getid);
            // print_r($row_getid);
                if ($row_r["status_post"] == 1) {
                    // print_r($row_r["status_photo"]);
                    $show_content = $show_content . ' 
                    <div class="col-md-12 col-lg-12 pt-4 item">
                        <div class="card ds-card">
                        <div class="card-body" >
                        '.
                            // echo $row_getid["avata_url"];
                            // $result_get_avt
                            '<a href="../home/profile.php?id=' . $rowav["id"] . '">
                            <img class="box-icon-profile float-left img-re" src="../images/avatar/' . $row_get_avt["avatar_url"] . '" alt="" sizes="" srcset="">
                            </a>'
                        .'
                        <div class="name-re-content">
                        <a  href="profile.php?id=' . $row_getid["id"] . '">
                        </div>
                        ' . $row_getid["username"] . '</a>
                        </div>

                            <a class="lightbox" href="newsfeed.php?id=' . $row_r["id"] . '">
                                <img class="img-fluid image scale-on-hover box-profile" src="../images/' . $row_r["images_url"] . '">
                            </a>
                            <div class="card-body">
                                <button class="btn btn-outline-secondary">Like</button>
                                <p>12 likes</p>
                                <hr>
                                <div class="comment-css">   
                                <a  href="profile.php?id=' . $row_getid["id"] . '">
                                ' . $row_getid["username"] . ':</a>
                                <h9 class="text-content">' . $row_r["images_description"] . '</h9>
                                <form action="comment.php" class="comment-form" method="POST">
                                <hr>
                                <div class="input-group mb-3">
                                <input type="text" class="form-control cmt" placeholder="Add a Comment ..." aria-label="Comment" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                <button class="input-group-text" id="basic-addon2">OK</button>
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


    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $username2;?> ♣ BLUE SKY</title>
        <script src="js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="css/owl/owl.theme.default.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/simple-sidebar.css" rel="stylesheet">
        <link rel="stylesheet" href="css/hover.css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="grid-gallery.css">


    </head>

    <body>
        <!--TODO: This navigation-->
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
            
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                <a href="" class="mr-4">
                    <div class="ds-hover nav-item text-white pt-2 nav-link     ">
                    Message
                     </div>
                </a>
                <div id="noti_Container " class="pt-2 mr-5">

                    <div id="noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->
                    
                    <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                    <div id="noti_Button"></div>    

                    <!--THE NOTIFICAIONS DROPDOWN BOX.-->
                    <div id="notifications">
                        <h3>Notifications</h3>
                        <div style="height:300px;">
                        <div class="container">
                        <div class="col-md-5">
                                                Friend Requests
                                                </div>
                            <div class="row m-0 pl-2">
                            
                            <a href="../home/profile.php?id=4">
                                <img class="box-icon-profile float-left img-re-sug" src="../images/avatar/user.png" alt="" sizes="" srcset="">
                            </a>
                            <div class="name-re-sugg">ABD
                                <div class="blockquote-footer">Suggested for you</div>
                            </div>
                            <a class="ml-5" href="../home/addfriend.php?id=4">Accept</a>


                        </div>

                        </div>
                        </div>
                        <div class="seeAll"><a href="#">See All</a></div>
                    </div>
                 </div>
                    <!-- TODO: PHP USER -->
                    <?php echo $log_reg; ?>
                </ul>
            </div>
           
        </nav>
        <!--TODO:Content-->
            <div class="container bg-white">
                <div class="container bg-white">
                    <div class="row">
                        <div class="col=md-2">  
                        </div>
                        <div class="col-md-8">  
                            <div class="row mr-3" >
                                <div class="form-group col-lg-12 border border-info p-2">
                                    <input class="form-control input-lg " id="inputlg" placeholder="Bạn đang nghĩ gì? ..."  type="text">
                                    <hr>
                                    <a href="upload.php">
                                        <button class="btn btn-primary btn mx-2">Ảnh</button>
                                    </a>
                                    <a href="uploadvideo.php">
                                        <button class="btn btn-primary btn mx-2">Video</button>
                                    </a>
                                </div>
                             </div> 
                                 <div>
                                    <?php
                                    echo $show_content;
                                    ?>
                                </div>
                        </div>
                                    <div class="col-md-4">
                                        <div class="position-fixed">
                                             <div class="row">
                                                <!-- <img class="box-icon-profile float-left img-re" src="images/user.jpg" alt="" sizes="" srcset=""> -->
                                                <?php
                                                    echo $show_avatar;
                                                ?>
                                                <div class="name-re"><?php echo $log_reg_user;?></div>
                                                
                                             </div>
                                              <hr>
                                                 <!-- Suggestions -->
                                             <div class="row">
                                                <div class="col-md-5">
                                                Suggestions For You
                                                </div>
                                                <div class="col-md-2">
                                                    <a class="float-right" href="">See all</a>
                                                </div>

                                             </div>
                                            <div class="row d-inline m-0"> 
                                                <?php
                                                    echo $show_avatar_sugg;
                                                ?>
                                             </div>
                                    
                                        
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-5">
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
                                                        <li class="list-inline-item"><span class="">Language<select aria-label="Switch Display Language" class="">
                                                            <option value="af">Afrikaans</option>
                                                            <option value="cs">Čeština</option>
                                                            <option value="da">Dansk</option>
                                                            <option value="de">Deutsch</option>
                                                            <option value="el">Ελληνικά</option>
                                                            <option  selected="selected" value="en">English</option>
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
                                            </div>
                                        </div>
                                        <div >
                                        © 2020 BULE SKY FROM EARTH :))
                                        </div>
                                    </div>
                                    </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        <!--JS-->

        <script src="js/popper.min.js"></script>
        <script src="js/owl/owl.carousel.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/sidebar.js"></script>
        <script src="js/owl/owl.js"></script>
        
    </body>

    </html>