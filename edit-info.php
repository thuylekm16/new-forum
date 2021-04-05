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
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re-password'];
    if($password == $re_password){
        $con = connect();
        $query = "SELECT id FROM users WHERE email = '$email'";
        $result = $connect->query($query);
        if($result->num_rows > 0 ){
            $errEmail = true;
        }else{
            $password = md5($password);
            $query = "INSERT INTO users (usertype,fullname, birthday, sex, email, password) VALUES ('2','$fullname','$birthday','$sex','$email','$password')";
            $re = $con->query($query);
            if($re){
                header('location:infor.php');
            }else{
                $errRegister = true;

            }
        }
    }else{
        $errorRePassword = true;
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
                        <?php if($result['sex']==1):?>
                        <option >Male</option>
                         <?php else: ?>
                        <option>Female</option>
                        <?php endif?>
                    </select>
                </div>
                <div class="email">
                    <input type="text" placeholder="email" name="email" value="<?= $result['email'] ?>">
                </div>
                <div class="password">
                    <input type="password" placeholder="password" name="password" value="<?= $result['password'] ?>">
                </div>
                <div class="password">
                    <input type="password" placeholder="comfirm-password" name="re-password" value="<?= $result['password'] ?>">
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
