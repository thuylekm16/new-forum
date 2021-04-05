<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('database/mysql.php');
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
    <link href="/template/css/global/style.css" rel="stylesheet" type="text/css">
    <link href="/template/css/global/header.css" rel="stylesheet" type="text/css">
    <link href="/template/css/global/footer.css" rel="stylesheet" type="text/css">
    <link href="/template/css/page/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once('components/header.php') ?>
<div class="body">
    <div class="list-post">
        <div class="list-header">
            <div class="topic">Topic</div>
            <div class="date">Date</div>
            <div class="reply">Reply</div>
        </div>
        <ul>
            <?php
            foreach ($result as $value):
                ?>
                <li class="">
                    <div class="topic"><a href="detail.php?id=<?=$value['id']?>"><?=$value['title']?></a>
                        <p>by <?=$value['fullname']?></p></div>
                    <div class="date"><?= date('d-m-Y H:m:s',strtotime($value['create_at']))?></div>
                    <div class="reply">11</div>
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
</div>

<?php require_once('components/footer.php') ?>
</body>
</html>
