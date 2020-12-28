<?php
require_once "../includes/session.php";
require_once "../includes/connectdb.php";

// show list friend
$listfriend = ''; 
if (isset($_SESSION["id"])) {

    $sql_list_fr1 = "SELECT * 
                     FROM relationships r JOIN users u ON r.user2 = u.id
                     WHERE r.user1 = ".$_SESSION["id"]." AND friend_stt = 1";
    $result_list_fr1 = $link->query($sql_list_fr1);

    $sql_list_fr2 = "SELECT * 
                     FROM relationships r JOIN users u ON r.user1 = u.id
                     WHERE r.user2 = ".$_SESSION["id"]." AND friend_stt = 1";
    $result_list_fr2 = $link->query($sql_list_fr2);

    if (mysqli_num_rows($result_list_fr2) > 0) {
        while ($rowUser = mysqli_fetch_assoc($result_list_fr2)) {
            $listfriend = $listfriend . 
            '<li class="">
                <div class="d-flex bd-highlight">
                    <a href="chat.php?id='.$rowUser['id'].'">
                        <div class="img_cont">
                            <img style="width:70px; height:70px" src="../images/avatar/'.$rowUser['avatar_url'].'">
                            <span class="online_icon"></span>
                        </div>
                    </a>
                    <div class="user_info">
                        <span>'.$rowUser['username'].'</span>
                        <p></p>
                    </div>
                </div>
            </li>';
        }
    }

    if (mysqli_num_rows($result_list_fr1) > 0) {
        while ($rowUser = mysqli_fetch_assoc($result_list_fr1)) {
            $listfriend = $listfriend . 
            '<li class="">
                <div class="d-flex bd-highlight">
                    <a href="chat.php?id='.$rowUser['id'].'">
                        <div class="img_cont">
                            <img style="width:70px; height:70px" src="../images/avatar/'.$rowUser['avatar_url'].'">
                            <span class="online_icon"></span>
                        </div>
                    </a>
                    <div class="user_info">
                            <span>'.$rowUser['username'].'</span>
                            <p></p>
                        </div>
                </div>
            </li>';
        }
    }
}

$show_msg = '';

// show username on chat tab
if (isset($_GET['id'])){
    $userid = $_GET['id'];
    $username = '';
    $sql_user = "SELECT username, avatar_url FROM users WHERE id = ".$userid."";
    $result_sql_user = $link->query($sql_user);
    $row = mysqli_fetch_assoc($result_sql_user);
    $username = $username.''.$row['username'].'';

    // show title user contain username and image
    $title_user = '<div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="../images/avatar/'.$row["avatar_url"].'" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span>
                                '.$row["username"].'
                            </span>
                            <p>Messages</p>
                        </div>
                        <div class="video_cam">
                            <span><i class="fas fa-video"></i></span>
                            <span><i class="fas fa-phone"></i></span>
                        </div>
                    </div>
                    <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                    <div class="action_menu">
                        <ul>
                            <li><a href="profile.php?id='.$userid.'"><i class="fas fa-user-circle"></i> View profile</a></li>
                        </ul>
                    </div>
                </div>';


    // show friend's message
    $sql_get_fr_msg = "SELECT c.f_message AS msg, u.avatar_url AS avt, c.create_time AS create_time
                       FROM chat c JOIN users u ON c.t_user = u.id
                       WHERE t_user = ".$_SESSION["id"]." AND f_user = ".$userid."" ;
    $result_get_fr_msg = $link->query($sql_get_fr_msg);

    if (mysqli_num_rows($result_get_fr_msg) > 0) {
        while ($row_msg = mysqli_fetch_assoc($result_get_fr_msg)) {
            $show_msg = $show_msg.
            '<div class="d-flex justify-content-start mb-4">
            <div class="img_cont_msg">
                <img src="../images/'.$row_msg["avt"].'" class="rounded-circle user_img_msg">
            </div>
            <div class="msg_cotainer">
                '.$row_msg['msg'].'
                <span class="msg_time">'.$row_msg["create_time"].'</span>
            </div>
        </div>
            ';
        }
    }

    // show user message
    $sql_get_msg = "SELECT c.f_message AS msg, u.avatar_url AS avt, c.create_time AS create_time
                       FROM chat c JOIN users u ON c.f_user = u.id
                       WHERE f_user = ".$_SESSION["id"]." AND t_user = ".$userid."" ;
    $result_get_msg = $link->query($sql_get_msg);

    if (mysqli_num_rows($result_get_msg) > 0) {
        while ($row_msg = mysqli_fetch_assoc($result_get_msg)) {
            $show_msg = $show_msg.
            '<div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send">
                    '.$row_msg["msg"].'
                    <span class="msg_time_send">'.$row_msg["create_time"].'</span>
                </div>
                <div class="img_cont_msg">
                    <img src="../images/'.$row_msg["avt"].'" class="rounded-circle user_img_msg">
                </div>
            </div>
            ';
        }
    }
}

