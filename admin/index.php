<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../database/mysql.php');
$connect = connect();
if(!isset($_SESSION['admin'])){
    header('location:/admin/login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diễn đàn</title>
    <link href="../template/css/global/style.css" rel="stylesheet" type="text/css">
    <link href="../template/css/global/header.css" rel="stylesheet" type="text/css">
    <link href="../template/css/global/footer.css" rel="stylesheet" type="text/css">
    <link href="../template/css/page-admin/index.css" rel="stylesheet" type="text/css">
</head>
<body>

<header>
    <div class="container-header">
        <div class="title">
            <h2><a href="index.php">Diễn đàn</a></h2>
        </div>
        <?php if(!isset($_SESSION['admin'])):?>
            <div class="user">
                <div class="user-login">
                    <h2><a href="/admin/login.php">Login</a></h2>
                </div>
                <div class="user-register">
                    <h2><a href="/admin/register.php">Register</a></h2>
                </div>
            </div>
        <?php else:?>
            <div class="user">
                <a class="button post-button" href="post.php">Đăng bài</a>
                <div class="user-login">
                    <h2> <?php echo $_SESSION['admin']['fullname']?> | <a href="logout.php">Đăng xuất</a> </h2>
                </div>
            </div>
        <?php endif;?>
    </div>
</header>
<div class="body">
    <div class="list-post">
         <h1>DASHBOARD</h1>
    </div>
    <div class="sidebar">
        <div class="sidebar-title">
            <h2>ADMIN</h2>
        </div>
        <ul class="items">
            <li class="item"><a href="/admin/user.php">Quản lý user</a></li>
            <li class="item"><a href="/admin/post.php">Quản lý bài viết</a></li>
        </ul>
    </div>
</div>

<footer>
    <p>footer</p>
</footer>
</body>
</html>
