<?php
require_once "../../includes/config.php";
session_start();

//TODO: get id image need delete
$id = $_GET["id"];
$_SESSION["id-img"] = $id;
//$title=$_GET["title"];
//TODO: show user name
$sql_showusername = 'SELECT * FROM users WHERE id=(SELECT id_user FROM photos WHERE id=' . $id . ')';
$result_showusername = $link->query($sql_showusername);
$showusername = '';
$row_showusername = mysqli_fetch_assoc($result_showusername);
if (mysqli_num_rows($result_showusername) > 0) {
	if (isset($_SESSION['id']) && $_SESSION['id'] ==  $row_showusername["id"]) {
		//TODO: delete image here
		//DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste';
		$sql = 'SELECT * FROM photos WHERE id=' . $id . '';
		$result = $link->query($sql);
		$row = mysqli_fetch_assoc($result);
	} else {
		//TODO: sure -> out
		echo '<script language="javascript">';
		echo 'alert("Website not available");';
		echo '</script>';
		echo '<script language="javascript">';
		echo 'window.location.href = "../../home/"';
		echo '</script>';
	}
} else {
	echo '<script language="javascript">';
	echo 'alert("Website not available");';
	echo '</script>';
	echo '<script language="javascript">';
	echo 'window.location.href = "../../home/"';
	echo '</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Change title image</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="bg-contact100" style="background-image: url('../../images/bilibili.jpeg');">
		<div class="container-contact100">
			<div class="wrap-contact100">
				<div class="contact100-pic js-tilt" data-tilt>
					<img src="../../images/<?php echo $row["images_url"]; ?>" alt="IMG">
				</div>

				<form class="contact100-form validate-form" action="editimage-true.php" method="POST">
					<span class="contact100-form-title">
						Title old: "<?php echo $row["title"] ?>"
					</span>
					<span class="contact100-form-title">
						Description old: "<?php echo $row["images_description"] ?>"
					</span>
					<span class="contact100-form-title">
						Edit images
					</span>
					<div class="wrap-input100 validate-input" data-validate="Title is required">
						<input class="input100" type="text" name="message" placeholder="New title">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Description is required">
						<textarea class="input100" name="message1" placeholder="New description"></textarea>
						<span class="focus-input100"></span>
					</div>
					<div class="container-contact100-form-btn">
						<button type="submit" class="contact100-form-btn">
							Change
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>



</body>

</html>