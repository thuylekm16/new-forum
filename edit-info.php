<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
$errorRePassword = false;
$errEmail = false;
$errRegister = false;
if(isset($_SESSION['user'])){
    require_once('database/mysql.php');
    $connect = connect();
    $user = $_SESSION['user']['id'];
    $query = "SELECT * FROM users WHERE id = $user";
    $result = $connect->query($query);
    $result = $result->fetch_all(MYSQLI_ASSOC)[0];
}?>
<?php
if(isset($_POST['fullname'])){
    require_once('database/mysql.php');
    $fullname = $_POST['fullname'];
    $id = $_POST['id'];
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
        $con = connect();
        $query = "SELECT * FROM users WHERE id = $id";
        $user = $connect->query($query);
        if($user->num_rows > 0 ){
            $user = $user->fetch_all(MYSQLI_ASSOC)[0];
            $user_id = $user['id'];
            $query = "UPDATE users SET fullname = '$fullname', birthday = '$birthday', sex = '$sex' WHERE id='$user_id'";
            $result = $connect->query($query);

            if($result){
                $query = "SELECT * FROM users WHERE id = $id";
                $result = $connect->query($query);
                $result = $result->fetch_all(MYSQLI_ASSOC)[0];
                $_SESSION['user'] = $result;
            }
        }else{

        }
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
    <link href="/template/css/page/register.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once('components/header.php')?>
<div class="body">
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $result['id']?>">
    <div class="register-container">
        <div class="register">
            <h2>EDIT INFORMATION</h2>
            <div class="input">
                <div class="name">
                    <input type="text" placeholder="name" name="fullname" value="<?= $result['fullname'] ?>">
                </div>
                <div class="birthday">
                    <input type="text" placeholder="birthday" name="birthday" value="<?= $result['birthday'] ?>">
                </div>
                <div class="sex">
                    <select name="sex">
                        <option <?php if($result['sex']==1) echo 'selected'?> value="1">Male</option>
                        <option <?php if($result['sex']==2) echo 'selected'?> value="2">Female</option>
                    </select>
                </div>
                <div class="email">
                    <input type="text" placeholder="email" name="email" value="<?= $result['email'] ?>">
                </div>
            </div>
            <div class="sign-in">
                <button>Save</button>
            </div>
        </div>
    </div>
    </form>
</div>

<?php require_once('components/footer.php')?>
</body>
</html>
