<?php
require_once "../includes/session.php";
require_once "../includes/connectdb.php";

if (isset($_GET["id"])) {
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
        echo 'window.location.href = "../home/profile.php?id=' . $row["id_user"] . '"';
        echo '</script>';
    }
    $url = '
            src="../images/' . $row["images_url"] . '"
                ';
    $download_image = '../images/' . $row["images_url"] . '';

    //TODO:get username
    $sql2 = 'SELECT *
                FROM users
                WHERE id = "' . $row["id_user"] . '";
        ';
    $result2 = $link->query($sql2);
    $row2 = mysqli_fetch_assoc($result2);
    //TODO: show avatar
    if ($row2["avatar_url"] == null) {
        $show_avatar = '<a href="../home/profile.php?id=' . $row2["id"] . '">
                    <img class="box-icon float-left" src="images/user.jpg" alt="" sizes="" srcset="">
                    </a>
                    ';
    } else {
        $show_avatar = '<a href="../home/profile.php?id=' . $row2["id"] . '">
                    <img class="box-icon float-left" src="../images/avatar/' . $row2["avatar_url"] . '" alt="" sizes="" srcset="">
                    </a>
                    ';
    }
    //TODO: just for recommend
} else {
    $ids_get = $_GET["ids"];
    $sql = 'SELECT *
    FROM photos_any
    WHERE id = ' . $ids_get . '
';
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
                    <img class="box-icon float-left" src="images/user.jpg" alt="" sizes="" srcset="">
                    
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

// TODO: get last id> SELECT id FROM tablename ORDER BY id DESC LIMIT 1
$sql_lastid = 'SELECT id FROM photos ORDER BY id DESC LIMIT 1';
$result_lastid = $link->query($sql_lastid);
$row_lastid = mysqli_fetch_assoc($result_lastid);
$show_recommend = '';
if ((int)$row_lastid["id"] > 10) {
    $start_id = $row_lastid["id"] - 15;
    $end_id = $row_lastid["id"] - 1;
    $sql_show_recommend = 'SELECT * FROM photos 
                    WHERE id between ' . $start_id . ' and ' . $end_id . ' ORDER BY id DESC';
    //$show_recommend = $sql_show_recommend;   
    $result_recommend = $link->query($sql_show_recommend);
    //$show_recommend = $result_recommend;
    if (mysqli_num_rows($result_recommend) > 0) {
        while ($row_r = mysqli_fetch_assoc($result_recommend)) {
            //TODO: SELECT * FROM users WHERE id=(SELECT id_user FROM photos WHERE id= 1)
            $sql_getid = 'SELECT * FROM users WHERE id=(SELECT id_user FROM photos WHERE id= ' . $row_r["id"] . ') ';
            $result_getid = $link->query($sql_getid);
            $row_getid = mysqli_fetch_assoc($result_getid);
            if ($row_r["status_photo"] == 2) { } else {
                $show_recommend = $show_recommend . '
                    <div class="row ds-box">
                        <div class="col-md-5 col-sm-12 dropdown">
                            <a href="../home/newsfeed.php?id=' . $row_r["id"] . '">
                                <img class="ds-thum" src="../images/' . $row_r["images_url"] . '" alt="" srcset="">
                            <div class="dropdown-content">
                                <img class="ds-thum-ho" src="../images/' . $row_r["images_url"] . '" alt="Cinque Terre">
                                <div class="desc">' . $row_r["title"] . '</div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <div class="d-flex text-right">' . $row_r["title"] . '</div>
                            </a>
                            <a href="../home/profile.php?id=' . $row_getid["id"] . '">
                                <div class="d-flex text-right">By ' . $row_getid["username"] . '</div>
                            </a>
                            
                            <div class="d-flex text-right">' . mt_rand(150, 999) . ' Views</div>
                        </div>
                    </div>   
                    <div class="d-flex p-2"></div> 
                    ';
            }
        }
    }
} else {
    //TODO: viet cho lastid < 10
    $start_id = 1;
    $end_id = $row_lastid["id"] - 1;
    $sql_show_recommend = 'SELECT * FROM photos 
                    WHERE id between ' . $start_id . ' and ' . $end_id . ' ORDER BY id DESC';
    //$show_recommend = $sql_show_recommend;   
    $result_recommend = $link->query($sql_show_recommend);
    //$show_recommend = $result_recommend;
    if (mysqli_num_rows($result_recommend) > 0) {
        while ($row_r = mysqli_fetch_assoc($result_recommend)) {
            //TODO: SELECT * FROM users WHERE id=(SELECT id_user FROM photos WHERE id= 1)
            $sql_getid = 'SELECT * FROM users WHERE id=(SELECT id_user FROM photos WHERE id= ' . $row_r["id"] . ') ';
            $result_getid = $link->query($sql_getid);
            $row_getid = mysqli_fetch_assoc($result_getid);
            $show_recommend = $show_recommend . '  
                <div class="row ds-box">
                    <div class="col-md-5 col-sm-12 dropdown">
                        <a href="../home/newsfeed.php?id=' . $row_r["id"] . '">
                            <img class="ds-thum" src="../images/' . $row_r["images_url"] . '" alt="" srcset="">
                        <div class="dropdown-content">
                            <img class="ds-thum-ho" src="../images/' . $row_r["images_url"] . '" alt="Cinque Terre">
                            <div class="desc">' . $row_r["title"] . '</div>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <div class="d-flex text-right">' . $row_r["title"] . '</div>
                        </a>
                        <a href="../home/profile.php?id=' . $row_getid["id"] . '">
                            <div class="d-flex text-right">By ' . $row_getid["username"] . '</div>
                        </a>
                        
                        <div class="d-flex text-right">' . mt_rand(150, 999) . ' Views</div>
                    </div>
                </div>   
                <div class="d-flex p-2"></div> 
                ';
        }
    }
}


$sql_recommend = 'SELECT *
                    FROM photos
                ';





// <img class="box-icon float-left" src="images/user.jpg" alt="" sizes="" srcset="">
// <div class="row ds-box">
// <div class="col-md-5 col-sm-12 dropdown">
//     <img class="ds-thum" src="images/Images/36869222_804435913084696_1261595859506692096_n.jpg" alt="" srcset="">
//     <div class="dropdown-content">
//         <img class="ds-thum-ho" src="images/Images/36869222_804435913084696_1261595859506692096_n.jpg" alt="Cinque Terre">
//         <div class="desc">Beautiful Cinque Terre</div>
//     </div>
// </div>
// <div class="col-md-7 col-sm-12">
//     <div class="d-flex text-right">title name fileaaa</div>
//     <div class="d-flex text-right">Username</div>
//     <div class="d-flex text-right">views</div>
// </div>
// </div>
// <div class="d-flex p-2"></div>

$link->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image - <?php
                        //TODO: caption here
                        echo $row["title"];
                        ?></title>
<link rel="stylesheet" href="css/owl/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="css/hover.css">
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" href="grid-gallery.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">

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
    <div class="container pt-3">
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
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-2">
                                        <img id="love" src="images/hearts.png">
                                    </div>
                                    <!-- <div class="col-2">
                                        <img id="love" src="images/chat.png" data-toggle="modal"
                                            data-target="#viewComment">
                                    </div> -->
                                    <div class="col-9"></div>
                                    <div class="col-1">
                                        <img id="love" src="images/paper-plane.png" data-toggle="modal" data-target="#viewShare">
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                Title:
                                <?php
                                //TODO: caption here
                                echo $row["title"];
                                ?>
                            </li>
                            <li class="list-group-item">
                                Description:
                                <?php
                                //TODO: caption here
                                echo $row["images_description"];
                                ?>
                            </li>
                            <?php
                            if ($row["status_photo"] == 0) {
                                echo '<p class="list-group-item">Waiting for verify. <img src="images/delete.png" alt="" srcset=""></p>';
                            } elseif ($row["status_photo"] == 1) {
                                echo '<p class="list-group-item">Verify by Admin <img src="images/check-mark.png" alt="" srcset=""></p>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <!--TODO:THIS COMMENT DISQUE-->
                <div id="disqus_thread"></div>
                <script>
                    /**
                     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                    /*
                    var disqus_config = function () {
                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    */
                    (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document,
                            s = d.createElement('script');
                        s.src = 'https://127-0-0-1-5500.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                        powered by
                        Disqus.</a></noscript>
            </div>
            <div class="col-md-4 col-sm-12">
                <!--TODO: reconned-->
                <h4 class="text-white text-center">Recommend for you</h4>
                <div class="d-flex p-2"></div>
                <?php
                echo $show_recommend;
                ?>
            </div>
        </div>
    </div>
    <!--TODO: This view more-->
    <!-- Modal -->
    <div class="modal fade" id="viewMore" tabindex="-1" role="dialog" aria-labelledby="viewMoreCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="list-group list-group-flush text-center">
                        <li class="ds-hover-modal list-group-item">
                            Report photo
                        </li>
                        <li class="ds-hover-modal list-group-item">
                            Go to Post
                        </li>
                        <li class="ds-hover-modal list-group-item">Copy url</li>
                        <li class="ds-hover-modal list-group-item">
                            <a <?php
                                echo 'href="' . $download_image . '"';
                                ?>>
                                Download
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--TODO: This share-->
    <!-- Modal -->
    <div class="modal fade" id="viewShare" tabindex="-1" role="dialog" aria-labelledby="viewShareCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="list-group list-group-flush text-left">
                        <li class="ds-hover-modal list-group-item">
                            <img src="images/facebook.png" alt="" srcset="">
                            Share in Facebook
                        </li>
                        <li class="ds-hover-modal list-group-item">
                            <img src="images/twitter.png" alt="" srcset="">
                            Share in Twitter
                        </li>
                        <li class="ds-hover-modal list-group-item">
                            <img src="images/link-symbol.png" alt="" srcset="">
                            Copy link address</li>
                        <li class="ds-hover-modal list-group-item">
                            <img src="images/verified.png" alt="" srcset="">
                            Save
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--TODO: That's button upload-->
    <a href="upload.php">
        <div class="ds-upload position-fixed">
            <button class="" id="login" type=""> <img src="images/photo.png" alt="" srcset=""> Upload</button>
        </div>
    </a>
    <!--TODO: This comment-->
    <!-- Modal -->
    <!-- <div class="modal fade" id="viewComment" tabindex="-1" role="dialog" aria-labelledby="viewCommentCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 d-inline-flex">
                                <!--TODO: this card imageS--
                                <div class="card transform-on-hover w-100">
                                    <div class="card-header Linear-Gradient-nav">
                                        <img class="box-icon float-left" src="images/user.jpg" alt="" sizes=""
                                            srcset="">
                                        <a class="d-inline-flex p-2 ds-username-title" href="#">Username</a>
                                    </div>
                                    <div class="card-body bg-transparent">
                                        <img class="card-img-top img-fluid" src="images/Images/014.jpg"
                                            alt="Card image cap">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!--TODO:THIS COMMENT DISQUE--
                                <div id="disqus_thread"></div>
                                <script>

                                    /**
                                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                                    /*
                                    var disqus_config = function () {
                                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                                    };
                                    */
                                    (function () { // DON'T EDIT BELOW THIS LINE
                                        var d = document, s = d.createElement('script');
                                        s.src = 'https://127-0-0-1-5500.disqus.com/embed.js';
                                        s.setAttribute('data-timestamp', +new Date());
                                        (d.head || d.body).appendChild(s);
                                    })();
                                </script>
                                <noscript>Please enable JavaScript to view the <a
                                        href="https://disqus.com/?ref_noscript">comments powered by
                                        Disqus.</a></noscript>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/owl/owl.carousel.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/owl/owl.js"></script>
    <script id="dsq-count-scr" src="//127-0-0-1-5500.disqus.com/count.js" async></script>
</body>

</html>