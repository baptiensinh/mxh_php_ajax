<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mxh');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

function get_friends($userid,$link){
    $row_fr3 = array();
    $sql_fr1="SELECT user2 as id,friend_stt,create_time FROM relationships 
         WHERE user1 = '  $userid  'and friend_stt=1;"; 
         
    $result_fr1 = $link->query($sql_fr1);
    if ($result_fr1->num_rows > 0){
        while($row_fr1 = mysqli_fetch_assoc($result_fr1)){
            $rf=$row_fr1["id"];
            $fr1="SELECT * FROM users
                WHERE id = '  $rf  ';"; 
            $rs=$link->query($fr1);
            $r_fr1 = mysqli_fetch_assoc($rs);
            array_push($row_fr3,$r_fr1["id"]);
            //dien vo day
        }
    }
   //print_r($row_fr1);

    $sql_fr2="SELECT user1 as id,friend_stt,create_time FROM relationships 
         WHERE user2 = '  $userid  'and friend_stt=1;"; 
    $result_fr2 = $link->query($sql_fr2);

    if ($result_fr2->num_rows > 0){
        while($row_fr2 = mysqli_fetch_assoc($result_fr2)){
            $rf=$row_fr2["id"];
            $fr1="SELECT * FROM users
                WHERE id = '  $rf  ';"; 
            $rs=$link->query($fr1);
            $r_fr1 = mysqli_fetch_assoc($rs);
            array_push($row_fr3,$r_fr1["id"]);
            //dien vo day
        }
    }
    if($row_fr3){
        // print_r($row_fr3);
        return $row_fr3;
    }else{
        return 0;
    }
}

function get_invites($userid,$link){
    $sql_fr1="SELECT user1 as id,friend_stt,create_time FROM relationships 
         WHERE user2 = ' $userid 'and friend_stt=0;"; 
    $result_fr1 = $link->query($sql_fr1);
    $show="";
    if ($result_fr1->num_rows > 0){
        while($row_fr1 = mysqli_fetch_assoc($result_fr1)){
            $rf=$row_fr1["id"];
            $fr1="SELECT * FROM users
                WHERE id = '  $rf  ';"; 
            $rs=$link->query($fr1);
            $r_fr1 = mysqli_fetch_assoc($rs);
            $show=$show.'
            <div class="row m-0 pl-2">
                <div class="col-8">   
                    <a href="../home/profile.php?id=' . $r_fr1["id"] . '">
                        <img class="box-icon-profile float-left img-re-sug" src="../images/avatar/'. $r_fr1["avatar_url"] .'" alt="" sizes="" srcset="">
                        <div class="name-re-sugg">'.$r_fr1["username"].'</div>
                    </a>
                   
                </div>
                <div class="col-4">
                    <a href="../home/accept.php?id='.$r_fr1["id"].'">
                    Accept
                    </a>
                </div>  
            </div>
            '
            ;
        }
        return $show;
    }
}

function get_inv_sent($userid,$link){
    $sql_fr1="SELECT user2 as id,friend_stt,create_time FROM relationships 
         WHERE user1 = ' $userid ' and friend_stt=0;"; 
    // print_r($sql_fr1);
    // echo "<br>";
    $result_fr1 = $link->query($sql_fr1);
    // print_r($result_fr1);
    // echo"<br>";
    
    if ($result_fr1->num_rows > 0){
        while($row_fr1 = mysqli_fetch_assoc($result_fr1)){
            $rf=$row_fr1["id"];
            $fr1="SELECT * FROM users
                WHERE id = " . $rf  .";"; 
            $rs=$link->query($fr1);
            $r_fr1 = mysqli_fetch_assoc($rs);
            

        }
        return $show;
    }
}
function get_inv_count($userid,$link){
    $sql_fr1="SELECT user1 as id,friend_stt,create_time FROM relationships 
         WHERE user2 = ' $userid ' and friend_stt=0;"; 
    // print_r($sql_fr1);
    // echo "<br>";
    $result_fr1 = $link->query($sql_fr1);
    // print_r($result_fr1);
    // echo"<br>";
    $show=0;
    if ($result_fr1->num_rows > 0){
        while($row_fr1 = mysqli_fetch_assoc($result_fr1)){
            $rf=$row_fr1["id"];
            $fr1="SELECT * FROM users
                WHERE id = " . $rf  .";"; 
            $rs=$link->query($fr1);
            $r_fr1 = mysqli_fetch_assoc($rs);
            $show++;
        }
        return $show;
    }
}





function not_friends($userid,$link){
    $sql_fr1="SELECT user2 as id,friend_stt,create_time FROM relationships 
    WHERE user1 = ' $userid ' and friend_stt!=2;"; 
    $row_fr2=array();

    $result_fr1 = $link->query($sql_fr1);

    if ($result_fr1->num_rows > 0){
        while($row_fr1 = mysqli_fetch_assoc($result_fr1)){
            $rf=$row_fr1["id"];
            array_push( $row_fr2,$row_fr1["id"]);

            //dien vo day
        }
    }
    $sql_fr1="SELECT user1 as id,friend_stt,create_time FROM relationships 
    WHERE user2 = ' $userid ' and friend_stt!=2;"; 

    $result_fr1 = $link->query($sql_fr1);

    if ($result_fr1->num_rows > 0){
        while($row_fr1 = mysqli_fetch_assoc($result_fr1)){
            $rf=$row_fr1["id"];
            array_push( $row_fr2,$row_fr1["id"]);

            //dien vo day
        }
    }

    $not_friends=array();
    
    $sql_fr1="SELECT id FROM users 
    WHERE id!=$userid;"; 
    $result_fr1 = $link->query($sql_fr1);

    if ($result_fr1->num_rows > 0){
        while($row_fr1 = mysqli_fetch_assoc($result_fr1)){
            $rf=$row_fr1["id"];
            array_push( $not_friends,$row_fr1["id"]);

            //dien vo day
        }
    }
    $result=array_diff($not_friends,$row_fr2);
    $fini=array();
    foreach($result as $value){
        array_push( $fini,$value);
    }
    return $fini;
    // foreach($result as $value)
    // {   
    //     print_r($value);
    //     $sql_fr1="SELECT * FROM users 
    //     WHERE id=$value;"; 
    // }

}



