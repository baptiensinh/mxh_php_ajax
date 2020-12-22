<?php
require_once "../includes/session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlueSky Upload</title>
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
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <!--TODO:Back to top-->
    <a id="button"></a>

    <!-- /#sidebar-wrapper -->
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

   
    <!--TODO: That's button upload-->
    <div class="container pt-5 pb-5">
        <form action="upload_image.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <input type="file" name="image" onchange="readURL(this);" required/>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <button class="btn ds-modal-button float-right" id="upload" type="submit">Upload</button>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <input class="w-100" type="text" name="title_image" id="title_image" placeholder="Enter title image..." required maxlength="99">
                </div>
                <div class="col-sm-12 col-lg-6">
                    <input class="w-100" type="text" name="images_description" id="images_description" placeholder="Enter description..." required maxlength="99">
                </div>
                <div class="col-sm-12 col-lg-12">
                    <img class="ds-img-upload" id="blah" src="images/bilibili.jpeg" alt="your image" />
                </div>
            </div>

        </form>
    </div>

    <script src="js/upload.change.image.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/owl/owl.carousel.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/sidebar.js"></script>
    <script src="js/owl/owl.js"></script>
    <script id="dsq-count-scr" src="//127-0-0-1-5500.disqus.com/count.js" async></script>
    <script src="js/totop.js"></script>
    <!-- <footer></footer> -->
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