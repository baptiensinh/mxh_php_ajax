<?php
require_once "../includes/session.php";
require_once "../includes/connectdb.php";
$search = $_POST['search'];
$show_content = '<table>';


if (isset($_SESSION["id"]) && isset($_POST['search']) && $_POST['search']!=''){
    // Search all username
    $sql_show_recommend_user = 'SELECT * FROM users 
                                WHERE (username LIKE "' . $search . '%" OR email LIKE "' . $search . '%") AND username NOT IN 
                                (SELECT username FROM users WHERE id = '.$_SESSION["id"].')';
    $result_recommend_user = $link->query($sql_show_recommend_user);

    // Search all description post
    $sql_show_recommend_post = 'SELECT * FROM posts WHERE description LIKE "%' . $search . '%" AND username NOT IN 
                                (SELECT description FROM posts WHERE user_id = '.$_SESSION["id"].')';
    $result_recommend_post = $link->query($sql_show_recommend_post);

    // show result search user
    if (mysqli_num_rows($result_recommend_user) > 0) {
    while ($rowSearch = mysqli_fetch_assoc($result_recommend_user)) {
    $show_content = $show_content . 
            '<tr>
                <td>
                    <a class="lightbox" href="../home/profile.php?id=' . $rowSearch["id"] . '">
                        <img class="img-fluid image scale-on-hover box-profile" style=" width:120px;height:120px;" src="../images/avatar/' . $rowSearch["avatar_url"] . '">
                    </a>
                </td>
                <td>
                    <h5><a class="lightbox" href="../home/profile.php?id=' . $rowSearch["id"] . '"> ' . $rowSearch["username"] . '</a></h5>
                </td>
            </tr>';
        }
    } else
    if (mysqli_num_rows($result_recommend_post) > 0) {
    while ($rowSearch = mysqli_fetch_assoc($result_recommend_post)) {

    // show information photo, post, user
    $sql_get_photo  =  'SELECT p.description AS pdes, p.images_url AS img_url, u.username AS username, u.id AS userid
                        FROM photos p JOIN posts_photos pp JOIN posts JOIN users u
                        ON p.id = pp.photo_id AND pp.post_id=posts.id AND posts.user_id = u.id';

    $result_get_photo = $link->query($sql_get_photo);
    $row_get_photo = mysqli_fetch_assoc($result_get_photo);

    $show_content = $show_content . 
            '<tr>
                <td>
                    <a class="lightbox" href="../home/newsfeed.php?id=' . $rowSearch["id"] . '">
                        <img class="img-fluid image scale-on-hover box-profile" style=" width:150px;height:100px;" src="../images/' . $row_get_photo["img_url"] . '">
                    </a>
                </td>
                <td>
                    <a class="lightbox" href="../home/profile.php?id=' . $row_get_photo["userid"] . '"> <h5>' . $row_get_photo["username"] . '</h5></a>
                    <h6>Post Description: <a class="lightbox" href="../home/newsfeed.php?id=' . $rowSearch["id"] . '"> ' . $rowSearch["description"] . '</h6></a>
                    <p> Photo Description: ' . $row_get_photo["pdes"] . '</p>
                </td>
            </tr>';
        }
    } 
    else {
    $show_content = '<h2 class="text-black pt-5">No result for: ' . $search.'</h2>';
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlueSky - Search<?php ?></title>
    <link rel="stylesheet" href="css/owl/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="css/hover.css">
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />
    <link rel="stylesheet" href="grid-gallery.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/footer.css"> -->

</head>

<body>
    <!--TODO:Back to top-->
    <a id="button"></a>
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
    <!--TODO:This Header-->
    <header>



        </div>
    </header>

    <!--TODO:Content-->
    <section class="gallery-block grid-gallery">
        <div class="container">
            <h4 class="text-black pt-5">Search Result for:
                <?php
                echo $search;
                ?>
            </h4>
            <div class="row">
                <?php
                echo $show_content;
                ?>
            </div>
        </div>

    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.grid-gallery', {
            animation: 'slideIn'
        });
    </script>
    <!--TODO:test load <div id="LoadNewsFeed"></div> -->

    <!--TODO: That's button upload-->
    <a href="upload.php">
        <div class="ds-upload position-fixed">
            <button class="" id="login" type=""> <img src="images/photo.png" alt="" srcset=""> Upload</button>
        </div>
    </a>
    <!--JS-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/owl/owl.carousel.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/owl/owl.js"></script>
    <!--TODO: load <script src="js/loadHTML.js"></script> -->
    <script src="js/totop.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script> -->
    <!-- footer -->
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