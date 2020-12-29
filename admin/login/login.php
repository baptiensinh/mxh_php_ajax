<?php
session_start();
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location: ../home/");
//     // exit;
// }
// Include config file
require_once "../../includes/connectdb.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $sql_email = 'SELECT *
    FROM admin
    WHERE email = "' . $email . '" and pass="' . $password . '"';
    $result = $link->query($sql_email);
    // echo mysqli_num_rows($result);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($email == $row["email"]) {
            // $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            echo '<script language="javascript">';
            // echo 'alert("Login successful.")';
            echo 'alert("Login successful\nWelcome back '. $_SESSION["username"].'")';
            echo '</script>';
            echo '<script language="javascript">';
            echo 'window.location.href = "../index.php"';
            echo '</script>';
        }

        //echo ("This is session<br>");
        // echo ($_SESSION["username"]."<br>");
        // echo ($_SESSION["id"]."<br>");

    } else {
        echo '<script language="javascript">';
        echo 'alert("Login unsuccessful.\nEmail or password is incorrect.\nYou will return Login, right now.")';
        echo '</script>';
        echo '<script language="javascript">';
        // echo 'window.location.href = "../login/"';
        echo '</script>';
    }
    //echo ($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>♣ BLUE SKY LOGIN</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body style="background-color: #666666;">

	<div class="limiter">
		<div class="container">
			<div class="text-center">
				<form action="login.php" class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-43">
						Login Admin
					</span>


					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Login
						</button>
					</div>

				</form>
				</div>
			</div>
		</div>
	</div>





	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- <script src="vendor/select2/select2.min.js"></script> -->
	<!-- <script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script> -->
	<!-- <script src="vendor/countdowntime/countdowntime.js"></script> -->
	<script src="js/main.js"></script>

</body>

</html>