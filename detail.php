<?php
require_once('database/mysql.php');
session_start();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT posts.*, users.fullname FROM posts join users ON users.id = posts.user_id  WHERE posts.id = $id LIMIT 1 ";
    $connect  = connect();
    $result = $connect->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC)[0];

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diễn đàn</title>
    <link href="/template/css/global/style.css" rel="stylesheet" type="text/css">
    <link href="/template/css/global/header.css" rel="stylesheet" type="text/css">
    <link href="/template/css/global/footer.css" rel="stylesheet" type="text/css">
    <link href="/template/css/page/detail.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
require_once ('components/header.php');
?>
<div class="body">
    <div class="content">
        <div class="header-forum">
            <h1><?= $result['title']?></h1>
            <p><?= date('d-m-Y H:m:s', strtotime($result['create_at']))?>| </p>
            <p>By <?= $result['fullname']?></p>
        </div><hr>
        <div class="main-content">
            <?= $result['content']?>
        </div>
        <div class="comment">
            <h2>Comments</h2>
            <div class="comment-user">
                <p>GiangNguyen</p>
            </div>


        </div>
    </div>
    <div class="sidebar">
        <div class="sidebar-title">
            <h2>List post</h2>
        </div>
        <ul class="items">
            <li class="item">category1</li>
            <li class="item">category2</li>
            <li class="item">category3</li>
        </ul>

    </div>
</div>

<?php
require_once('components/footer.php')
?>
</body>
</html>