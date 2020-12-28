<nav class="navbar navbar-expand-lg navbar-dark bg-mattBlackLight fixed-top">
    <button class="navbar-toggler sideMenuToggler" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand" href="#">BLUESKY Admin</a>
      
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons icon">
                        person
                    </i>
                    <span class="text">Account</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
    
<div class="wrapper d-flex">
    <div class="sideMenu bg-mattBlackLight">
        <div class="sidebar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="home.php" class="nav-link px-2">
                        <i class="material-icons icon">dashboard</i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ListUsers.php" class="nav-link px-2">
                        <i class="material-icons icon">person</i>
                        <span class="text">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ListBlockedUsers.php" class="nav-link px-2">
                        <i class="material-icons icon">insert_chart </i>
                        <span class="text">Blocked Users</span></a>
                </li>
                <li class="nav-item">
                    <a href="ListPosts.php" class="nav-link px-2">
                        <i class="material-icons icon">pages</i>
                        <span class="text">Posts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ListDeletedPosts.php" class="nav-link px-2">
                        <i class="material-icons icon">computer</i>
                        <span class="text">Deleted Posts</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
    