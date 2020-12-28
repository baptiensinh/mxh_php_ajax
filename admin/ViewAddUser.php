<?php
session_start();
?>


<?php 
include('includes/header.php'); 
include('includes/navbar.php'); 
include('includes/scripts.php'); 
include('includes/footer.php');
?>

<div class="content">
    <div class="container-fluid" style="width: 50%; float: right; margin-right:20%;" align="center">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h1 class="title">ADD USER</h1>
                    </div>
                        <form method="POST" action="AddUser.php">
                            <input class="id" type="hidden" name="id" value="">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>UserName</label>
                                        <input type="text" class="form-control username" name="username" placeholder="Nhập username" value="" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control email" name="email" placeholder="Nhập email" value="" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Pass</label>
                                        <input type="password" class="form-control pass" name="pass" placeholder="Nhập password" value="" required="required">
                                    </div>
                                </div>
                            </div>
                            <!--- <button type="submit" class="btn btn-info btn-fill pull-left">Xóa người dùng</button>   -->
                            <div class="row">
                                <div class="col-md-10">
                                    <button type="submit" value="Add" class="btn btn-success">Add</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