?>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
        <style>
            body,html{
                height: 100%;
                margin: 0;
                background: #7F7FD5;
                background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
                background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
            }
            .chat{
                margin-top: auto;
                margin-bottom: auto;
            }
            .card{
                height: 500px;
                border-radius: 15px !important;
                background-color: rgba(0,0,0,0.4) !important;
            }
            .contacts_body{
                padding:  0.75rem 0 !important;
                overflow-y: auto;
                white-space: nowrap;
            }   
            .msg_card_body{
                overflow-y: auto;
            }
            .card-header{
                border-radius: 15px 15px 0 0 !important;
                border-bottom: 0 !important;
            }
            .card-footer{
                border-radius: 0 0 15px 15px !important;
                    border-top: 0 !important;
            }
            .container{
                align-content: center;
            }
            .search{
                border-radius: 15px 0 0 15px !important;
                background-color: rgba(0,0,0,0.3) !important;
                border:0 !important;
                color:white !important;
            }
            .search:focus{
                box-shadow:none !important;
            outline:0px !important;
            }
            .type_msg{
                background-color: rgba(0,0,0,0.3) !important;
                border:0 !important;
                color:white !important;
                height: 60px !important;
                overflow-y: auto;
            }
            .type_msg:focus{
                box-shadow:none !important;
                outline:0px !important;
            }
            .attach_btn{
                border-radius: 15px 0 0 15px !important;
                background-color: rgba(0,0,0,0.3) !important;
                border:0 !important;
                color: white !important;
                cursor: pointer;
            }
            .send_btn{
                border-radius: 0 15px 15px 0 !important;
                background-color: rgba(0,0,0,0.3) !important;
                border:0 !important;
                color: white !important;
                cursor: pointer;
            }
            .search_btn{
                border-radius: 0 15px 15px 0 !important;
                background-color: rgba(0,0,0,0.3) !important;
                border:0 !important;
                color: white !important;
                cursor: pointer;
            }
            .contacts{
                list-style: none;
                padding: 0;
            }
            .contacts li{
                width: 100% !important;
                padding: 5px 10px;
                margin-bottom: 15px !important;
            }
            .active{
                background-color: rgba(0,0,0,0.3);
            }
            .user_img{
                height: 70px;
                width: 70px;
                border:1.5px solid #f5f6fa;
            
            }
            .user_img_msg{
                height: 40px;
                width: 40px;
                border:1.5px solid #f5f6fa;
            }
            .img_cont{
                    position: relative;
                    height: 70px;
                    width: 70px;
            }
            .img_cont_msg{
                    height: 40px;
                    width: 40px;
            }
            .online_icon{
                position: absolute;
                height: 15px;
                width:15px;
                background-color: #4cd137;
                border-radius: 50%;
                bottom: 0.2em;
                right: 0.4em;
                border:1.5px solid white;
            }
            .offline{
                background-color: #c23616 !important;
            }
            .user_info{
                margin-top: auto;
                margin-bottom: auto;
                margin-left: 15px;
            }
            .user_info span{
                font-size: 20px;
                color: white;
            }
            .user_info p{
                font-size: 10px;
                color: rgba(255,255,255,0.6);
            }
            .video_cam{
                margin-left: 50px;
                margin-top: 5px;
            }
            .video_cam span{
                color: white;
                font-size: 20px;
                cursor: pointer;
                margin-right: 20px;
            }
            .msg_cotainer{
                margin-top: auto;
                margin-bottom: auto;
                margin-left: 10px;
                border-radius: 25px;
                background-color: #82ccdd;
                padding: 10px;
                position: relative;
            }
            .msg_cotainer_send{
                margin-top: auto;
                margin-bottom: auto;
                margin-right: 10px;
                border-radius: 25px;
                background-color: #78e08f;
                padding: 10px;
                position: relative;
            }
            .msg_time{
                position: absolute;
                left: 0;
                bottom: -15px;
                color: rgba(255,255,255,0.5);
                font-size: 10px;
            }
            .msg_time_send{
                position: absolute;
                right:0;
                bottom: -15px;
                color: rgba(255,255,255,0.5);
                font-size: 10px;
                width: 95px;
            }
            .msg_head{
                position: relative;
            }
            #action_menu_btn{
                position: absolute;
                right: 10px;
                top: 10px;
                color: white;
                cursor: pointer;
                font-size: 20px;
            }
            .action_menu{
                z-index: 1;
                position: absolute;
                padding: 15px 0;
                background-color: rgba(0,0,0,0.5);
                color: white;
                border-radius: 15px;
                top: 30px;
                right: 15px;
                display: none;
            }
            .action_menu ul{
                list-style: none;
                padding: 0;
            margin: 0;
            }
            .action_menu ul li{
                width: 100%;
                padding: 10px 15px;
                margin-bottom: 5px;
            }
            .action_menu ul li i{
                padding-right: 10px;
            
            }
            .action_menu ul li:hover{
                cursor: pointer;
                background-color: rgba(0,0,0,0.2);
            }
            @media(max-width: 576px){
            .contacts_card{
                margin-bottom: 15px !important;
            }
            }
        </style>
        <script>
        	$(document).ready(function(){
                $('#action_menu_btn').click(function(){
                    $('.action_menu').toggle();
                });
            });

            .ajax({
                url: 'chat.php'
            })
        </script>
    </head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div>
						</div>
					</div>
					<div class="card-body contacts_body">
						<ui class="contacts">
                            <?php
                                echo $listfriend;
                            ?>
						</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
                        
                        <?php 
                            if (isset($_GET['id'])){
                                echo $title_user;
                            }
                        ?>

						<div class="card-body msg_card_body">
							
                            <?php
                                echo $show_msg; 
                            ?>
                            
						</div>
						<div class="card-footer">
							<div class="input-group">
                                <form method="POST">
                                    <!-- <div class="input-group-append">
                                        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                    </div> -->
                                    <input type="text" name="msg" class="form-control type_msg" placeholder="Type your message...">
                                    <div class="input-group-append">
                                        <input type="submit" name="send" value="Send">
                                        <!-- <span class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span> -->
                                    </div>
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>


<?php
    // save message to database
    if (isset($_POST["msg"]) && $_POST["msg"]!='' && isset($_POST["send"])){
        $link->query("INSERT INTO chat (f_user, t_user, f_message) 
                      VALUES (" . $_SESSION["id"] . "," . $userid . ",'" . $_POST["msg"] . "')");
    }
?>