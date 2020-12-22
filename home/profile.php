<?php
require_once "../includes/session.php";
require_once "../includes/connectdb.php";


//TODO: show user name
$sql_showusername = 'SELECT * FROM users WHERE id="' . $id . '"';
$result_showusername = $link->query($sql_showusername);
$showusername = '';
$row_showusername = mysqli_fetch_assoc($result_showusername);
if ($row_showusername['status_user'] == 1) {
    echo '<script language="javascript">';
    echo 'alert("Username was banned")';
    echo '</script>';
    echo '<script language="javascript">';
    echo 'window.location.href = "../home"';
    echo '</script>';
}
//TODO: show image for user name
$showphotoid = '';
$sql_showphotoid = 'SELECT * FROM photos
                        WHERE id_user = "' . $id . '" 
                    ORDER BY id DESC';
$result_showphotoid = $link->query($sql_showphotoid);
if (mysqli_num_rows($result_showphotoid) > 0) {
    while ($row_showphotoid = mysqli_fetch_assoc($result_showphotoid)) {
        if (isset($_SESSION['id']) && $_SESSION['id'] ==  $row_showusername["id"]) {
            if ($row_showphotoid["status_photo"] == 0 || $row_showphotoid["status_photo"] == 1) {


                $showphotoid = $showphotoid . '
            <div class="col-md-12 col-lg-4 col-md-3 pt-4 item">
                <div class="card ds-card">
                    <a class="lightbox" href="../home/newsfeed.php?id=' . $row_showphotoid["id"] . '">
                        <img class="img-fluid image scale-on-hover box-profile" src="../images/' . $row_showphotoid["images_url"] . '">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title pt-3">Title: ' . $row_showphotoid["title"] . '</h5>
                        <h5 class="card-title">Description: ' . $row_showphotoid["images_description"] . '</h5>
                        <p class="card-text">ID#' . $row_showphotoid["id"] . '</p>';
                if ($row_showphotoid["status_photo"] == 0) {
                    $showphotoid = $showphotoid . '<p class="card-text">Waiting for verify. <img src="images/delete.png" alt="" srcset=""></p>';
                } elseif ($row_showphotoid["status_photo"] == 1) {
                    $showphotoid = $showphotoid . '<p class="card-text">Verify by Admin <img src="images/check-mark.png" alt="" srcset=""></p>';
                }

                $showphotoid = $showphotoid . '            
                        <div class="text-center">
                            <a href="deletephoto.php?id=' . $row_showphotoid["id"] . '">
                                <button type="button" class="btn btn-danger" onclick="clickDel();">Delete</button>
                            </a>
                            <a href="editImage/editimage.php?id=' . $row_showphotoid["id"] . '">
                                <button type="button" class="btn btn-info" onclick="clickEdit();">Edit</button>
                            </a>
                        </div>    
                    </div>
                </div>
            </div>
        ';
            }
        } else {
            if ($row_showphotoid["status_photo"] == 0 || $row_showphotoid["status_photo"] == 1) {
                $showphotoid = $showphotoid . '
            <div class="col-md-12 col-lg-4 col-md-3 pt-4 item">
                <div class="card ds-card">
                    <a class="lightbox" href="../home/newsfeed.php?id=' . $row_showphotoid["id"] . '">
                        <img class="img-fluid image scale-on-hover box-profile" src="../images/' . $row_showphotoid["images_url"] . '">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title pt-3">Title: ' . $row_showphotoid["title"] . '</h5>
                    <h5 class="card-title">Description: ' . $row_showphotoid["images_description"] . '</h5>
                    <p class="card-text">ID#' . $row_showphotoid["id"] . '</p>';
                if ($row_showphotoid["status_photo"] == 0) {
                    $showphotoid = $showphotoid . '<p class="card-text">Waiting for verify. <img src="images/delete.png" alt="" srcset=""></p>';
                } elseif ($row_showphotoid["status_photo"] == 1) {
                    $showphotoid = $showphotoid . '<p class="card-text">Verify by Admin <img src="images/check-mark.png" alt="" srcset=""></p>';
                }
                $showphotoid = $showphotoid . '
                    </div>
                </div>
            </div>
        ';
            }
        }
    }
}
//TODO: show user name
// $sql_showusername = 'SELECT * FROM users WHERE id="' . $id . '"';
// $result_showusername = $link->query($sql_showusername);
// $showusername = '';
// $row_showusername = mysqli_fetch_assoc($result_showusername);
if (mysqli_num_rows($result_showusername) == 1) {
    $showusername = '<a href="../home/profile.php?id=' . $row_showusername["id"] . '">
                    <div class="row">
                    <div class="col-md-12 ds-post1">
                    <button>' . $row_showusername["username"] . '</button>
                    </div>
                    </div>
                    </a>';
} else {
    $showusername = '
                    <div class="row">
                    <div class="col-md-12 ds-post1">
                    <button disabled="disabled">Username unknown</button>
                    </div>
                    </div>';
}
//TODO: chagne password
$showpasschange = '';
if (isset($_SESSION['id']) && $_SESSION['id'] ==  $row_showusername["id"]) {
    $showpasschange = '
                    <a href="../home/changepass.php?id=' . $_SESSION['id'] . '">
                    <div class="row">
                    <div class="col-md-12 ds-post1">
                    <button>Change password</button>
                    </div>
                    </div>
                    </a>';
} else {
    $showpasschange = '<div class="row"><div class="col-md-12 ds-post1"><button disabled="disabled">Change password - Not have permission</button></div></div>';
}


