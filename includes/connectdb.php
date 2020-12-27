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
    $sql_fr1="SELECT user2 FROM relationships 
         WHERE user1 = '  $userid  'and friend_stt=1;"; 
         
    $result_fr1 = $link->query($sql_fr1);

    $row_fr1 = mysqli_fetch_assoc($result_fr1);
    print_r($row_fr1);

    $sql_fr2="SELECT * FROM relationships 
         WHERE user1 = '  $userid  'and friend_stt=1;"; 
    $result_fr2 = $link->query($sql_fr2);
    $row_fr2 = mysqli_fetch_assoc($result_fr2);
    array_push($row_fr1,$row_fr2);
    if($row_fr1){
        return $row_fr1;
    }
    else{
        return "";

    }
}
function get_invites($userid){
    $sql_fr1="SELECT user2 FROM relationships 
         WHERE user1 = " . $userid . "and friend_stt=0;"; 
    $result_fr1 = $link->query($sql_fr1);
    $row_fr1 = mysqli_fetch_assoc($result_fr1);
    $sql_fr2='SELECT * FROM relationships 
         WHERE user1 = ' . $userid . 'and friend_stt=0;'; 
    $result_fr2 = $link->query($sql_fr2);
    $row_fr2 = mysqli_fetch_assoc($result_fr2);
    array_push($row_fr1,$row_fr2);
    if($row_fr1){
        return $row_fr1;
    }
    else{
        return "";   
    }
}



