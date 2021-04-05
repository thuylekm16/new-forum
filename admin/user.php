<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../database/mysql.php');
$connect = connect();
$query = "SELECT * FROM users WHERE usertype = 1 ORDER BY id DESC";
$result = $connect->query($query);
$result = $result->fetch_all(MYSQLI_ASSOC);

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
                    <h2> | <a href="logout.php">Đăng xuất</a> </h2>
                </div>
            </div>
        <?php endif;?>
    </div>
</header>
<div class="body">
    <div class="list-post">
        <div class="list-header">
            <div class="name">Name</div>
            <div class="dob">Dob</div>
            <div class="email">email</div>
            <div class="sex">Sex</div>
            <div class="action">Action</div>
        </div>
        <ul>
            <?php
            foreach ($result as $value):
            ?>
            <li class="">
                <div class="name"><a href="#"><?=$value["fullname"]?></a></div>
                <div class="dob"><?=$value["birthday"]?></div>
                <div class="email"><?=$value["email"]?></div>
                <div class="sex"><?php
                    if($value['sex']==1)
                        echo 'Nam';
                    else
                        echo 'Nữ';
                    ?>
                </div>
                <div class="action"><button>edit</button></div>
            </li>
            <?php endforeach;?>
        </ul>
        <div class="paginate">
            <div class="paginate-items">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a href="#" class="active">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div>
        </div>

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
