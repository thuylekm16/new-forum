<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once('database/mysql.php');
$connect = connect();
$user = $_SESSION['user']['id'];
$query = "SELECT * FROM users WHERE id = $user";
$result = $connect->query($query);
$result = $result->fetch_all(MYSQLI_ASSOC)[0];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diễn đàn</title>
    <link href="/template/css/global/style.css" rel="stylesheet" type="text/css">
    <link href="/template/css/global/header.css" rel="stylesheet" type="text/css">
    <link href="/template/css/global/footer.css" rel="stylesheet" type="text/css">
    <link href="/template/css/page/infor.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once('components/header.php') ?>
<div class="body">
    <div class="list-post">
        <div class="list-header">
            <div class="name">Name</div>
            <div class="dob">Birthday</div>
            <div class="sex">Giới tính</div>
            <div class="email">Email</div>
            <div class="edit-user">Action</div>
        </div>
        <ul>
                <li class="">
                    <div class="name"><p><?= $result['fullname']?></p></div>
                    <div class="dob"><?= $result['birthday']?></div>
                    <div class="sex">
                        <?php
                        if($result['sex']==1)
                            echo "Nam";
                        else
                            echo "Nữ";
                        ?>
                    </div>
                    <div class="email"><?= $result['email']?></div>
                    <div class="edit"><button><a href="edit-info.php">Edit Info</a></button></div>
                </li>
        </ul>

    </div>
</div>

<?php require_once('components/footer.php') ?>
</body>
</html>
