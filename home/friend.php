<?php
    session_start();
    require_once "../includes/connectdb.php";

    $userid = $_GET['id'];
    $fr=get_friends($userid,$link);
    $show="";
    if($fr){
        foreach($fr as $val){
            $fr1="SELECT * FROM users
                    WHERE id = '  $val  ';"; 
                $rs=$link->query($fr1);
                if(mysqli_num_rows($rs) > 0){
                $r_fr1 = mysqli_fetch_assoc($rs);
                if($userid==$_SESSION["id"]){
                    $show=$show.'<div class="row  mb-1">
                                    <a href="../home/profile.php?id=' . $r_fr1["id"] . '">
                                <img class="box-icon-profile float-left img-re" src="../images/avatar/' . $r_fr1["avatar_url"] . '" alt="" sizes="" srcset="">
                                
                                </a>
                                <div class="name-re-content m-4 ml-1">
                                    <a class=""  href="profile.php?id=' . $r_fr1["id"] . '">
                                ' . $r_fr1["username"] . '</a>
                                </div>
                                <div class="name-re-content m-4 ml-1">
                                <a   href="unfr.php?id=' . $r_fr1["id"] . '">
                                Delete
                                </a>
                                </div>
                                
                            </div>
                            <hr>';
                }else{
                $show=$show.'<div class="row  mb-1">
                                    <a href="../home/profile.php?id=' . $r_fr1["id"] . '">
                                <img class="box-icon-profile float-left img-re" src="../images/avatar/' . $r_fr1["avatar_url"] . '" alt="" sizes="" srcset="">
                                </a>
                                <div class="name-re-content">
                                    <a  href="profile.php?id=' . $r_fr1["id"] . '">
                                ' . $r_fr1["username"] . '</a>
                                </div>
                            </div> <hr>';
                }
            }
        }
    }
    echo $show;

?>