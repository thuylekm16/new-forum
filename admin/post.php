<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('../database/mysql.php');
$connect = connect();
$query = "SELECT posts.*, users.fullname FROM posts join users ON posts.user_id = users.id ORDER BY posts.id DESC";
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
        <?php if (!isset($_SESSION['admin'])): ?>
            <div class="user">
                <div class="user-login">
                    <h2><a href="/admin/login.php">Login</a></h2>
                </div>
                <div class="user-register">
                    <h2><a href="/admin/register.php">Register</a></h2>
                </div>
            </div>
        <?php else: ?>
            <div class="user">
                <a class="button post-button" href="post.php">Đăng bài</a>
                <div class="user-login">
                    <h2> <?php echo $_SESSION['admin']['fullname'] ?> | <a href="logout.php">Đăng xuất</a></h2>
                </div>
            </div>
        <?php endif; ?>
    </div>
</header>
<div class="body">
    <div class="list-post">
        <div class="list-header">
            <div class="topic">Topic</div>
            <div class="date">Date</div>
            <div class="reply">Reply</div>
            <div class="edit">Action</div>
        </div>
        <ul>
            <?php
            foreach ($result as $value):
                ?>
                <li class="">
                    <div class="topic"><a href="detail.php?id=<?= $value['id'] ?>"><?= $value['title'] ?></a>
                        <p>by <?= $value['fullname'] ?></p></div>
                    <div class="date"><?= date('d-m-Y H:m:s', strtotime($value['create_at']))?></div>
                    <div class="reply">11</div>
                    <div class="reply">
                        <select>
                            <option value="" selected disabled hidden>Edit Post</option>
                            <option>Phê duyệt</option>
                            <option>Xóa bài viết</option>
                        </select>
                    </div>
                </li>
            <?php endforeach; ?>
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