//TODO: show and change avatar
if (isset($_SESSION['id']) && $_SESSION['id'] ==  $row_showusername["id"]) {
    // ! <img class="box-icon-profile float-left" src="images/user.jpg" alt="" sizes="" srcset="">
    $sql_ava = 'SELECT * FROM users WHERE id= ' . $_SESSION['id'] . '';
    $result_ava = $link->query($sql_ava);
    $row_ava = mysqli_fetch_assoc($result_ava);
    if ($row_ava["avatar_url"] == null) {
        $show_avatar = '<a href="../home/change_ava.php?id=' . $row_ava["id"] . '">
                        <img class="box-icon-profile float-left" src="images/user.jpg" alt="" sizes="" srcset="">
                        </a>
                        ';
    } else {
        $show_avatar = '<a href="../home/change_ava.php?id=' . $row_ava["id"] . '">
                        <img class="box-icon-profile float-left" src="../images/avatar/' . $row_ava["avatar_url"] . '" alt="" sizes="" srcset="">
                        </a>
                        ';
    }
} else {
    $sql_ava = 'SELECT * FROM users WHERE id= ' . $id . '';
    $result_ava = $link->query($sql_ava);
    $row_ava = mysqli_fetch_assoc($result_ava);
    if ($row_ava["avatar_url"] == null) {
        $show_avatar = '
                        <img class="box-icon-profile float-left" src="images/user.jpg" alt="" sizes="" srcset="">
                       
                        ';
    } else {
        $show_avatar = '
                        <img class="box-icon-profile float-left" src="../images/avatar/' . $row_ava["avatar_url"] . '" alt="" sizes="" srcset="">
                       
                        ';
    }
}

// <div class="col-md-12 col-lg-4 col-md-3 pt-4 item">
// <div class="card ds-card">
//     <a class="lightbox" href="../img/image1.jpg">
//         <img class="img-fluid image scale-on-hover" src="../img/image1.jpg">
//     </a>
//     <div class="card-body">
//         <h5 class="card-title">Title</h5>
//         <p class="card-text">Content</p>
//     </div>
// </div>
// </div>
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
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

    <script>
        function clickDel() {
            var s = confirm("One more step?!");
            if (s === true) {
                // continue;
            } else {
                location.reload();
            }
        }

        function clickEdit() {
            alert("You are going to edit photo.");
        }
    </script>
    <!--TODO:Back to top-->
    <a id="button"></a>

    <!-- /#sidebar-wrapper -->
    <!--TODO: This navigation-->
    <nav class="nava navbar navbar-expand-lg fixed-top fix-z-1">

        <a class="navbar-brand ds-hover nav-link" href="../home/">
            <img src="images/7.png" width="120" height="auto" alt="logo">
        </a>
        <!--TODO:SEARCH-->

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
    <div class="pt-5"> </div>
    <div class="container pt-4">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <?php
                echo $show_avatar;
                ?>
            </div>
            <div class="col-md-4">
                    <?php
                    //TODO: show usernames
                    echo $showusername;
                    ?>
            </div>
            <div class="col-md-4">
            <h1 class="display-5 text-white">
                    <?php
                    //TODO:  show change pass
                    echo $showpasschange;
                    ?>
                </h1>
             </div>
        </div>
        <div class="row">
        <h1 class="display-5 text-white">
                    <div class="row">
                        <div class="col-md-12 ds-post1">
                        <div class="col-md-12 ds-post1">
                        <a href="upload.php">
                            <button class=""  id="login" type=""> <img src="images/photo.png" alt="" srcset=""> Upload</button>
                         </a>
                        </div>
                    </div>
                </h1>

        </div>
        <div class="row pt-3">

        </div>
        <div class="row">
            <section class="gallery-block grid-gallery">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <?php
                            echo $showphotoid;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="pt-5"></div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/owl/owl.carousel.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/totop.js"></script>
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
                <option value="en">English</option>
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