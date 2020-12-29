<?php
require_once "../includes/connectdb.php";
require_once "../includes/session.php";
if (isset($username2)){
    // header("location: /phpmxh/admin/login/login.php");


// if (isset($_SESSION["idAdmin"])) {
    // ? For Login
    
    //Total users
    $resultTotalUser = $link->query("SELECT count(*) as total from users");
    $totalUser = mysqli_fetch_assoc($resultTotalUser);

    // Total blocked users
    $resultBlockedUser = $link->query("SELECT count(*) as total from users where status_user = 1 ");
    $totalBlockedUser = mysqli_fetch_assoc($resultBlockedUser);

    //TODO: show Total posts
    $resultTotalPost = $link->query("SELECT count(*) as total from posts");
    $totalPost = mysqli_fetch_assoc($resultTotalPost);

    //TODO: show Total unapproved post
    $resultTotalUnPost = $link->query("SELECT count(*) as total from posts where status_post = 0 ");
    $totalUnPost = mysqli_fetch_assoc($resultTotalUnPost);

    //TODO: show Total comments
    $resultTotalCmt = $link->query("SELECT count(*) as total from comments");
    $totalCmt = mysqli_fetch_assoc($resultTotalCmt);

    //TODO: show Total image verify
    // $resultTotalImageVerA = $link->query("SELECT count(*) as total from photos_any where status_photo = 1");
    // $totalImageVerA = mysqli_fetch_assoc($resultTotalImageVerA);

    //TODO: show Total image not verify
    // $resultTotalImageNotVerA = $link->query("SELECT count(*) as total from photos_any where status_photo = 0");
    // $totalImageNotVerA = mysqli_fetch_assoc($resultTotalImageNotVerA);
    // } else {

    // }
    }
    else{
        header("location: /phpmxh/admin/login/login.php");
    }
?>

<?php 
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<!-- Content Row -->
<div class="row" style="width: 86%; float: right; background-color: #242526; margin-right:5px;">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total user
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                    // show total user
                    echo $totalUser["total"];
                ?>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Blocked Users
                </div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                    // show deleted user
                    echo $totalBlockedUser["total"];
                ?>
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Total Posts
                </div>
                <div class="row no-gutters align-items-center">
                <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                    <?php
                        // show total image exists
                        echo $totalPost["total"];
                    ?>
                    </div>
                </div>
                
                </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Unapproved Posts
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php
                                    // show total image exists
                                    echo $totalUnPost["total"];
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Comments
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php
                                    // show total image exists
                                    echo $totalCmt["total"];
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      <!-- Content Row -->
      

<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>