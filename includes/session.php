<?php
session_start();
// $log_reg=$_SESSION["username"];
require_once "../includes/connectdb.php";
$log_reg = '';



if (isset($_SESSION["username"])) {
    $id2=$_SESSION["id"];
    $username2=$_SESSION["username"];
    $show=get_invites($id2,$link);
    $log_reg = '
               <a href="" class="mr-4">
                    <div class="ds-hover nav-item text-white pt-2 nav-link     ">
                    Message
                     </div>
                </a>
                <div id="noti_Container " class="pt-2 mr-5">

                    <div id="noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->
                    
                    <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                    <div id="noti_Button"><img class="noti" src="images/notification.png" alt=""></div>    

                    <!--THE NOTIFICAIONS DROPDOWN BOX.-->
                    <div id="notifications">
                        <h3>Notifications</h3>
                        <div style="height:300px;">
                        <div class="container">
                        <div class="col-md-5">
                                                Friend Requests
                                                </div>
                            '. $show .'
                        </div>
                        </div>
                        <div class="seeAll"><a href="#">See All</a></div>
                    </div>
                 </div>
            <li class="ds-hover nav-item text-white"> 
                <a class="nav-link pl-1" href="../home/profile.php?id='.$_SESSION["id"].'"> ' . $_SESSION["username"] . '</a>
            </li>
            <li class="ds-hover nav-item text-white ">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>

        ';
        $log_reg_user = '

        <li class="text-white ">
            <a class="text-color" href="../home/profile.php?id='.$_SESSION["id"].'"> ' . $_SESSION["username"] . '</a>
        </li>';
        
        
        
      
} else {
    $log_reg = '
            <li class="ds-hover nav-item text-white">
                <a class="nav-link pl-1" href="../login">Login</a>
            </li>
            <li class="ds-hover nav-item text-white">
                <a class="nav-link" href="../register">Create a account</a>
            </li>
        ';
        $username2=null; 
        $id2=null;
        $log_reg_user=null;
}

?>