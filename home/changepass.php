<?php
session_start();
if (isset($_SESSION['id'])) { } else {
	echo '<script language="javascript">';
	echo 'alert("Website not available.\nYou will return Home, right now.")';
	echo '</script>';
	echo '<script language="javascript">';
	echo 'window.location.href = "../home/"';
	echo '</script>';
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Password</title>
    <link rel="stylesheet" href="css/auto.css">
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

<!--TODO: upload image-->
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">

</div>
</nav>

	<!-- <form class="form-change-pass" method="POST" action="changep_true.php">
			<input type="password" placeholder="password" name="passold"><br>
			<input type="password" placeholder="new password" name="passnew"><br>
			<button type="submit">Change password</button>
    </form> -->
    <div class="container">
        <div class="row justify-content-center pt-5" >
                <section class="mb-5 text-center">

            <p>Set a new password</p>

            <form  method="POST" action="changep_true.php">

                <div class="md-form md-outline">
                <input type="password" id="newPass" class="form-control">
                <label data-error="wrong" data-success="right" for="newPass">New password</label>
                </div>

                <div class="md-form md-outline">
                <input type="password" id="newPassConfirm" class="form-control">
                <label data-error="wrong" data-success="right" for="newPassConfirm">Confirm password</label>
                </div>

                <button type="submit" class="btn btn-primary mb-4">Change password</button>

            </form>

            <div class="d-flex justify-content-between align-items-center mb-2">

                <u><a href="../login/">Back to Log In</a></u>

                <u><a href="../register/">Register</a></u>

            </div>

</section>
</div>
</div>



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